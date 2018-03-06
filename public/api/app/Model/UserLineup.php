<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLineup extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_lineup'; 
    protected $primaryKey = 'user_lineup_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contest_id', 'con_rank', 'con_prize','con_prize_type','status','created_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
    protected $hidden = [];
	
    public $timestamps  = false;

}
