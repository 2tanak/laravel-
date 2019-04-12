<?php

namespace App\Repositories;

use App\Zadanie;
use Gate;
use Auth;
use DB;
class ZadanieRepository extends Repository {
	
	
	public function __construct(Zadanie $zadanie) {
		
		$this->model = $zadanie;
	}

	
		public function addArticle($request) {

	
	   $array = $request->except(['_token']);
	    $message= Zadanie::create($array);
	    return $message;
	    
			
				}

	
	public function deleteArticle($article) {
		
	if($article->delete()) {
			return $article;
		}
		
	}
	
	
public function updateZadanie($request,$article,$param=false) {
//echo "<pre>";print_r($article->id);echo "<pre>";exit();
	if($param){
		 $res = $article::find($request->id);
		 $res->time_prog = $request->time_prog;
		 $res->save();
		 return true;
	}else{
		$data = $request->except('_token','_method');
		$article->fill($data); 
				
		if($article->update()) {
		
			return $article;
		} 
	}
		
		

				}
	
	
	
}

?>