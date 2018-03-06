<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GamePlayers extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_players'; 
    protected $primaryKey = 'gmp_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sports_id', 'plr_details', 'last_stats','plr_id','plr_name','plr_team_code','plr_position','status','last_update','plr_value','rank','fppg','old_fppg','fpts','injury_status','injury_code','injury_reason'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 
    protected $hidden = [];
	
    public $timestamps  = false;

}
