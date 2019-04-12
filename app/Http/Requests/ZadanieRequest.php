<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZadanieRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      //return \Auth::user()->canDo('ADD_ARTICLES');
	   return true;
    }
    
     protected function getValidatorInstance()
     {
    	$validator = parent::getValidatorInstance();
		return $validator;
    	
    	
    }	

    public function rules()
    {
        
        return [
            //
           // 'title' => 'required|max:255',
            //'description' => 'required',
			//'source' => 'required',
            //'category_id' => 'required|integer'
        ];
    }
}
