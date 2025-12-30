<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Lister toutes les catégories 
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Créer une nouvelle catégorie [cite: 29]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);

        $category = Category::create($validated);
        return response()->json($category, 201);
    }

    // Supprimer une catégorie [cite: 29]
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Catégorie supprimée'], 200);
    }
}
