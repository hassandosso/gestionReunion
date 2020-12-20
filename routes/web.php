<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\participantController;

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
Route::get('/', function () {
    return view('pages.index');
});

//PARTICIPANT
Route::get('gestion/membre/creer', [participantController::class,'creerMembre'])->name('creer');
Route::post('gestion/valider/membre',[participantController::class,'valider'])->name('validerMembre');
Route::get('gestion/liste/membre',[participantController::class, 'liste'])->name('listeMembre');
Route::get('detail/membre/{id}',[participantController::class, 'details']);
Route::get('modifier/membre/{id}',[participantController::class, 'modifier']);
Route::get('supprimer/membre/{id}',[participantController::class, 'supprimer']);
Route::post('changer/membre/{id}',[participantController::class,'changerMembre']);
Route::post('changer/photo/membre/{id}',[participantController::class,'changerPhotoMembre']);
