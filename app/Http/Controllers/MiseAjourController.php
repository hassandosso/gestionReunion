<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiseAjour;
use DB;

class MiseAjourController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(){
      $liste_maj = DB::table('mise_ajours')
                  ->join('participants','mise_ajours.id_participant','participants.id')
                  ->select('mise_ajours.*','participants.nom','participants.prenom','participants.identification','participants.surnom')
                  ->get();
      return view('pages.autres.miseAjour.liste',compact('liste_maj'));
    }

    public function creerMaj(Request $req){
      $validateData = $req->validate([
        'montant'=>'required|integer',
        'id_participant'=>'required'
      ]);
      $maj = new MiseAjour();
      $maj->id_participant = $req->id_participant;
      $maj->montant = $req->montant;
      $maj->save();
      $notification = array(
        'message'=>'Mise à jour enregistrée avec succès!',
        'alert-type'=>'success'
      );
      return Redirect()->back()->with($notification);
    }

    public function supprimerMaj($id){
      $delete = DB::table('mise_ajours')->where('id',$id)->delete();
      if($delete){
        $notification = array(
          'message'=>'Supprimé avec succès',
          'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function modifierMaj($id){
      $maj = DB::table('mise_ajours')->where('id',$id)->first();
      return view('pages.autres.miseAjour.modifier',compact('maj'));
    }

    public function validerMaj(Request $req,$id){
      $maj = array();
      $maj['id_participant'] = $req->id_participant;
      $maj['montant'] = $req->montant;
      $update = DB::table('mise_ajours')->where('id',$id)->update($maj);
      if($update){
        $notification=array(
           'message'=>'Mise à jour modifié avec succès!',
           'alert-type'=>'success'
            );
          return Redirect()->route('liste.maj')->with($notification);
      }
    }
}
