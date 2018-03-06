<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lineup extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lineup'; 
    protected $primaryKey = 'lineup_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sports_id', 'start_time', 'end_time','player_ids','pos_details','created_by','players_points','point_details','scoring','rank','prize','rem_salary','prize_type','	bonus'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 
	
    protected $hidden = [];
	
    public $timestamps  = false;

}
