@if ($post->exists)
    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('admin.posts.store') }}" method="POST">
@endif
@csrf
<div class="row">
    <div class="col-8">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" value="{{ old('title', $post->title) }}"
                name="title" required minlength="5" maxlength="50">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">Nessuna Categoria</option>
                @foreach ($categories as $category)
                    <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->label }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="content">Contenuto</label>
            <textarea class="form-control" id="content" name="content" required>{{ old('content', $post->content) }}</textarea>
        </div>
    </div>
    <div class="col-11">
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="url" class="form-control" id="image-field" name="image"
                value="{{ old('image', $post->image) }}">
        </div>
    </div>
    <div class="col-1">
        <img class="img-fluid"
            src="{{ $post->image ?? 'https://media.istockphoto.com/vectors/thumbnail-image-vector-graphic-vector-id1147544807?k=20&m=1147544807&s=612x612&w=0&h=pBhz1dkwsCMq37Udtp9sfxbjaMl27JUapoyYpQm0anc=' }}"
            alt="" id="preview">
    </div>
</div>
@if (count($tags))

    <fieldset>
        <h4>Tags</h4>

        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tag-{{ $tag->label }}" name="tags[]"
                    value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', $postTags ?? []))) checked @endif>

                <label class="form-check-label" for="{{ $tag->label }}">{{ $tag->label }}</label>
            </div>
        @endforeach

    </fieldset>
@endif
<hr>
<footer class="d-flex justify-content-between">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left"></i> indietro
    </a>
    <button class="btn btn-success" type="submit">
        <i class="fa-solid fa-floppy-disk"></i> Salva
    </button>
</footer>
</form>
