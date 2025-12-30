
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowController extends Controller
{
    public function store(Request $request) {
        $book = Book::find($request->book_id);
        $user = auth()->user();

        // 1. Disponibilité de la vérification [cite: 35]
        if ($book->stock <= 0) {
            return response()->json(['error' => 'Livre non disponible'], 400);
        }

        // 2. Limite d'emprunts (ex: max 3) [cite: 36]
        $activeBorrows = Borrow::where('user_id', $user->id)->whereNull('returned_at')->count();
        if ($activeBorrows >= 3) {
            return response()->json(['error' => 'Limite d’emprunts atteinte'], 400);
        }

        // 3. Création de l'emprunt avec date d'expiration [cite: 37]
        $borrow = Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14), // Expire dans 14 jours
        ]);

        $book->decrement('stock');

        return response()->json($borrow);
    }

    // Retour d'un livre
    public function returnBook(Borrow $borrow) {
        $borrow->update(['returned_at' => now()]);
        $borrow->book->increment('stock');
        return response()->json(['message' => 'Livre rendu']);
    }
}
