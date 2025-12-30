<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $featuredBooks = Book::available()
            ->inRandomOrder()
            ->take(6)
            ->get();

        $recentBooks = Book::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('featuredBooks', 'recentBooks'));
    }
}
