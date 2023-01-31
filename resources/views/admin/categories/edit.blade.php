@extends('layouts.app')

@section('content')

        <h2>Modifica una categoria</h2>
        <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}" class="needs-validation" novalidate>
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $category->slug) }}">
                        <div class="invalid-feedback">
                            @error('slug')
                                <ul>
                                    @foreach ($errors->get('slug') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-success">Genera Slug</button>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}">
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
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', $category->description) }}</textarea>
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
                <button type="submit" class="btn btn-primary">Conferma Modifiche</button>
            </div>
        </form>
@endsection
