<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Autenticador;

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntrarController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Auth;
//use App\Http\Middleware\Autenticador;

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

Route::get('/series', [SeriesController::class, 'index'])->name('listar_series');

Route::get('/series/criar', [SeriesController::class, 'create'])->name('form_criar_serie')->middleware('autenticador');

Route::post('/series/criar', [SeriesController::class, 'store'])->middleware('autenticador');

Route::delete('/series/{id}', [SeriesController::class, 'destroy'])->middleware('autenticador');

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);

Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])->middleware('autenticador');

Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);

Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->middleware('autenticador');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/entrar', [EntrarController::class, 'index']);

Route::post('/entrar', [EntrarController::class, 'entrar']);

Route::get('/registrar', [RegistroController::class, 'create']);

Route::post('/registrar', [RegistroController::class, 'store']);

Route::get('/sair', function (){
    Auth::logout();
    return redirect('/entrar');
});
