use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;

// Routes pour les livres et catégories [cite: 31, 32]
Route::apiResource('books', BookController::class);
Route::apiResource('categories', CategoryController::class);

// Routes pour la logique d'emprunt [cite: 33]
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/borrow', [BorrowController::class, 'store']);
    Route::post('/return/{borrow}', [BorrowController::class, 'returnBook']);
});
