@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<div class="text-center mb-5">
    <h1 class="display-4 fw-bold mb-3">
        <i class="bi bi-book text-primary"></i> Bienvenue à la Mini Bibliothèque
    </h1>
    <p class="lead text-muted">Découvrez notre collection de livres et empruntez vos favoris !</p>

    @guest
        <div class="mt-4">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                <i class="bi bi-person-plus"></i> S'inscrire
            </a>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-lg">
                <i class="bi bi-search"></i> Parcourir le catalogue
            </a>
        </div>
    @else
        <div class="mt-4">
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-search"></i> Parcourir le catalogue
            </a>
        </div>
    @endguest
</div>

<!-- Features Section -->
<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="card h-100 text-center p-4">
            <div class="card-body">
                <i class="bi bi-book-half display-4 text-primary mb-3"></i>
                <h5 class="card-title">Large Catalogue</h5>
                <p class="card-text">Des centaines de livres disponibles dans tous les genres</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100 text-center p-4">
            <div class="card-body">
                <i class="bi bi-clock-history display-4 text-success mb-3"></i>
                <h5 class="card-title">Emprunts Faciles</h5>
                <p class="card-text">Empruntez jusqu'à 3 livres pendant 14 jours</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100 text-center p-4">
            <div class="card-body">
                <i class="bi bi-people display-4 text-info mb-3"></i>
                <h5 class="card-title">Communauté</h5>
                <p class="card-text">Rejoignez notre communauté de lecteurs passionnés</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Books -->
@if($featuredBooks->count() > 0)
<div class="mb-5">
    <h2 class="mb-4">
        <i class="bi bi-star-fill text-warning"></i> Livres à découvrir
    </h2>
    <div class="row">
        @foreach($featuredBooks as $book)
        <div class="col-md-4 col-lg-2 mb-4">
            <div class="card h-100">
                <div class="book-cover bg-light d-flex align-items-center justify-content-center">
                    <i class="bi bi-book display-1 text-muted"></i>
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ $book->title }}</h6>
                    <p class="card-text text-muted small mb-2">{{ $book->author }}</p>
                    @if($book->isAvailable())
                        <span class="badge badge-available">
                            <i class="bi bi-check-circle"></i> Disponible
                        </span>
                    @else
                        <span class="badge badge-unavailable">
                            <i class="bi bi-x-circle"></i> Emprunté
                        </span>
                    @endif
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-eye"></i> Voir
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('books.index') }}" class="btn btn-primary">
            Voir tous les livres <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
@endif

<!-- Recent Books -->
@if($recentBooks->count() > 0)
<div class="mb-5">
    <h2 class="mb-4">
        <i class="bi bi-clock text-info"></i> Derniers ajouts
    </h2>
    <div class="row">
        @foreach($recentBooks as $book)
        <div class="col-md-4 col-lg-2 mb-4">
            <div class="card h-100">
                <div class="book-cover bg-light d-flex align-items-center justify-content-center">
                    <i class="bi bi-book display-1 text-muted"></i>
                </div>
                <div class="card-body">
                    <h6 class="card-title">{{ $book->title }}</h6>
                    <p class="card-text text-muted small mb-2">{{ $book->author }}</p>
                    @if($book->isAvailable())
                        <span class="badge badge-available">
                            <i class="bi bi-check-circle"></i> Disponible
                        </span>
                    @else
                        <span class="badge badge-unavailable">
                            <i class="bi bi-x-circle"></i> Emprunté
                        </span>
                    @endif
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-eye"></i> Voir
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- CTA Section -->
@guest
<div class="card bg-primary text-white text-center p-5">
    <h3 class="mb-3">Prêt à commencer ?</h3>
    <p class="lead mb-4">Inscrivez-vous gratuitement et commencez à emprunter des livres dès aujourd'hui !</p>
    <div>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">
            <i class="bi bi-person-plus"></i> Créer un compte
        </a>
    </div>
</div>
@endguest
@endsection
