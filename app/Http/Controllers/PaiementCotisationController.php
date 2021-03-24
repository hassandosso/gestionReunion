<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\paiement_cotisations;
use DB;
use Carbon\Carbon;

class PaiementCotisationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function payerCotisation(Request $request){

      if ($request->dates == NULL){
        return \Response::json(['error'=>'Veulliez renseigner la date']);
      }else{
      $isExist = DB::table('paiement_cotisations')
                ->where('id_cotisation',$request->id_cotisation)
                ->where('dates',$request->dates)
                ->first();
      $data = array();
      if ($isExist !=null){
        $oldids =explode(',',$isExist->id_participant);
        $oldpaies = explode(',',$isExist->paiement);
        array_unshift($oldids,10000);
        array_unshift($oldpaies,0);
        $oldtotal = $isExist->montant_total;
        foreach($request->id_participant as $key=>$val){
          $index = array_search($val,$oldids);
          if($index){
            unset($oldids[$index]);
            $oldtotal = $oldtotal - intval($oldpaies[$index]);
            unset($oldpaies[$index]);
          }
          if($request->paiement[$key] > 0){
            array_push($oldids,$val);
            array_push($oldpaies,$request->paiement[$key]);
          }

        }
        unset($oldids[0]);
        unset($oldpaies[0]);
        $oldtotal = $oldtotal + $request->montant_total;
        $data['id_participant'] = implode(',',$oldids);
        $data['paiement'] = implode(',',$oldpaies);
        $data['montant_total'] = $oldtotal;
        $modif = DB::table('paiement_cotisations')
                  ->where('id_cotisation',$request->id_cotisation)
                  ->where('dates',$request->dates)
                  ->update($data);
        if($modif){
          return \Response::json(['success'=>'Cotisations modifiées avec succès!']);
        }
      }else{
        $data['id_cotisation'] = $request->id_cotisation;
        $data['dates'] = $request->dates;
        $data['id_participant'] = implode(',',$request->id_participant);
        $data['paiement'] = implode(',',$request->paiement);
        $data['montant_total'] = $request->montant_total;
        $ajouter = DB::table('paiement_cotisations')->insert($data);
        if ($ajouter){
        return \Response::json(['success'=>'Cotisations ajoutées avec succès!']);
      }

      }
    }
    }
}
