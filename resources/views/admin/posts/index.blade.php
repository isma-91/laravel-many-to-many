@extends('layouts.app')

@section('content')

    @if (session('success_delete'))
        <div class="alert alert-warning" role="alert">
            Il post "{{ session('success_delete')->title }}" con ID {{ session('success_delete')->id }} è stato eliminato con successo!!
        </div>
    @endif

    <h1>Posts</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Slug</th>
                <th scope="col">Titolo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>

                    <td>
                        <a href="{{ route('admin.posts.show', ['post' => $post]) }}" class="btn btn-primary">Visita</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-warning">Edita</a>
                    </td>
                    <td>
                        {{-- TODO: Da rifare per bene con la validation e la conferma --}}
                        {{-- Non mi ricordo come si fa --}}
                        {{-- <button class="btn btn-danger btn-delete-me" data-id="{{ $post->id }}">Elimina</button> --}}
                        <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-delete-me">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection
