<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\PostPublicationMail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Str::slug($new_post->title, '-');

        $new_post->user_id = Auth::id();

        if (array_key_exists('image', $data)) {
            $image_url = Storage::put('post_images', $data['image']);
            $new_post->image = $image_url;
        }

        $new_post->save();


        if (array_key_exists('tags', $data)) $new_post->tags()->attach($data['tags']);

        // creato il post , invio una mail all'admin
        $mail = new PostPublicationMail();
        $user_email = Auth::user()->email;
        Mail::to($user_email)->send($mail);

        return redirect()->route('admin.posts.show', $new_post)
            ->with('message', 'Post creato con successo')
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $postTags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'postTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        if (array_key_exists('image', $data)) {
            if ($post->image) Storage::delete($post->image);
            $image_url = Storage::put('post_images', $data['image']);
            $post->image = $image_url;
        }

        $post->update($data);


        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post)
            ->with('message', 'Post modificato con successo')
            ->with('type', 'warning');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) Storage::delete($post->image);

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('message', 'il post è stato eliminato con successo')
            ->with('type', 'danger');
    }
}
