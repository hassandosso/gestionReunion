<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Depenses;
use DB;

class DepensesController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index(){
      $depenses = DB::table('depenses')
                  ->leftJoin('evenements','depenses.id_evenement','evenements.id')
                  ->select('depenses.*','evenements.nom')
                  ->get();
      return view('pages.autres.depenses.liste',compact('depenses'));
    }

    public function enregistrerDep(Request $request){
      $depense = new Depenses();
      $depense->montant = $request->montant;
      $depense->details = $request->details;
      $depense->id_evenement = $request->id_evenement;
      $save = $depense->save();
      if($save){
        $notification = array(
          "message"=>"Dépense enregistrée avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function detailsDep($id){
      $details = DB::table('depenses')
                ->leftJoin('evenements','depenses.id_evenement','evenements.id')
                ->select('depenses.*','evenements.nom')
                ->where('depenses.id',$id)
                ->first();
    return view('pages.autres.depenses.details',compact('details'));
    }

    public function deleteDep($id){
      $delete = DB::table('depenses')->where('id',$id)->delete();
      if($delete){
        $notification = array(
          "message"=>"Dépense supprimée avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->back()->with($notification);
      }
    }

    public function modifierDep($id){
      $depense = DB::table('depenses')->where('id',$id)->first();
      return view('pages.autres.depenses.modifier',compact('depense'));
    }

    public function validerDep(Request $req, $id){
      $data = array();
      $data['montant'] = $req->montant;
      $data['details'] = $req->details;
      $data['id_evenement'] = $req->id_evenement;
      $update = DB::table('depenses')->where('id',$id)->update($data);

      if($update){
        $notification = array(
          "message"=>"Dépense modifiée avec succès",
          "alert-type"=>"success"
        );
        return Redirect()->route('liste.depenses')->with($notification);
    }
  }
}
