<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_account'; 
    protected $primaryKey = 'account_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'balance_amt','last_deposite','fpp','available_tickets','used_tickets','bonus_amt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 
	
    protected $hidden = ['account_id'];
	
	public $timestamps  = false;
	
	public function user()
    {
        return $this->belongsTo('App\Model\User','user_id','user_id');
    }

}
