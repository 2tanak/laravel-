<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
        $this->middleware('guest');
    }
	

public function postRegister(Request $request)
{
	$validator = $this->validator($request->all());
    if ($validator->fails()) { 
	   return redirect()->route('register')->withErrors($validator)->withInput();
    };
    $user = $this->create($request->all());
   return redirect('/login/')->with(['message'=>'Регистрация прошла успешно, теперь вы можете войти']);
   
}
   
    protected function validator(array $data)
    {
        return Validator::make($data, [
		    'name' => 'required|string|max:255|unique:users',
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

  
    protected function create(array $data)
    {
        return User::create([
		    'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
