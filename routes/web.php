<?php

use App\Http\Controllers\AmiController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [LibraryController::class, 'principale'])
    ->middleware('auth');

Route::prefix('/bibliotheque')
    ->group(function () {
        Route::get('/verification', [LibraryController::class, 'verification'])
            ->name('bibliotheque.verification')
            ->middleware('auth');

        Route::post('/nommer', [LibraryController::class, 'nommer'])
            ->name('bibliotheque.nommer')
            ->middleware('auth');

        Route::get('/personnelle', [LibraryController::class, 'personnelle'])
            ->name('bibliotheque.personnelle')
            ->middleware('auth');

        Route::post('/personnelle', [LibraryController::class, 'personnelleTri'])
            ->name('bibliotheque.personnelle.tri')
            ->middleware('auth');

        Route::get('/principale', [LibraryController::class, 'principale'])
            ->name('bibliotheque.principale')
            ->middleware('auth');

        Route::post('/principale',  [LibraryController::class, 'principaleTri'])
            ->name('bibliotheque.principale.tri')
            ->middleware('auth');

        Route::get('/listeAmis', [LibraryController::class, 'listeAmis'])
            ->name('bibliotheque.listeAmis')
            ->middleware('auth');

        Route::get('/autre/{id}', [LibraryController::class, 'autresBibliotheques'])
            ->name('bibliotheque.autre')
            ->middleware('auth');

        Route::get('/autreTri/{id}',  [LibraryController::class, 'autresBibliothequesTri'])
            ->name('bibliotheque.autre.tri')
            ->middleware('auth');
    });

Route::prefix('/livre')
    ->group(function () {
        Route::get('/consulter/{id}', [BookController::class, 'consulter'])
            ->name('livre.consulter')
            ->middleware('auth');

        Route::get('/creer', [BookController::class, 'creer'])
            ->name('livre.creer')
            ->middleware('auth');

        Route::post('/creer', [BookController::class, 'creerSubmit'])
            ->name('livre.creerSubmit')
            ->middleware('auth');

        Route::get('/ajouter/{id}', [BookController::class, 'ajouter'])
            ->name('livre.ajouter')
            ->middleware('auth');

        Route::get('/retirer/{id}', [BookController::class, 'retirer'])
            ->name('livre.retirer')
            ->middleware('auth');

        Route::get('/editer/{id}', [BookController::class, 'editer'])
            ->name('livre.editer')
            ->middleware('auth');

        Route::post('/editer', [BookController::class, 'editerSubmit'])
            ->name('livre.editerSubmit')
            ->middleware('auth');

        Route::post('/noter', [BookController::class, 'noter'])
            ->name('livre.noter')
            ->middleware('auth');

        Route::post('/noterSubmit', [BookController::class, 'noterSubmit'])
            ->name('livre.noterSubmit')
            ->middleware('auth');
    });

Route::prefix('/ami')
    ->group(function () {
        Route::get('/liste', [AmiController::class, 'liste'])
            ->name('ami.liste')
            ->middleware('auth');

        Route::post('/ajouter', [AmiController::class, 'ajouter'])
            ->name('ami.ajouter')
            ->middleware('auth');

        Route::post('/retirer', [AmiController::class, 'retirer'])
            ->name('ami.retirer')
            ->middleware('auth');
    });

Route::prefix('/login')
    ->group(function () {
        Route::get('/', [LoginController::class, 'form'])
            ->name('login')
            ->middleware('guest');

        Route::post('/', [LoginController::class, 'login'])
            ->name('login.submit')
            ->middleware('guest');

        Route::get('/logout', [LoginController::class, 'logout'])
            ->name('logout')
            ->middleware('auth');

        Route::get('/register', [LoginController::class, 'register'])
            ->name('login.register')
            ->middleware('guest');

        Route::post('/register/{id?}', [LoginController::class, 'submitRegister'])
            ->name('login.register-submit')
            ->middleware('guest');
    });

Route::prefix('/profile')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [LoginController::class, 'profile'])
            ->name('profile');
        Route::post('/', [LoginController::class, 'submitProfile'])
            ->name('profile.submit');
        Route::get('/password', [LoginController::class, 'password'])
            ->name('profile.password');
        Route::post('/password', [LoginController::class, 'submitPassword'])
            ->name('profile.password-submit');
    });

