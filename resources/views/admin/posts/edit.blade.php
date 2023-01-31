@extends('layouts.app')

@section('content')
        {{-- TODO: Aggiungere le validation e l'"old") --}}

        <h2>Edita un Post</h2>
        <form method="post" action="{{ route('admin.posts.update', ['post' => $post]) }}" class="needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                <div class="invalid-feedback">
                    @error('slug')
                        <ul>
                            @foreach ($errors->get('slug') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
                <div class="invalid-feedback">
                    @error('title')
                        <ul>
                            @foreach ($errors->get('title') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Link immagine</label>
                <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $post->image) }}">
                <div class="invalid-feedback">
                    @error('image')
                        <ul>
                            @foreach ($errors->get('image') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="uploaded_img" class="form-label">Immagine</label>
                <input class="form-control @error('uploaded_img') is-invalid @enderror" type="file" id="uploaded_img" name="uploaded_img">
                <div class="invalid-feedback">
                    @error('uploaded_img')
                        <ul>
                            @foreach ($errors->get('uploaded_img') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>

                <div>
                    <img src="{{ asset('storage/' . $post->uploaded_img) }}" alt="{{ $post->title }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenuto del post</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="10">{{ old('content', $post->content) }}</textarea>
                <div class="invalid-feedback">
                    @error('content')
                        <ul>
                            @foreach ($errors->get('content') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Anteprima</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                <div class="invalid-feedback">
                    @error('excerpt')
                        <ul>
                            @foreach ($errors->get('excerpt') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Conferma Modifiche</button>
            </div>
        </form>

        <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="POST" class="text-center p-3">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Elimina</button>
        </form>
@endsection
