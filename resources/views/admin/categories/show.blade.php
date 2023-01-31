@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>
    <p>
        {{ $category->description }}
    </p>

    {{-- Avendo creato la relazione possiamo usare questo metodo per poter chiamare i posts infatti "$category-.posts" non sono "i post delle categorie" come facciamo per esempio con "$category->name", ma è proprio il metodo che abbiamo definito nel model, in questo caso la freccia dopo $category serve per richiamare quel metodo del model che ci da tutti i post con quella categoria. Ed è sia un metodo che un attributo.  --}}
    <ul>
    @foreach ($posts as $post)
        <li>
            <a href="{{ route('admin.posts.show', ['post' => $post]) }}">
            {{ $post->title }}
            </a>
        </li>
    @endforeach
    </ul>

    {{ $posts->links() }}

    <div class="text-center">
        <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-warning">Edita</a>
    </div>

@endsection
