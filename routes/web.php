<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\participantController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\ProcesverbalController;
use App\Http\Controllers\CotisationsController;

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

//REUNION
Route::get('gestion/reuinon/dujour', [ReunionController::class,'reunionDuJour'])->name('creer.reunion');
Route::get('validerlareunion', [ReunionController::class,'validerLaReunion']);
Route::get('gestion/liste/desReunion',[ReunionController::class,'listeReunion'])->name('liste.reunion');

//PROCES VERBAL
Route::get('gestion/creer/procesverbal',[ProcesverbalController::class, 'creerPV'])->name('creer.pv');
Route::post('gestion/enregistrer/procesverbal',[ProcesverbalController::class,'storePv'])->name('store.pv');
Route::get('gestion/reunion/listePv',[ProcesverbalController::class,'liste'])->name('liste.pv');
Route::get('gestion/reunion/modifierpv/{id}',[ProcesverbalController::class,'modifierPv']);
Route::post('gestion/reunion/validerpv/{id}',[ProcesverbalController::class,'validerPv']);

//COTISATION EXCEPTIONNELLES
Route::get('gestion/reunion/liste/cotisations',[CotisationsController::class,'listeCotisation'])->name('liste.cotisation');
Route::post('gestion/reunion/enregistrer/cotisations',[CotisationsController::class,'creerCotisation'])->name('creer.cotisation');
Route::get('gestion/reunion/cotisation/desactive/{id}',[CotisationsController::class,'desactiveCotisation']);
Route::get('gestion/reunion/cotisation/active/{id}',[CotisationsController::class,'activeCotisation']);
Route::get('gestion/reunion/modifier/cotisation/{id}',[CotisationsController::class,'modifiercotisation']);
Route::post('gestion/reunion/validermodification/{id}',[CotisationsController::class,'validerModification']);
Route::get('gestion/reunion/cotisation/details/{id}',[CotisationsController::class,'detailsCotisation']);
