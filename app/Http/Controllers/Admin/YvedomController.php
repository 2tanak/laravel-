<?
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Repositories\ZadanieRepository;
class YvedomController extends Controller
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
	 
	public function index()
    {//выборка новых задач со статусом новая задача
        $articles = $this->getArticles();
		$yvedom ='Ваши новые задачи: '.count($articles);
	    $this->content = view(env('THEME').'.admin.spisoc')->with(['articles'=>$articles,'yvedom'=>$yvedom])->render();
	    return $this->renderOutput(); 
	}

	public function vrabote()
    {//выборка задач которые на исполнении со статусом на исполнении
		$articles = $this->getVrabote();
		if(isset($articles[0]->id)){
			$articles->load('user');
			$yvedom ='пользователь : '.$articles[0]->user->name .' взял в работу задачи';
		}else{
			$yvedom = false;
		}
	   $this->content = view(env('THEME').'.admin.spisoc')->with(['articles'=>$articles,'yvedom'=>$yvedom])->render();
	   return $this->renderOutput(); 
		}
		
		
  public function pluskzarplate()
    {
		//выборка задач которые cо статусом выполнен и завершены раньше срока
		$articles = $this->getZarplata();
		$yvedom ='Задания, которые выполнены успешно раньше срока за них +10 000 к зарплате в этом месяце';
		$this->content = view(env('THEME').'.admin.zarplata')->with(['articles'=>$articles,'yvedom'=>$yvedom])->render();
	    return $this->renderOutput(); 
		
	}
	
    public function minuskzarplate()
    {
		//выборка просроченых задач
		$articles = $this->getZarplata2();
		
		$yvedom ='Задания, которые просрочены за них -10 000 к зарплате в этом месяце';
		$this->content = view(env('THEME').'.admin.zarplata2')->with(['articles'=>$articles,'yvedom'=>$yvedom])->render();
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
	
	//выборка новых задач, 
	public function getArticles() {
    	$user_id = Auth::user()->id;
		$where = ['status'=>1,'id_user'=>$user_id];
    	$articles = $this->model->get('*',FALSE,TRUE,$where);
		return $articles;
	}
	
	public function getVrabote() {
    	$user_id = Auth::user()->id;
		
		
    	$where = ['status'=>2,'id_user'=>$user_id];
    	$articles = $this->model->get('*',FALSE,FALSE,$where);
		
		
		
		return $articles;
		
	}
	
	public function getZarplata() {
    	$user_id = Auth::user()->id;
		
    	$where = ['status'=>4];
    	$articles = $this->model->get('*',FALSE,TRUE,$where);
		if($articles){
		$articles->transform(function($item,$key) {
			if(!empty($item->z_srok) && !empty($item->time_prog)){
				
				$time_1= explode('/',$item->z_srok);
				$time_1= $time_1[1].'.'.$time_1[0].'.'.$time_1[2];
				
				$time_2= explode('/',$item->time_prog);
				$time_2= $time_2[1].'.'.$time_2[0].'.'.$time_2[2];
				
				$date1 = strtotime($time_1);
				$date2 = strtotime($time_2);
				if($date1 > $date2){
					return $item;
				}
			}
		});
	}
		//echo "<pre>";print_r($articles);echo "</pre>";exit();
		return $articles;
		
	}
	
		public function getZarplata2() {
    	$user_id = Auth::user()->id;
		$articles = $this->model->get('*',FALSE,TRUE);
		
		if($articles){
		$articles->transform(function($item,$key) {
			if(!empty($item->z_srok) && !empty($item->time_prog)){
				
				$time_1= explode('/',$item->z_srok);
				$time_1= $time_1[1].'.'.$time_1[0].'.'.$time_1[2];
				
				$time_2= explode('/',$item->time_prog);
				$time_2= $time_2[1].'.'.$time_2[0].'.'.$time_2[2];
				
				$date1 = strtotime($time_1);
				$date2 = strtotime($time_2);
				
				if($date1 < $date2){
					return $item;
				}
			}
		});
		}
		//echo "<pre>";print_r($articles);echo "</pre>";exit();
		return $articles;
		
	}
	
	
	
}
