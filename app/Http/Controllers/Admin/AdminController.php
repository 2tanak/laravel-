<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Menu;

class AdminController extends Controller
{
    //
    
    protected $p_rep;
    
    protected $a_rep;
    
    protected $user;
    
    protected $template;
    
    protected $content = FALSE;
    
    protected $title;
    
    protected $vars;
    
    public function __construct() {
		
		
		 
		$this->user = Auth::user();
	
		
		if(!$this->user) {
			//abort(403);
		}
	}
	
	public function renderOutput() {
	
		
		$this->vars = array_add($this->vars,'title',$this->title);
		
	
		
		if($this->content) {
			$this->vars = array_add($this->vars,'content',$this->content);
		}
	
		$footer = view(env('THEME').'.admin.parts.footer')->with('content',$this->content)->render();
		$this->vars = array_add($this->vars,'footer',$footer);
		
		//echo env('THEME');exit();
		return view($this->template)->with($this->vars);
		
		
		
		
	}
	

	
}
