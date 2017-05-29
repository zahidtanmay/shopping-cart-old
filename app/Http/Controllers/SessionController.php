<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(){
    	return view('session.create');
    }

    public function store(Request $request){
    	$this->validate($request, [
    	'email' => 'email|required',
    	'password'=>'required|'
    	]);

    	if (auth()->attempt(request(['email','password']))) {

            return redirect()->route('profile');
        }
    		return redirect()->back();
    }
}
