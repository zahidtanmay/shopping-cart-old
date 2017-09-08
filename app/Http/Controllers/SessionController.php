<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Session;

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
            if(Session::has('oldurl')){
                $oldurl = Session::get('oldurl');
                Session::forget('oldurl');
                return redirect()->to($oldurl);

            }
            return redirect()->route('profile');
        }
    		return redirect()->back();
    }

    public function destroy(){
        Auth::logout();

        return redirect()->back();
    }
}
