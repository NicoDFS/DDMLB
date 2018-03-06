<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contests extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contests';

	/**
     * The primaryKey associated with the model.
     *
     * @var string
     */
	protected $primaryKey = 'contest_id';
    
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contest_name', 'sports_id', 'con_type_id','entry_fee','challenge_limit','play_limit','play_type','find_me','start_time','end_time','prizes','status','con_status','prize_pool','match_id','fpp','created_by','total_entry','description','prize_payouts','is_featured','ticket_id','offers_to','start_time_mail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
	
	/**
     * The default attributes created_at and updated_at are disable here.
     *
	 * @var timestamps
     */
	 
	public $timestamps  = false;

}
