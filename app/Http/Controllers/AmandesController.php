<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amandes;
use DB;

class AmandesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(){
      $amandes = DB::table('amandes')
                ->leftJoin('participants','amandes.id_participant','participants.id')
                ->select('amandes.*','participants.nom','participants.prenom','participants.surnom','participants.identification')
                ->get();
      return view('pages.autres.amandes.liste',compact('amandes'));
    }

    public function enregistrerAm(Request $req){
      $amande = new Amandes();
      $amande->id_participant = $req->id_participant;
      $amande->montant = $req->montant;
      $amande->raison = $req->raison;

      $save = $amande->save();
      if($save){
        $notification = array(
          "message"=>"Amande enregistrée avec succès!",
          "alert-type"=>"success",
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function deleteAm($id){
      $delete = DB::table('amandes')->where('id',$id)->delete();
      if($delete){
        $notification = array(
          "message"=>"Amande supprimée avec succès!",
          "alert-type"=>"success",
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function modifierAm($id){
      $amande = DB::table('amandes')->where('id',$id)->first();
      return view('pages.autres.amandes.modifier',compact('amande'));
    }

    public function validerAm(Request $req,$id){
      $data = array();
      $data['id_participant'] = $req->id_participant;
      $data['montant'] = $req->montant;
      $data['raison'] = $req->raison;
      $update = DB::table('amandes')->where('id',$id)->update($data);
      if($update){
        $notification = array(
          "message"=>"Amande modifiée avec succès!",
          "alert-type"=>"success",
        );
        return Redirect()->route('liste.amandes')->with($notification);
      }
    }
}
