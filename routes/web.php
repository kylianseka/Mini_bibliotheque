<<<<<<< HEAD
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public Book Routes
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Loan Management
    Route::get('/my-loans', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/books/{book}/borrow', [LoanController::class, 'borrow'])->name('loans.borrow');
    Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Book Management
    Route::get('/books', [AdminController::class, 'books'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    
    // Loan Management
    Route::get('/loans', [LoanController::class, 'admin'])->name('loans.index');
});
=======
>>>>>>> cbfee6470252eb1110a11fd4125ca2de2914ee82
