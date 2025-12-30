@extends('layouts.app')

@section('title', 'Gestion du Catalogue - Mini Bibliothèque')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Gestion des Livres</h2>
        <p class="text-muted">Gérez votre catalogue de livres, ajoutez de nouveaux exemplaires ou supprimez-en.</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajouter un livre
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.books.index') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Rechercher par titre, auteur ou ISBN..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrer</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Livre</th>
                        <th>ISBN</th>
                        <th>Quantité</th>
                        <th>Disponibilité</th>
                        <th>Emprunts Actifs</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ $book->cover_image_url }}" alt="" class="rounded" style="width: 40px; height: 55px; object-fit: cover;">
                                <div class="ms-3">
                                    <div class="fw-bold">{{ $book->title }}</div>
                                    <div class="text-muted small">{{ $book->author }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            @if($book->isAvailable())
                                <span class="badge bg-success">En stock ({{ $book->available_quantity }})</span>
                            @else
                                <span class="badge bg-danger">Épuisé</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $book->active_loans_count }} en cours</span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ? Cette action est irréversible.')" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-book fs-1 mb-3 d-block"></i>
                                Aucun livre trouvé dans le catalogue.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($books->hasPages())
    <div class="card-footer bg-white">
        {{ $books->links() }}
    </div>
    @endif
</div>
@endsection
