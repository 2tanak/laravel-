<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zadanie extends Model
{
  protected $table = 'zadanie';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'z_name', 'z_desc', 'z_srok','status','tip','time_prog','id_user'
    ];

  public function user() {
		return $this->belongsTo('App\User','id_user','id');
	}
}















