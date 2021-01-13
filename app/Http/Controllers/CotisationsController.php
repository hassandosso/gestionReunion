<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotisations;
use DB;

class CotisationsController extends Controller
{
    public function listeCotisation(){
      $cotisations = DB::table('cotisations')->get();

      return view('pages.cotisation.liste',compact('cotisations'));
    }

    public function creerCotisation(Request $request){
      $validateData = $request->validate([
        'nom'=>'required|max:255',
        'montant_fixe'=>'required|integer'
      ]);
      $cotisation = new Cotisations();
      $cotisation->nom = $request->nom;
      $cotisation->montant_fixe = $request->montant_fixe;
      $cotisation->date_limite = $request->date_limite;
      $cotisation->status = 1;
      $valider = $cotisation->save();
      if ($valider){
        $notification=array(
            'message'=>'Cotisation ajoutée avec succès!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
      }else{
        $notification=array(
            'message'=>"impossible d'ajouter cette cotisation, contactez l'admin",
            'alert-type'=>'error'
             );
           return Redirect()->back()->with($notification);
      }
    }

    public function desactiveCotisation($id){
      DB::table('cotisations')->where('id',$id)->update(['status'=>0]);
      $notification=array(
          'message'=>'Cotisation desactivée avec succès!',
          'alert-type'=>'success'
           );
    return Redirect()->back()->with($notification);

    }

    public function activeCotisation($id){
      DB::table('cotisations')->where('id',$id)->update(['status'=>1]);
      $notification=array(
          'message'=>'Cotisation activée avec succès!',
          'alert-type'=>'success'
           );
    return Redirect()->back()->with($notification);

    }
    public function modifiercotisation($id){
      $cotisation = DB::table('cotisations')->where('id',$id)->first();
      return view('pages.cotisation.modifier',compact('cotisation'));
    }

    public function validerModification(Request $request, $id){
      $data = array();
      $data['nom'] = $request->nom;
      $data['montant_fixe'] = $request->montant_fixe;
      $data['status'] = 1;
      $data['date_limite'] = $request->date_limite;
      $update = DB::table('cotisations')->where('id',$id)->update($data);
      if($update){
        $notification=array(
            'message'=>'Cotisation modifiée avec succès!',
            'alert-type'=>'success'
             );
      return Redirect()->route('liste.cotisation')->with($notification);
    }else{
      $notification=array(
          'message'=>"Impossible de modifier cette cotisation, contactez l'administrateur",
          'alert-type'=>'success'
           );
    return Redirect()->route('liste.cotisation')->with($notification);
    }
    }
}
