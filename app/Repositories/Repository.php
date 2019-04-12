<?php

namespace App\Repositories;

use Config;

abstract class Repository {
	
	protected $model = FALSE;
	
	
	public function get($select = '*',$take = FALSE,$pagination = FALSE, $where = FALSE) {
		
		$builder = $this->model->select($select);
		
		if($take) {
			$builder->take($take);
		}
		
		if($where) {
		
			$builder->where($where);
		}
		
		
		if($pagination) {
			return $builder->paginate(Config::get('settings.paginate'));
		}

		return $builder->get();
	}
	

	public function one2($alias,$attr = array()) {
		$result = $this->model->where('alias',$alias)->first();
		
		return $result;
	}
	public function one($alias,$attr = array()) {
		$result = $this->model->where('id',$alias)->first();
		
		return $result;
	}
	


	
}

?>