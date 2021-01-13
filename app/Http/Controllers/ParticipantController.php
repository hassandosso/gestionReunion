<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\participants;
use Image;
use DB;

class ParticipantController extends Controller
{

    public function liste(){
      $liste = DB::table('participants')->get();

    return view('pages.participants.liste',compact('liste'));
  }
    public function creerMembre(){
      return view('pages.participants.creer');
    }

    public function valider(Request $request){
      $validateData = $request->validate([
      'identification'=>'unique:participants|max:255',
      'contact'=>'unique:participants|max:10'
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
    $participant['surnom']= $request->surnom;
    $participant['naissance'] = $request->naissance;
    $participant['adresse'] = $request->adresse;
    $participant['identification']= $request->identification;
    $participant['contact'] = $request->contact;
    $participant['email'] = $request->email;
    $participant['situationmatri'] = $request->situationmatri;
    $participant['pere'] = $request->pere;
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
      $membre = DB::table('participants')->where('identification',$id)->first();
      $reunions  = DB::table('reunions')->get();
      $nbParticipation=0;
      $cotisee = 0;
      $detailReunion = array();
      $payer = array();
      $date = array();
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
          array_push($detailReunion,$arrPres[$index]);
          array_push($payer,$arrCot[$index]);
          array_push($date,$row->date);
        }

      }
      $countReunion = $key+1;

      return view('pages.participants.details',compact('membre','nbParticipation','cotisee','countReunion','detailReunion',
                                                        'payer','date'));
    }
}
