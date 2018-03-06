<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; 
    protected $primaryKey = 'user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_name', 'fname','lname','password','email','wallet_address','country_id','state_id','status','role','activationLink','email_verify_status','access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 
	public function userAccount()
	{
		return $this->hasOne('App\Model\UserAccount','user_id','user_id');
	}
  
    protected $hidden = [];
	
    public $timestamps  = false;

}
