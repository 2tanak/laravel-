<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
class User extends Authenticatable
{
	use Notifiable;
  
    protected $fillable = [
        'name', 'email', 'password','login',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    
  
	
	public function roles() {
		return $this->belongsToMany('App\Role','role_user');
	}
	
	
	
	public function canDo2($permission, $require = FALSE) {
		foreach($this->roles as $role) {
			
			  if($role->name == $permission){
				  return 'ok';exit();
			  }
			}
		
	}
	
	 public function articles() {
		return $this->hasMany('App\Zadanie');
	}
	
	/*
	public function canDo($permission, $require = FALSE) {
		foreach($this->roles as $role) {
				foreach($role->perms as $perm) {
					//foo*    foobar
					if(str_is($permission,$perm->name)) {
						
						return 'ok';exit();
					}
				}
			}
		
	}
	*/
	// string  ['role1', 'role2']
	/*
	public function hasRole($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $roleName) {
                $hasRole = $this->hasRole($roleName);

                if ($hasRole && !$require) {
                    return true;
                } elseif (!$hasRole && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->roles as $role) {
                if ($role->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }
	*/
	
	
	
}
