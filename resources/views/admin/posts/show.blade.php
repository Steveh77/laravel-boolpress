@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <h1>{{ $post->title }}</h1>
        </header>
        <div class="clearfix">
            @if ($post->image)
                <img class="float-left mr-3" src="{{ $post->image }}"
                    alt=""style="
                height: 200px;
            ">
            @endif
            <p><strong>Categoria: </strong>
                @if ($post->category)
                    {{ $post->category->label }}
                @else
                    Non presente
                @endif
            </p>
            <p>{{ $post->content }}</p>
            <div>
                <time><b>Creato il: </b>{{ $post->created_at }}</time>
            </div>
            <div>
                <time><b>Ultima modifica il: </b> {{ $post->updated_at }}</time>
            </div>
            <div>
                <b>Autore: </b>
                @if ($post->user)
                    {{ $post->user->name }}
                @else
                    Anonimo
                @endif
            </div>
        </div>

        <hr>

        <footer class="d-flex align-items-center justify-content-between">
            <div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i> indietro
                </a>
            </div>

            <div class="d-flex">
                <a class="btn btn-warning mr-2" href="{{ route('admin.posts.edit', $post->id) }}">
                    <i class="fa-solid fa-pencil mr-1"></i> Modifica
                </a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button class="btn
                    btn-danger" type="submit">
                        <i class="fa-solid fa-trash mr-3"></i>Elimina
                    </button>
                </form>
            </div>
        </footer>
    </div>
@endsection
