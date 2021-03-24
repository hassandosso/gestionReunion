<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procesverbals;
use PDF;
use DB;
use Storage;

class ProcesverbalController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function creerPV(){

      return view('pages.procesverbal.creer');
    }

    public function storePv(Request $request){
      $id = $request->id_reunion;
      $id = explode(',', $id);

            $rid = DB::table('reunions')->select('reunions.date')->where('id',intval($id[0]))->first();
            setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
            $dt = utf8_encode(strftime("%d %B %Y", strtotime($rid->date)));

             $pdf = PDF::loadView('pages.procesverbal.pv', array($request->link));
             $path =  'public/procesverbal/'.$dt.'.pdf';
             PDF::loadHTML($request->link)->save($path);
            Storage::put('public/procesverbal/'.$dt.'.pdf', $pdf->output());
              $data = array();
              $data['pv'] = $request->link;
              $data['link'] = $path;
              $save = DB::table('procesverbals')->where('id',intval($id[1]))->update($data);
              if($save){
                $notification=array(
                    'message'=>'PV ajouté avec succès!',
                    'alert-type'=>'success'
                     );
                   return Redirect()->route('liste.reunion')->with($notification);
              }else{
                $notification=array(
                    'message'=>"Impossible d'enregistrer le PV",
                    'alert-type'=>'error'
                     );
                return Redirect()->route('creer.pv')->with($notification);
              }

      }

      public function liste(){
        $listepv = DB::table('procesverbals')
                   ->join('reunions','procesverbals.id_reunion','reunions.id')
                   ->select('procesverbals.*','reunions.date')
                   ->whereNotNull('procesverbals.link')
                   ->get();
        return view('pages.procesverbal.liste',compact('listepv'));
      }

      public function modifierPv($id){
        $modifier = DB::table('procesverbals')
                    ->join('reunions','procesverbals.id_reunion','reunions.id')
                    ->select('procesverbals.*','reunions.date')
                    ->where('procesverbals.id',$id)
                    ->first();
        return view('pages.procesverbal.modifier',compact('modifier'));
      }

      public function validerPv(Request $request, $id){
        $id_reunion = $request->id_reunion;

              $rid = DB::table('reunions')->select('reunions.date')->where('id',$id_reunion)->first();
              setlocale(LC_TIME,"fr_FR",'French_France.1252','fr_FR.ISO8859-1','fra');
              $dt = utf8_encode(strftime("%d %B %Y", strtotime($rid->date)));

               $pdf = PDF::loadView('pages.procesverbal.pv', array($request->link));
               $path =  'public/procesverbal/'.$dt.'.pdf';
               unlink($request->old_link);
               PDF::loadHTML($request->link)->save($path);
              Storage::put('public/procesverbal/'.$dt.'.pdf', $pdf->output());
                $data = array();
                $data['pv'] = $request->link;
                $data['link'] = $path;
                $save = DB::table('procesverbals')->where('id',$id)->update($data);
                if($save){
                  $notification=array(
                      'message'=>'PV mise à jour avec succès!',
                      'alert-type'=>'success'
                       );
                     return Redirect()->route('liste.pv')->with($notification);
                }else{
                  $notification=array(
                      'message'=>"Impossible d'enregistrer le PV",
                      'alert-type'=>'error'
                       );
                  return Redirect()->back()->with($notification);
                }
      }

}
