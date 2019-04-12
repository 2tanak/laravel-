<?php

namespace App\Http\Controllers\Admin;

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

class ZadanieController extends Controller
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
		$user_id = Auth::user()->id;
		if($user_id){
			 $query= User::select('*')->where(['id'=>$user_id])->first();
	         $query= $query->load('roles');
			 foreach($query->roles as $item){
				 $this->role_user=$item->name;
				 
			 }
		}
	$this->content = view(env('THEME').'.admin.content')->with(['role'=>$this->role_user,'user_id'=>$user_id])->render();
	return $this->renderOutput(); 
		}
		
		
	  public function renderOutput() {
	
	   if($this->content) {
			$this->vars = array_add($this->vars,'content',$this->content);
		}
		$this->footer = view(env('THEME').'.admin.footer')->render();
		
		$this->vars = array_add($this->vars,'footer',$this->footer);
	
		return view($this->template)->with($this->vars);
		
		}
		
		
		

    
    
     public function getArticles()
    {
		
        return $this->model->get('*',FALSE, TRUE);
        
     }

    public function store(Request $request)
    {
		if(Gate::denies('MANAGER')) {
		 return redirect('admin/')->with(['error'=>'Чтобы сохранить у вас должны быть права менеджер']);
		}
		
		$result = $this->model->addArticle($request);
		return redirect()->route('zadanie.edit', ['id' => $result->id])->with(['message'=>'Материал успешно добавлен']);;
	}

  
 
    public function edit(Zadanie $zadanie, Request $request)
    {
		
		if(Gate::denies('MANAGER')) {
			$request->flash();
			$this->role_user='PROGER';
		 $this->content = view(env('THEME').'.admin.content')->with(['article'=>$zadanie,'role'=>$this->role_user])->render();
	    return $this->renderOutput(); 
		}else{
			$this->role_user='MANAGER';
			
		}
	     $request->flush();
		 $this->content = view(env('THEME').'.admin.content')->with(['article'=>$zadanie,'role'=>$this->role_user])->render();
	    return $this->renderOutput(); 
	
	}

 
       public function update(Request $request,Zadanie $zadanie)
    {
		if(Gate::denies('MANAGER')) {
			
		
		$result = $this->model->updateZadanie($request,$zadanie,'update');
		
		 return redirect()->route('zadanie.edit', ['id' => $request->id])->with(['error'=>'У вас роль программист: вам можно поменять толко время выполнения работ']);
		 }
		$result = $this->model->updateZadanie($request,$zadanie);
		
		return redirect()->route('zadanie.edit', ['id' => $result->id])->with(['message'=>'Материал успешно обновлен']);;
		
	}


    public function destroy(Zadanie $zadanie)
    {
		  $result = $this->model->deleteArticle($zadanie);
		
		if(is_array($result) && !empty($result['error'])) {
			return back()->with($result);
		}
		
	return redirect()->route('spisoc')->with(['message'=>'Материал успешно удален']);;

    }
}
