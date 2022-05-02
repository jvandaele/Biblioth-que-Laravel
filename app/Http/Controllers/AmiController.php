<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmiController extends Controller
{
    public function liste(){
        $library = Library::where('user_id' , Auth::id())->first();
        if(empty($library)){
            $users = [];
            $amis = [];
            $pasDeBibliotheque = true;
        }
        else{
            $users = User::paginate(10);
            $amis = $library->users;
            $pasDeBibliotheque = false;
        }
        return view('ami/liste', ['users' => $users, 'pasDeBibliotheque' => $pasDeBibliotheque, 'amis' => $amis, 'userAuth' => Auth::id()]);
    }

    public function ajouter(Request $request){
        $user = User::find($request['id']);
        $user_id = Auth::id();
        $library = Library::where('user_id', $user_id)->first();
        $library->users()->attach($user);
        $library->save();
        return redirect()->back();
    }

    public function retirer(Request $request){
        $user = User::find($request['id']);
        $user_id = Auth::id();
        $library = Library::where('user_id', $user_id)->first();
        $library->users()->detach($user);
        $library->save();
        return redirect()->back();
    }
}
