@extends('layouts.app')

@section('title', 'Tableau de Bord Admin - Mini Bibliothèque')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold">Tableau de Bord Administration</h2>
        <p class="text-muted">Bienvenue dans l'espace de gestion de la bibliothèque.</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-book text-primary fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-muted small">Total Livres</h5>
                    <h3 class="mb-0 fw-bold">{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card success h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-people text-success fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-muted small">Utilisateurs</h5>
                    <h3 class="mb-0 fw-bold">{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card warning h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-calendar-check text-warning fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-muted small">Emprunts Actifs</h5>
                    <h3 class="mb-0 fw-bold">{{ $activeLoans }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card danger h-100 p-3">
            <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                    <i class="bi bi-exclamation-octagon text-danger fs-3"></i>
                </div>
                <div>
                    <h5 class="mb-0 text-muted small">En Retard</h5>
                    <h3 class="mb-0 fw-bold">{{ $overdueLoans }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Derniers Emprunts</h5>
                <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
            </div>
            <div class="card-body">
                @if($recentLoans->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Livre</th>
                                <th>Date Emprunt</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentLoans as $loan)
                            <tr>
                                <td>{{ $loan->user->name }}</td>
                                <td>{{ $loan->book->title }}</td>
                                <td>{{ $loan->borrowed_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($loan->returned_at)
                                        <span class="badge bg-success">Retourné</span>
                                    @elseif($loan->isOverdue())
                                        <span class="badge bg-danger">En retard</span>
                                    @else
                                        <span class="badge bg-primary">En cours</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center text-muted my-4">Aucun emprunt récent.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Actions Rapides</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary text-start">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter un livre
                    </a>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-book me-2"></i> Gérer le catalogue
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary text-start">
                        <i class="bi bi-people me-2"></i> Gérer les utilisateurs
                    </a>
                </div>
            </div>
        </div>

        @if($overdueList->count() > 0)
        <div class="card border-danger">
            <div class="card-header bg-danger text-white py-3">
                <h5 class="mb-0 fw-bold">Alertes Retards</h5>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($overdueList as $loan)
                    <li class="list-group-item">
                        <div class="small fw-bold text-danger">{{ $loan->user->name }}</div>
                        <div class="small text-muted">{{ $loan->book->title }}</div>
                        <div class="small text-muted">Dû le : {{ $loan->due_date->format('d/m/Y') }}</div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
