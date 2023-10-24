<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginName'=>'required',
            'loginPassword'=>'required'
        ]);
        if(auth()->attempt(['name'=>$incomingFields['loginName'],'password'=> $incomingFields['loginPassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $incomingFields = $request->validate([
            'name'=>['required',Rule::unique('users','name')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>'required'
        ]);


        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user =  User::create($incomingFields);
        auth()->login($user);

        return redirect('/');
    }
}
