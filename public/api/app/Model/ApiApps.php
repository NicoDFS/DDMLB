<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class ApiApps extends Authenticatable
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dd_api_apps';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'app_name', 'domain_name','appId', 'secretId','app_logo','app_desc','status',
    ];
    
     /**
     * Get the App Author's details
     */
    public function getAuthor()
    {
        return $this->belongsTo('App\Model\AppUser','user_id');
    }
    
}
