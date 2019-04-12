<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\ZadanieRequest;

use App\Http\Controllers\Controller;

use Gate;

use App\Role;

use App\Repositories\ZadanieRepository;

use App\User;

use Auth;

use App\Zadanie;

class SpisocController extends Controller
{
   protected $vars;
   protected $content = FALSE;
   protected $template;
   protected $footer;
   protected $model;
   protected $role_user;
   
     public function __construct(ZadanieRepository $zadanie) {
		$this->template = env('THEME').'.admin.main';
		
		$this->model = $zadanie;
		
		
	}
	 
	 
    public function index(Request $request)
    {
	
	
	    $articles = $this->getArticles();
	
	
		$this->content = view(env('THEME').'.admin.spisoc')->with(['articles'=>$articles])->render();
	    return $this->renderOutput(); 
	
	 
		}
		
		 public function getArticles() {
    	
    	$articles = $this->model->get('*',FALSE,TRUE);
		
		if($articles) {
			//$articles->load('user','category','comments');
		}
		
		return $articles;
		
	}
	
	public function renderOutput() {
	
	   if($this->content) {
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		$this->footer = view(env('THEME').'.admin.footer')->render();
		
		$this->vars = array_add($this->vars,'footer',$this->footer);
	
		return view($this->template)->with($this->vars);
		
		}
	
	

}
