<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dons;
use DB;

class DonsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index(){
      $dons = DB::table('dons')
              ->leftJoin('evenements','dons.id_evenement','evenements.id')
              ->leftJoin('cotisations','dons.id_cotisation','cotisations.id')
              ->select('dons.*','evenements.nom AS nom_ev','cotisations.nom AS nom_cot')
              ->get();
      return view('pages.autres.dons.liste',compact('dons'));
    }

    public function enregistrerDon(Request $req){
      $validateData = $req->validate([
        'donateur'=>'required',
        'montant'=>'required',
        'details'=>'required',
        'date'=>'required'
      ]);
      $don = new Dons();
      $don->donateur = $req->donateur;
      $don->montant = $req->montant;
      $don->details = $req->details;
      $don->date = $req->date;
      $don->id_evenement = $req->id_evenement;
      $don->id_cotisation = $req->id_cotisation;

      $save = $don->save();
      if($save){
        $notification = array(
          "message"=>"Don enregistré avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->back()->with($notification);
      }

    }

    public function deleteDon($id){
      $delete = DB::table('dons')->where('id',$id)->delete();
      if($delete){
        $notification = array(
          "message"=>"Don supprimé avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function modifierDon($id){
      $don = DB::table('dons')->where('id',$id)->first();
      return view('pages.autres.dons.modifier',compact('don'));
    }

    public function validerDon(Request $req,$id){
      $data = array();
      $data['donateur'] = $req->donateur;
      $data['montant'] = $req->montant;
      $data['details'] = $req->details;
      $data['date'] = $req->date;
      $data['id_evenement'] = $req->id_evenement;
      $data['id_cotisation'] = $req->id_cotisation;
      $update = DB::table('dons')->where('id',$id)->update($data);

      if($update){
        $notification = array(
          "message"=>"Don modifié avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->route('liste.dons')->with($notification);
      }

    }
}
