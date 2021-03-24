<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\participantController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\ProcesverbalController;
use App\Http\Controllers\CotisationsController;
use App\Http\Controllers\PaiementCotisationController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\MiseAjourController;
use App\Http\Controllers\DepensesController;
use App\Http\Controllers\AmandesController;
use App\Http\Controllers\DonsController;
use App\Http\Controllers\HomeController;
use App\Models\User;


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
    return view('welcome');
});


//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/password-change', [HomeController::class,'changePassword'])->name('password.change');
Route::post('/password-update', [HomeController::class,'updatePassword'])->name('password.update');
Route::get('/user/logout', [HomeController::class,'Logout'])->name('logout');

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
Route::get('gestion/reunion/reuniondujour/details/{id}',[ReunionController::class,'detailsReunion']);
Route::get('gestion/reunion/supprimer/reuniondujour/{id}',[ReunionController::class,'supprimerReunion']);

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
Route::get('gestion/reunion/cotisation/supprimer/{id}',[CotisationsController::class, 'supprimerCotisation']);

//PAIEMENT DE COTISATION EXCEPTIONNELLES
Route::get('gestion/reunion/payer/cotisation',[PaiementCotisationController::class,'payerCotisation']);
Route::get('gestion/reunion/detail/cotisation/{id}',[PaiementCotisationController::class, 'detailPaiement']);

//EVENEMENTS
Route::get('gestion/reunion/evenement',[EvenementController::class,'creerEvenement'])->name('creer.evenement');
Route::post('gestion/reunion/enregistrer/evenement',[EvenementController::class, 'enregistrerEv'])->name('enregistrer.Ev');
Route::get('gestion/reunion/liste/evenement',[EvenementController::class, 'index'])->name('liste.evenement');
Route::get('gestion/reunion/supprimer/evenement/{id}',[EvenementController::class, 'supprimerEv']);
Route::get('gestion/reunion/modifier/evenement/{id}',[EvenementController::class,'modifierEv']);
Route::post('gestion/reunion/valider/evenement/{id}',[EvenementController::class,'validerEv']);

// MISE A JOUR
Route::get('gestion/reunion/liste/desmisesajour',[MiseAjourController::class, 'index'])->name('liste.maj');
Route::post('gestion/reunion/creer/misajour', [MiseAjourController::class, 'creerMaj'])->name('creer.maj');
Route::get('gestion/reunion/supprimer/misajour/{id}', [MiseAjourController::class, 'supprimerMaj']);
Route::get('gestion/reunion/modifier/misajour/{id}', [MiseAjourController::class, 'modifierMaj']);
Route::post('gestion/reunion/valider/miseajour/{id}', [MiseAjourController::class, 'validerMaj']);

//DEPENSES
Route::get('gestion/reunion/liste/depenses', [DepensesController::class, 'index'])->name('liste.depenses');
Route::post('gestion/reunion/enregistrer/depense', [DepensesController::class, 'enregistrerDep'])->name('enregistrer.depense');
Route::get('gestion/reunion/details/depense/{id}', [DepensesController::class, 'detailsDep']);
Route::get('gestion/reunion/supprimer/depense/{id}', [DepensesController::class, 'deleteDep']);
Route::get('gestion/reunion/modifier/depense/{id}',[DepensesController::class, 'modifierDep']);
Route::post('gestion/reunion/valider/depense/{id}',[DepensesController::class, 'validerDep']);

//AMANDES
Route::get('gestion/reunion/liste/amandes',[AmandesController::class, 'index'])->name('liste.amandes');
Route::post('gestion/reunion/enregistrer/amandes',[AmandesController::class, 'enregistrerAm'])->name('enregistrer.amandes');
Route::get('gestion/reunion/delete/amande/{id}',[AmandesController::class, 'deleteAm']);
Route::get('gestion/reunion/modifier/amande/{id}',[AmandesController::class, 'modifierAm']);
Route::post('gestion/reunion/valider/amande/{id}',[AmandesController::class, 'validerAm']);

//DONS
Route::get('gestion/reunion/liste/dons',[DonsController::class, 'index'])->name('liste.dons');
Route::post('gestion/reunion/enregistrer/don',[DonsController::class, 'enregistrerDon'])->name('enregistrer.don');
Route::get('gestion/reunion/supprimer/don/{id}',[DonsController::class, 'deleteDon']);
Route::get('gestion/reunion/modifier/don/{id}',[DonsController::class, 'modifierDon']);
Route::post('gestion/reunion/valider/don/{id}',[DonsController::class, 'validerDon']);
