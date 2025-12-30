<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $this->authorize('viewAny', Loan::class);

        // Statistics
        $totalBooks = Book::count();
        $totalUsers = User::where('is_admin', false)->count();
        $activeLoans = Loan::active()->count();
        $overdueLoans = Loan::overdue()->count();
        $availableBooks = Book::where('available_quantity', '>', 0)->count();

        // Recent activities
        $recentLoans = Loan::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $overdueList = Loan::overdue()
            ->with(['user', 'book'])
            ->orderBy('due_date')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalUsers',
            'activeLoans',
            'overdueLoans',
            'availableBooks',
            'recentLoans',
            'overdueList'
        ));
    }

    /**
     * Display all books (admin view).
     */
    public function books(Request $request)
    {
        $this->authorize('viewAny', Loan::class);

        $query = Book::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $books = $query->withCount('activeLoans')->orderBy('title')->paginate(15);

        return view('admin.books', compact('books'));
    }

    /**
     * Display all users (admin view).
     */
    public function users()
    {
        $this->authorize('viewAny', Loan::class);

        $users = User::where('is_admin', false)
            ->withCount('activeLoans')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.users', compact('users'));
    }
}
