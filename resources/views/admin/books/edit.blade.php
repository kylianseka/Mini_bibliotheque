@extends('layouts.app')

@section('title', 'Modifier le Livre - Mini Bibliothèque')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mb-4">
            <a href="{{ route('admin.books.index') }}" class="btn btn-link link-secondary p-0 mb-3">
                <i class="bi bi-arrow-left"></i> Retour à la gestion des livres
            </a>
            <h2 class="fw-bold">Modifier le Livre</h2>
            <p class="text-muted small">ID: {{ $book->id }} | ISBN: {{ $book->isbn }}</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label for="title" class="form-label fw-bold">Titre du livre *</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="author" class="form-label fw-bold">Auteur *</label>
                            <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $book->author) }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="isbn" class="form-label fw-bold">Code ISBN *</label>
                            <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn', $book->isbn) }}" required>
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="published_year" class="form-label fw-bold">Année de publication</label>
                            <input type="number" name="published_year" id="published_year" class="form-control @error('published_year') is-invalid @enderror" value="{{ old('published_year', $book->published_year) }}">
                            @error('published_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="form-label fw-bold">Quantité totale *</label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $book->quantity) }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bold">Description / Résumé</label>
                            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <p class="form-label fw-bold mb-2">Couverture actuelle</p>
                                    <img src="{{ $book->cover_image_url }}" alt="" class="rounded border shadow-sm" style="width: 100px; height: 140px; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="cover_image" class="form-label fw-bold">Changer l'image</label>
                                    <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                                    <div class="form-text">Laissez vide pour conserver l'image actuelle.</div>
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-save pe-2"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
