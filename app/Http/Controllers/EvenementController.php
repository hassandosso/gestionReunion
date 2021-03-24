<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use DB;

class EvenementController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function creerEvenement(){
      return view('pages.evenement.creer');
    }
    public function enregistrerEv(Request $req){
      $validateDate = $req->validate([
        'nom'=>'required',
        'budget'=>'integer',
      ]);
      $evenement = new Evenement();
      $evenement->nom = $req->nom;
      $evenement->lieu = $req->lieu;
      $evenement->date = $req->date;
      $evenement->budget = $req->budget;
      $evenement->cotisation_id = $req->cotisation_id;

      $save = $evenement->save();
      if ($save){
        $notification=array(
            'message'=>'Evenement ajouté avec succès!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
        }
      }

      public function index(){
        $evenements = DB::table('evenements')
                      ->leftJoin('cotisations','evenements.cotisation_id','cotisations.id')
                      ->select('evenements.*','cotisations.nom AS cotisation')
                      ->get();
        return view('pages.evenement.liste',compact('evenements'));
      }

      public function supprimerEv($id){
        $delete = DB::table('evenements')->where('id',$id)->delete();
        if ($delete){
          $notification=array(
             'message'=>'Evènement supprimé avec succès!',
             'alert-type'=>'success'
              );
            return Redirect()->back()->with($notification);
        }
      }

      public function modifierEv($id){
        $evenement = DB::table('evenements')->where('id',$id)->first();
        return view('pages.evenement.modifier',compact('evenement'));
      }

      public function validerEv(Reuqest $req, $id){
        $evenement = array();
        $evenement['nom'] = $req->nom;
        $evenement['lieu'] = $req->lieu;
        $evenement['date'] = $req->date;
        $evenement['budget'] = $req->budget;
        $evenement['cotisation_id'] = $req->cotisation_id;

        $update = DB::table('evenements')->where('id',$id)->update($evenement);
        if($update){
          $notification=array(
             'message'=>'Evènement modifié avec succès!',
             'alert-type'=>'success'
              );
            return Redirect()->route('liste.evenement')->with($notification);
        }
      }


}
