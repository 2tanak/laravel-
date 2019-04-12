<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use Gate;

use App\Role;

use App\User;

class AjaxController extends Controller
{
  

  public function store2(Request $request)
    {
		$param= trim(strip_tags($request->a));
	    $user_id = Auth::user()->id;
	    $query= User::select('*')->where(['id'=>$user_id])->first();
	    $query= $query->load('roles');
        $role= Role::all();
	    foreach($role as $value){
	      $arc[$value->name] = $value->id;
	    }
	  if($param == 'MANAGER'){
		$message = 'вы включили роль менеджер';
		$query->roles()->detach($arc['PROGER']);//удаляем роль программиста
		$query->roles()->detach($arc['MANAGER']);//убираем у него роль manager если есть, чтобы не было дубликатов
	    $query->roles()->attach($arc['MANAGER']);//добавляем роль менеджера
		
	}
	if($param == 'PROGER'){
		$message = 'вы включили роль программист';
		$query->roles()->detach($arc['MANAGER']);//удаляем роль менеджера
		$query->roles()->detach($arc['PROGER']);//убираем у него роль proger если есть, чтобы не было дубликатов
		$query->roles()->attach($arc['PROGER']);//добавляем роль программиста
	}
	
	
	 return \Response::json(['message'=>$message]);
		 exit();
    }
 
 
}
