<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategorieProposalController;

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
