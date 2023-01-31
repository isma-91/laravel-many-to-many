@extends('layouts.app')

@section('content')
        {{-- TODO: Aggiungere le validation e l'"old") --}}

        <h2>Crea un Post</h2>
        <form method="post" action="{{ route('admin.categories.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
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
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                <div class="invalid-feedback">
                    @error('name')
                        <ul>
                            @foreach ($errors->get('name') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    @error('description')
                        <ul>
                            @foreach ($errors->get('description') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Crea Categoria</button>
            </div>
        </form>
@endsection
