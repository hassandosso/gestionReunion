<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\participants;
use Image;
use DB;

class ParticipantController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function liste(){
      $liste = DB::table('participants')->get();

    return view('pages.participants.liste',compact('liste'));
  }
    public function creerMembre(){
      return view('pages.participants.creer');
    }

    public function valider(Request $request){
      $validateData = $request->validate([
      'identification'=>'unique:participants|max:255'
    ]);

    $participant = new participants();
    $participant->nom = $request->nom;
    $participant->prenom = $request->prenom;
    $participant->surnom = $request->surnom;
    $participant->naissance = $request->naissance;
    $participant->adresse = $request->adresse;
    $participant->identification = $request->identification;
    $participant->contact = $request->contact;
    $participant->email = $request->email;
    $participant->situationmatri = $request->situationmatri;
    $participant->pere = $request->pere;

    $photo = $request->photo;
    if ($photo){
      $photo_name = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
     Image::make($photo)->resize(300,300)->save('public/media/photo/'.$photo_name);
     $participant->photo = 'public/media/photo/'.$photo_name;
    }
    $participant->save();
    $notification=array(
        'message'=>'Membre ajouté avec succès!',
        'alert-type'=>'success'
         );
       return Redirect()->route('listeMembre')->with($notification);
    }

    public function supprimer($id){
    $membre = DB::table('participants')->where('id',$id)->first();
   $photo = $membre->photo;
   $supprime = DB::table('participants')->where('id',$id)->delete();
   if($supprime){
     unlink($photo);
   }
   $notification=array(
      'message'=>'Membre supprimé avec succès!',
      'alert-type'=>'success'
       );
     return Redirect()->back()->with($notification);

    }

    public function modifier($id){
      $membre = DB::table('participants')->where('id',$id)->first();
      return view('pages.participants.modifier',compact('membre'));
    }

    public function changerMembre(Request $request, $id){

    $participant = array();
    $participant['nom'] = $request->nom;
    $participant['prenom'] = $request->prenom;
    $participant['surnom'] = $request->surnom;
    $participant['naissance'] = $request->naissance;
    $participant['adresse'] = $request->adresse;
    $participant['identification'] = $request->identification;
    $participant['contact'] = $request->contact;
    $participant['email'] = $request->email;
    $participant['situationmatri'] = $request->situationmatri;
    $participant['pere'] = $request->pere;
    if ($request->decede == 1){
      $participant['decede'] = $request->decede;
      $participant['date_deces'] = $request->date_deces;
    }
    $update = DB::table('participants')->where('id',$id)->update($participant);
    if($update){
      $notification=array(
          'message'=>'Mise à jour éffectuée avec succès!',
          'alert-type'=>'success'
           );
         return Redirect()->route('listeMembre')->with($notification);
    }else{
      $notification=array(
        'message'=>'Mise à jour non éffectuée!',
        'alert-type'=>'warning'
         );
       return Redirect()->route('listeMembre')->with($notification);
    }

    }

    public function changerPhotoMembre(Request $request, $id){
      $ancienne_photo = $request->old;
      $data = array();
      $n_photo = $request->file('photo');

      if($n_photo){
        if($ancienne_photo){
          unlink($ancienne_photo);
        }

      }
      $n_photo_name = hexdec(uniqid()).'.'.$n_photo->getClientOriginalExtension();
     Image::make($n_photo)->resize(300,300)->save('public/media/photo/'.$n_photo_name);
     $data['photo'] = 'public/media/photo/'.$n_photo_name;
     $updatephoto = DB::table('participants')->where('id',$id)->update($data);

     if($updatephoto){
       $notification=array(
           'message'=>'Photo mise à jour avec succès!',
           'alert-type'=>'success'
            );
          return Redirect()->route('listeMembre')->with($notification);
     }else{
       $notification=array(
         'message'=>'Mise à jour non éffectuée!',
         'alert-type'=>'warning'
          );
        return Redirect()->route('listeMembre')->with($notification);
     }
    }

    public function details($id){
      // COTISATION REUNION
      $membre = DB::table('participants')->where('identification',$id)->first();
      $reunions  = DB::table('reunions')->get();
      $nbParticipation=0;
      $cotisee = 0;
      $payer = array();
      $date = array();
      $countReunion = 0;
      foreach($reunions as $key=>$row){
        $arrId = explode(',', $row->identification);
        $arrPres = explode(',', $row->presence);
        $arrCot = explode(',', $row->cotisation);
        array_unshift($arrId,10000);
        array_unshift($arrPres,1000);
        array_unshift($arrCot,0);
        $index = array_search($id,$arrId,true);
        if($index){
          if($arrPres[$index]=='present'){
            $nbParticipation= $nbParticipation + 1;
          }
          $cotisee = $cotisee + intval($arrCot[$index]);
          array_push($payer,$arrCot[$index]);
          array_push($date,explode('-',$row->date)[0]);
        }
        $countReunion++;
      }
      $detailReunion = array_unique($date);

      //COTISATION EXCEPTIONNELLES
      $id_p= DB::table('participants')->select('participants.id')->where('identification',$id)->first();
      $paiement_det = DB::table('paiement_cotisations')
                      ->join('cotisations','paiement_cotisations.id_cotisation','cotisations.id')
                      ->select('paiement_cotisations.*','cotisations.nom','cotisations.montant_fixe','cotisations.status')
                      ->orderBy('dates','ASC')
                      ->get();
        $cotisations = array();
        $active = array();
        $paiement = array();
        foreach ($paiement_det as $no => $paies){
          $ids = explode(',', $paies->id_participant);
          array_unshift($ids,0);
          $index = array_search($id_p->id,$ids);
          if ($index){
            $p = explode(',', $paies->paiement);
            array_unshift($p,0);
            if(!in_array($paies->nom,$cotisations)){
              array_push($cotisations,$paies->nom);
              array_push($paiement,$p[$index]);
              array_push($active,$paies->status);
            }else{
              $index2 = array_search($paies->nom,$cotisations);
              $el = $paiement[$index2];
              $el = intval($el)+intval($p[$index]);
              $paiement[$index2] = $el;
            }
          }else{
            if (!in_array($paies->nom,$cotisations)){
              array_push($cotisations,$paies->nom);
              array_push($paiement,0);
              array_push($active,$paies->status);
            }
          }
        }
      // MISE A JOUR COTISATION REUNION
      $maj = DB::table('mise_ajours')->where('id_participant',$id_p->id)->get();
      foreach ($maj as $m){
        $cotisee = $cotisee + $m->montant;
      }



      return view('pages.participants.details',compact('membre','nbParticipation','cotisee','countReunion','detailReunion',
                                                        'payer','date','maj','cotisations','paiement','active'));
    }
}
