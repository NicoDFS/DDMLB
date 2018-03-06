<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Offers extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offers'; 
    protected $primaryKey = 'offer_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_name', 'status', 'contest_id','offer_type','offer_end_date','description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	
    protected $hidden = [];
	
    public $timestamps  = false;

}
