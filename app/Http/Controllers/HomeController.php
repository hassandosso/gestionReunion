<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(){
        return view('auth.changepassword');
    }

    public function updatePassword(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=User::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();
                      $notification=array(
                        'message'=>'Mot de passe changé avec succès ! Veuillez vous reconnecter',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('login')->with($notification);
                 }else{
                     $notification=array(
                        'message'=>'les mots de passe de concordent pas!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }
      }else{
        $notification=array(
                'message'=>"L'ancien mot de passe est erronné",
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }

    }

    public function Logout()
    {
        // $logout= Auth::logout();
            Auth::logout();
            $notification=array(
                'message'=>'Vous êtes déconnecté',
                'alert-type'=>'success'
                 );
             return Redirect()->route('login')->with($notification);


    }
}
