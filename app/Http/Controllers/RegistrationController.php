<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create(){
    	return view('Registration.create');
    }

    public function store(Request $request){
    	$this->validate($request, [
    	'name'=>'required',
    	'email' => 'email|required|unique:users',
    	'password'=>'required|min:4|confirmed'
    	]);

    	$user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return redirect()->route('home');

    }
}
