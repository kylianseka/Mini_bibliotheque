<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Afficher la liste des livres (API/Web)
    public function index() {
        return Book::all();
    }

    // Créer un nouveau livre avec upload de PDF
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pdf_file' => 'nullable|mimes:pdf|max:10000', // 
        ]);

        if ($request->hasFile('pdf_file')) {
            $path = $request->file('pdf_file')->store('books_pdf', 'public');
            $validated['pdf_path'] = $path;
        }

        return Book::create($validated);
    }

    // Voir un livre spécifique
    public function show(Book $book) {
        return $book;
    }

    // Mettre à jour un livre
    public function update(Request $request, Book $book) {
        $book->update($request->all());
        return $book;
    }

    // Supprimer un livre
    public function destroy(Book $book) {
        $book->delete();
        return response()->json(['message' => 'Livre supprimé']);
    }
}
