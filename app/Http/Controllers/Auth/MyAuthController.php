<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class MyAuthController extends Controller
{
    //
    
    
    public function showLogin() {

		return view('auth.login');
	}
	
	public function authenticate(Request $request) {
		
		$array = $request->all();
	    $login = trim(strip_tags($array['login']));
		$pass = trim(strip_tags($array['password']));
		
		$remember = $request->has('remember');
		
		if(Auth::attempt([
						'login'=>$login,
						'password'=>$pass
						], $remember )) 
		
						{
							return redirect()->intended('/admin');
						}
		/*
		return redirect()->back()
					->withInput($request->only('login','remember'))
					->withErrors([
								'login'=>'Данные аутентификации не верны'
								]);
								*/
		return redirect('/login/')->with(['error'=>'Данные аутентификации не верны']);						
					//return redirect('/login/')->withInput();
	}
}
