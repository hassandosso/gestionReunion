<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Reunions;
use DB;

class ReunionController extends Controller
{
    public function reunionDuJour(){
      $reunion = DB::table('participants')->get();

    return view('pages.reunions.creer',compact('reunion'));
    }

    public function validerLaReunion(Request $request){

    if (empty($request->date)){
        $date = explode(' ',Carbon::now());
        $date = $date[0];
      }else{
        $date = $request->date;
      }
    $isExist = DB::table('reunions')->where('date',$date)->exists();
    // SI LA REUNION N'A ENCORE ETE ENREGISTREE
    if(!$isExist){
    $data = array();
    $data['identification'] = implode(",",$request->identification);
    $data['presence'] = implode(",",$request->presence);
    $data['cotisation'] = implode(",",$request->cotisation);
    $data['nombre_present'] = $request->nombre_present;
    $data['montant_obtenu'] = $request->montant_obtenu;
    $data['date'] = $date;
      $save = DB::table('reunions')->insert($data);
      if($save){
      $reuId = DB::table('reunions')->select('reunions.id')->orderBy('id','DESC')->first();
      $dataid = array();
      $dataid['id_reunion'] = $reuId->id;
      DB::table('procesverbals')->insert($dataid);
             return \Response::json(['success'=>'Liste validée avec succès']);
      }else{
           return \Response::json(['error'=>'impossible de valider la liste']);
      }
    }
    //END
    // SI LA REUNION A DEJA ETE ENREGISTREE
    else{
      // UPDATE DATA (OLD + NEW)
      $exReunion = DB::table('reunions')->where('date',$date)->first();
      $exIds = explode(',', $exReunion->identification);
      $expres = explode(',', $exReunion->presence);
      $exCot = explode(',', $exReunion->cotisation);
      array_unshift($exIds,10000);
      array_unshift($expres,1000);
      array_unshift($exCot,0);
      $exnombre_present = $exReunion->nombre_present;
      $exmontant_obtenu = $exReunion->montant_obtenu;
      foreach($request->identification as $key => $val){
        $index = array_search($val,$exIds,true);
        if($index){
          unset($exIds[$index]);
          if($expres[$index] == 'present'){
            $exnombre_present = $exnombre_present-1;
          }
          unset($expres[$index]);
          $exmontant_obtenu = $exmontant_obtenu-intval($exCot[$index]);
          unset($exCot[$index]);
        }
        array_push($exIds,$val);
        array_push($expres,$request->presence[$key]);
        array_push($exCot,$request->cotisation[$key]);
        unset($exIds[0]);
        unset($expres[0]);
        unset($exCot[0]);
      }
      $newnombre_present = $exnombre_present+intval($request->nombre_present);
      $newmontant_obtenu = $exmontant_obtenu+intval($request->montant_obtenu);
      //End
      //PREPAIR DATA FOR SAVING IN DB
      $data1 = array();
      $data1['identification'] = implode(',',$exIds);
      $data1['presence'] = implode(',',$expres);
      $data1['cotisation'] = implode(',',$exCot);
      $data1['nombre_present'] = $newnombre_present;
      $data1['montant_obtenu'] = $newmontant_obtenu;

      $save1 = DB::table('reunions')->where('date',$date)->update($data1);
      if($save1){
             return \Response::json(['success'=>'Liste mise à jour avec succès']);
      }else{
           return \Response::json(['error'=>'impossible de valider la liste']);
      }

    }//END
  }
  public function listeReunion(){
    $listeReunion = DB::table('reunions')
                    ->join('procesverbals','procesverbals.id_reunion','reunions.id')
                    ->select('procesverbals.*','reunions.date','reunions.nombre_present','reunions.montant_obtenu')
                    ->orderBy('date','ASC')
                    ->get();

    return view('pages.reunions.liste',compact('listeReunion'));
  }

}
