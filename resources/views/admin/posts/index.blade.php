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
                <th scope="col">Tags</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name ?? ''}}</td>
                    {{--Quest'ultimo ternario serve per non stampare nulla se come categoria ha "null" perchè magari la categoria associata a quel post è stata cancellata. Se non lo facciamo da errore perchè non trova il name della categoria. Tipo isset()--}}
                    <td>
                        @foreach ($post->tags as $tag)
                            {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
                        @endforeach
                    </td>
                    {{-- {{ $post->tags->name }} --}}
                    {{-- In questo caso tags al plurale perchè la relazione è molti amolti, deve coincidere con quello che abbiamo scritto nel model. Non lo chiamiamo come metodo perchè, come metodo lo usiamo solo quando dobbiamo continuare a chiamare qualcos altro (tipo con l'"attach"), quando invece, come in questo caso, voglaimo solo la lista dei tags associati, lo possiamo chiamare come attributo per poi accedere a ciò che ci serve. Ma qui ci serve anche un ciclo, cmabia un po la sintassi, ma il concetto è lo stesso.
                    La parte con il loop serve per dire che se è l'ultimo elemento dell'arrai non deve stampare niente, in tutti gli altri casi mette una virgola dopo il tag. È una variabile speciale che ci da blade per riconoscere il primo o l'ultimo elemento di un array. --}}

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
