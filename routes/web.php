<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategorieProposalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbuseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici, nous définissons les routes de votre application qui sont
| accessibles via le navigateur. Vous pouvez les organiser en fonction
| des fonctionnalités et protéger certaines routes via des middleware.
|
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes ressources pour les entités principales
Route::resource('service-providers', ServiceProviderController::class);
Route::resource('services', ServiceController::class);
Route::resource('stages', StageController::class);
Route::resource('promotions', PromotionController::class);
Route::resource('comments', CommentController::class);
Route::resource('categorie-proposals', CategorieProposalController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/test-email', function() {
    \Illuminate\Support\Facades\Mail::raw('Test d\'envoi d\'email via Mailtrap', function ($message) {
        $message->to('votre-email@example.com')->subject('Test Email');
    });
    return 'Email envoyé !';
});

Route::post('/test-register', function (\Illuminate\Http\Request $request) {
    dd($request->all());
})->name('test.register');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comments/{comment}/report', [CommentController::class, 'report'])->name('comments.report');

Route::middleware(['auth', 'can:manage-abuses'])->group(function () {
    Route::resource('abuses', AbuseController::class)->except(['create', 'store', 'edit']);
});

Route::get('/search', [ServiceProviderController::class, 'search'])->name('service-providers.search');