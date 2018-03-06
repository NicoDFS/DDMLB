<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserTransactions extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_transactions'; 
    protected $primaryKey = 'transaction_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'transaction_type','request_type','transaction_amount','	fpp_used','confirmation_code','description','status','transaction_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 
	
    protected $hidden = [];
	
	public $timestamps  = false;
	

}
