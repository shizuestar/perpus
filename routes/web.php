<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\libraryController;
use App\Http\Controllers\LoanController;

Route::redirect("/", "/library");
Route::get("/library", [libraryController::class, "index"])->name("library.index");
Route::get('/library/book/{book:slug}', [LibraryController::class, 'showBook'])->name('library.book.show');
Route::get('/library/search', [LibraryController::class, 'search'])->name('library.search');

// Auth
Route::middleware("auth")->group(function(){
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
    Route::get("/profile", [ProfileController::class, "index"])->name("profile");
    Route::post("/profile/updatePassword", [ProfileController::class, "updatePassword"])->name("updatePassword");

    Route::get('/loans', [LoanController::class, "index"])->name("loans");
    Route::delete('/library/{loan}/destroy', [LoanController::class, 'destroy'])->name('loan.destroy');
    Route::delete('/library/{loan}/destroyUser', [LoanController::class, 'destroyUser'])->name('loan.destroy.user');

    Route::post('/library/book/sendReview/{book:slug}', [LibraryController::class, 'sendReview'])->name('library.book.sendReview');
    Route::post('/library/add-to-collection', [LibraryController::class, 'addToCollection'])->name('library.addToCollection');
    Route::post('/library/delete-to-collection', [LibraryController::class, 'deleteToCollection'])->name('library.deleteToCollection');
    Route::post('/requestLoan/{book:slug}', [LibraryController::class, 'requestLoan'])->name('loans.request');

    Route::post("/logout", [LoginController::class, "logout"])->name("logout");
});

Route::middleware(['admin'])->group(function() {
    Route::resource("/users", UserController::class);

    Route::resource('/books', BookController::class)->parameters(['books' => 'book:slug']);
    Route::resource('/book-categories', BookCategoryController::class);
    Route::get('/book-categories/data', [BookCategoryController::class, 'data'])->name('book-categories.data');

    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');
    Route::post('/loans/{loan}/accept', [LoanController::class, 'accRequest'])->name('loans.acc');
    Route::post('/loans/{loan}/reject', [LoanController::class, 'rejectRequest'])->name('loans.reject');
    Route::post('/loans/{loan}/returned', [LoanController::class, 'returned'])->name('loans.return');
    Route::get('/loans/export', [LoanController::class, 'exportToPDF'])->name('loans.export');
});

Route::middleware(["guest"])->group(function() {
    Route::get("/login", [LoginController::class, "index"])->name("login");
    Route::post("/login", [LoginController::class, "authenticate"])->name("login.authenticate");
    Route::get('/register', [LoginController::class, "register"])->name("register");
    Route::post('/register', [LoginController::class, "store"])->name("register.store");
});