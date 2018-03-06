<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Helper\GameXmlParserController as GameXml;
use App\Http\Controllers\Helper\AbbreviationsController as Abbreviations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Model\AppUser;
use App\Model\ApiApps;
use App\Model\State;
use App\Model\User;
use App\Model\Lineup;
use App\Model\UserTransactions;
use App\Model\ContestTransactions;
use App\Model\UserAccount;
use App\Model\UserLineup;
use App\Model\Country;
use App\Model\Sports;
use App\Model\ContestType;
use App\Model\Contests;

use Hash;
use DB;
use File;


class apiController extends Controller
{
    const VERIFIED = 1;
	const LOGINSTATUS = 1;
    const STATUS = 1;
      
    /**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 16th DEC 2017
    *** Description : This API is used for check access_token valid or not
    *** Params : access_token 
    *** Return : true if access_token is valid.
    *********/
	
	public function validateAccessToken($access_token){
		try {
			$matchKeys = ['api_token' =>$access_token, 'status' => 1];
			$Access = ApiApps::where($matchKeys)->first();
			
			if($Access){
				return true;
			}else{
				return false; 
			}
		}catch(\Illuminate\Database\QueryException $e){
			
			$returnArr = array(
				'error'     =>  1,
				'message'   =>  'Oops ! some thing is wrong.',
				'reason'      =>  $e->getMessage(),
				'status'    =>  200
			);
			
		}
		return json_encode($returnArr); die;
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 15th DEC 2017
    *** Description : This API is used for App Authentication
    *** Params : AppId , SecretId 
    *** Return : Access Token
    *********/
	
	
    public function AppAuth(Request $request){
		
        $returnArr = array();
        $ErrorTxt = '';
		
        $validation = Validator::make($request->all(), [
            'AppId'     => 'required',
            'SecretId'  => 'required',
        ]);
        
        if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'      =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{
            try {
				$App = ApiApps::where(['appId'=>$request->AppId,'status'=>1])->first();
				if($App){
					if(ApiApps::where('secretId', $request->SecretId)) {
						
						$App->api_token = str_random(60);
						$App->save();
						
						$matchKeys = ['appId' =>$request->AppId, 'secretId' => $request->SecretId];

						if (ApiApps::where($matchKeys)->first()) {
							
							/* Authentication passed... */								
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'Authentication successfully done.',
								'data' 		=>  array('accessToken'=>$App->api_token),                       
								'status'    =>  200
							); 
						}else{
						   $returnArr = array( 
								'error'     =>  1,
								'message'   =>  'appId and secretId does not match.',
								'reason'      =>  'appId and secretId combination does not match.',                       
								'status'    =>  422
							); 
					   }
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Wrong secretId.',
							'reason'      =>  'secretId does not match.',                       
							'status'    =>  422
						);
					}
					
				}else{
				  $returnArr = array(
						'error'     =>  1,
						'message'   =>  'appId not valid.',
						'reason'    =>  'appId does not associate with us or may be not approved from admin',
						'status'    =>  422
					);  
				}
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
                DB::rollBack();
            }
            
        }        
        return json_encode($returnArr);
    }
    
    /**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 15th DEC 2017
    *** Description : This API is used get all list of country
    *** Params : api token
    *** Return : all active list of country
    *********/
    
    public function getCountryList(Request $request){

		$returnArr = array();
		$ErrorTxt = '';
		$validation = Validator::make($request->all(), [
            'accessToken'     => 'required',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$countryList = Country::where('status', 1)->get();
					
					if(!empty($countryList)){
						foreach($countryList as $ckey=>$country){
							if($country['country_code'] == "US"){
								$temp = $countryList[0];
								$countryList[0] = $country;
								$countryList[$ckey] = $temp;
							}
						}
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'All Available Active Country List',
							'data' 		=>  $countryList,                       
							'status'    =>  200
						);
						
					} else {
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'No Active Country Available',
							'data' 		=>  '{}',                       
							'status'    =>  200
						);
					}
					 
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
			}catch(\Illuminate\Database\QueryException $e){
					
				$returnArr = array(
					'error'     =>  1,
					'message'   =>  'Oops ! some thing is wrong.',
					'reason'      =>  $e->getMessage(),
					'status'    =>  200
				);
				
			}
		}
		return json_encode($returnArr);	
    }
    
    /**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 15th DEC 2017
    *** Description : This API is used get all list of state
    *** Params : country_id and api token
    *** Return : all active list of state
    *********/
	
    public function getStateList(Request $request){
        $returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'     => 'required',
			'country_id'	  => 'required',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$matchKeys = ['country_id' =>$request->country_id, 'status' => 1];
					
					$stateList = State::where($matchKeys)->get();
					
					if(!empty($stateList)){
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'All Available Active State List of provided country id',
							'data' 		=>  $stateList,                       
							'status'    =>  200
						);
						
					} else {
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'No Active State Available',
							'data' 		=>  '{}',                       
							'status'    =>  200
						);
					}
					 
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
			}catch(\Illuminate\Database\QueryException $e){
					
				$returnArr = array(
					'error'     =>  1,
					'message'   =>  'Oops ! some thing is wrong.',
					'reason'      =>  $e->getMessage(),
					'status'    =>  200
				);
				
			}
		}
		return json_encode($returnArr);	
    }
    
    /**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 15th DEC 2017
    *** Description : This API is used get all list of state
    *** Params : country_id and api token
    *** Return : all active list of state
    *********/
	
	public function registerAccount(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   	=> 'required',
            'user_name'   		=> 'required|unique:users',
			'email'	  			=> 'required|email|unique:users',
			'password'	  		=> 'required|confirmed|regex:^(?=.*\d)(?=.*[a-zA-Z]).{8,25}$^',
			'country_id'	  	=> 'required',
			'state_id'	  		=> 'required'
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{
			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$matchKeys = ['country_id' =>$request->country_id, 'status' => 1,'id'=>$request->state_id];
						
					$stateList = State::where($matchKeys)->first();
					
					if($stateList){
						
						DB::beginTransaction();
						$User = new User();
						$User->user_name = $request->user_name;
						$User->email = $request->email;
						$User->password = md5($request->password);
						$User->country_id = $request->country_id;
						$User->state_id = $request->state_id;
						$User->status = 1;
						$User->role = 1;
						$User->email_verify_status = 1;
						$User->activationLink = base64_encode($User->username . '@' . $random = mt_rand(10000000, 99999999));
						$User->save();
						
						$UserAccount = new UserAccount();
						$UserAccount->user_id = $User->user_id; 
						$UserAccount->bonus_amt = 0; 
						$UserAccount->save();
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'User registration has been successfully done.',
							'data'      =>  $User,                       
							'status'    =>  200
						);
						DB::commit();
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'country_id and state_id not valid.',
							'reason'      =>  'country_id and state_id are not belongs to each other',                       
							'status'    =>  200
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
                DB::rollBack();
			}
		}
		return json_encode($returnArr);	
	}


	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 18th DEC 2017
    *** Description : This API is used for user login
    *** Params : user_name and password and accessToken
    *** Return : user info and User AuthToken
    *********/
    
	public function login(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   	=> 'required',
            'user_name'   		=> 'required',
			'password'	  		=> 'required',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_name' =>$request->user_name, 'password' => md5($request->password)];
					$UserDetail = User::where($matchKeys)->first();
					if ($UserDetail) {
						if(($UserDetail->email_verify_status ==1) && ($UserDetail->status ==1)){
							DB::beginTransaction();
							$unique_code = uniqid(rand(), false);
							
							User::where('user_id',$UserDetail->user_id)->update(['access_token' => $unique_code]);
							
							$data = array();
							$data['user_id'] = $UserDetail->user_id;
							$data['user_name'] = $UserDetail->user_name;
							$data['fname'] = $UserDetail->fname;
							$data['lname'] = $UserDetail->lname;
							$data['email'] = $UserDetail->email;
							$data['wallet_address'] = $UserDetail->wallet_address;
							$data['authToken'] = $unique_code;
							
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'User logged in successfully.',
								'data'      =>  $data,                       
								'status'    =>  200
							);
							DB::commit();
						}else{
							$returnArr = array(
								'error'     =>  1,
								'message'   =>  'User Status Not Active Or Unverfied.',
								'reason'    =>  'Please Verify Your Email Address If Not Verified.',
								'status'    =>  190
							);
						}
							
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication failed.',
							'reason'    =>  'No identity found,verify your credentials you have entered',
							'status'    =>  198
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
                DB::rollBack();
			}
		}
		return json_encode($returnArr);	
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 18th DEC 2017
    *** Description : This API is used get all list of state
    *** Params : AuthToken and AccessToken and user_id
    *** Return : user_id
    *********/
    
	public function logout(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   	=> 'required',
            'user_id'   		=> 'required',
			'authToken'	  		=> 'required',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if ($UserDetail) {
						DB::beginTransaction();
						User::where('user_id',$UserDetail->user_id)->update(['access_token' => '']);
						
						$data = array();
						$data['user_id'] = $UserDetail->user_id;
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'User logged out successfully.',
							'data'      =>  $data,                       
							'status'    =>  200
						);
						DB::commit();
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Invalid inputs.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
                DB::rollBack();
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 18th DEC 2017
    *** Description : This API is used get all list of state
    *** Params : AuthToken and AccessToken and user_id
    *** Return : User Account details json
    *********/
	
	public function getUserAccountDetails(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   	=> 'required',
            'user_id'   		=> 'required',
			'authToken'	  		=> 'required',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if ($UserDetail) {
						
						$data = User::find($request->user_id)->userAccount;
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'User Account Details.',
							'data'      =>  !empty($data)?$data:'User account info is empty.',                       
							'status'    =>  200
						);
						
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date : 18th DEC 2017
    *** Description : This API is used for fetching all the active sports
    *** Params : No parameter required for this API
    *** Return : Sports data json
    *********/
	
	public function getSports(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   	=> 'required'
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$Sports = Sports::where('status',1)->get();
					$returnArr = array(
						'error'     =>  0,
						'message'   =>  'Sports Details.',
						'data'      =>  !empty($Sports)?$Sports:'Sports data is empty.',                       
						'status'    =>  200
					);
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 18th DEC 2017
    *** Description : This API is used for fetching all the active Contest Type
    *** Params : No parameter required for this API
    *** Return : Contest Type data json
    *********/
	
	public function getContestType(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   => 'required'
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$ContestType = ContestType::where('status',1)->get();
					$returnArr = array(
						'error'     =>  0,
						'message'   =>  'Contest Type Details.',
						'data'      =>  !empty($ContestType)?$ContestType:'Contest Type data is empty.',                       
						'status'    =>  200
					);
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 18th DEC 2017
    *** Description : This API is used for fetching all the active Contest Type
    *** Params : No parameter required for this API
    *** Return : Contest Type data json
    *********/
	
	public function getMatches(Request $request){
		$returnArr = array();
		$ErrorTxt = '';
		
		$validation = Validator::make($request->all(), [
            'accessToken'   => 'required',
            'sports_id'   	=> 'required',
            'game_date'  	=> 'required|date|date_format:Y-m-d',
        ]);
		
		if ($validation->fails()) { 
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt .= $error.',';
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  trim($ErrorTxt,','),
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					$game_date = date('Y-m-d',strtotime($request->game_date));
					$weekDate = date('Y-m-d',strtotime($game_date. " +1 week"));
					
					$GameStats = DB::table('game_stats')->select('game_date','game_stat')
								->where('sports_id', '=', $request->sports_id)
								->where('game_date', '>=', $game_date)
								->where('game_date', '<=', $weekDate)
								->first();
								
					
					if(!empty($GameStats)){
						$game_array = array();
						$i=0;
						$game_data = json_decode($GameStats->game_stat);
						foreach($game_data->match as $gm_data){
							$game_array[$i]['game_id'] = $gm_data->id;
							$game_array[$i]['time'] = $gm_data->time; 
							$game_array[$i]['date'] = $gm_data->formatted_date;
							$i++;
						}
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'Match data available.',
							'data'      =>  $game_array,                       
							'status'    =>  200
						);
					}else{
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'No match available on this date.',
							'status'    =>  200
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 18th DEC 2017
    *** Description : API for Creating a new contest
    *** Params : user_id, sports_id, contest_name, contest_type, entry_limit, challenge_limit, fee, match_id, start_time, prize_pool, fpp_reword, play_type, desctext, match_date, authToken, prize_type
    *** Return : Contest data json
    *********/
	
	public function newContest(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
	
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',
            'sports_id'   		=> 'required|numeric',
            'contest_name'   	=> 'required',
            'contest_type'   	=> 'required|numeric|in:1,2,3,4,5,6',
            'challenge_limit'	=> 'required|numeric',
			'entry_limit'    	=> 'required|numeric',
            'fee'  				=> 'required|numeric',
            'match_id'   		=> 'required|numeric',
            'start_time'   		=> 'required|date|date_format:"Y-m-d H:i:s"',
            'prize_pool'   		=> 'required|numeric',
            'play_type'   		=> 'required|in:0,1',
			'prize_type'  		=> 'required|numeric|in:0,1,2,5,6',
            'desctext'   		=> 'required',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{			
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						
						DB::beginTransaction();
						$Contests = new Contests();
						
						$prizeType = $request->prize_type;
						$Contests->prize_pool = $request->prize_pool;
						$ContestsType = $request->contest_type;
						
						if($ContestsType==3){
							$prizeType = 1;
						}
						if($ContestsType==4){
							$prizeType = 5;
						}
						
						if ($prizeType == 1) {
							$payout[0]['from'] = 1;
							$payout[0]['to'] = 0;
							$payout[0]['type'] = 0;
							$payout[0]['amount'] = $Contests->prize_pool;
							$payout[0]['ticket_id'] = NULL;
							$Contests->prize_payouts = json_encode($payout);
						} elseif ($prizeType == 2) {
							$firstAmt = round($Contests->prize_pool * 0.7);
							$secondAmt = round($Contests->prize_pool * 0.3);
							$payout[0]['from'] = 1;
							$payout[0]['to'] = 0;
							$payout[0]['type'] = 0;
							$payout[0]['amount'] = $firstAmt;
							$payout[0]['ticket_id'] = NULL;
							$payout[1]['from'] = 2;
							$payout[1]['to'] = 0;
							$payout[1]['type'] = 0;
							$payout[1]['amount'] = $secondAmt;
							$payout[1]['ticket_id'] = NULL;
							$Contests->prize_payouts = json_encode($payout);
						} elseif ($prizeType == 5) {
							$limit = $request->entry_limit;
							$range = floor($limit / 2);
							$amt = round($Contests->prize_pool / ($range));
							$payout[0]['from'] = 1;
							$payout[0]['to'] = $range;
							$payout[0]['type'] = 0;
							$payout[0]['amount'] = $amt;
							$payout[0]['ticket_id'] = NULL;
							$Contests->prize_payouts = json_encode($payout);
						} elseif ($prizeType == 6) {
							$from = $request->rank_from; 
							$to = $request->rank_to;
							$type = $request->payout_type;
							$amount = $request->rank_amt;
							$ticketId = $request->ticket_id;
							$aindex = 0;
							$tindex = 0;
							foreach ($from as $key => $value) {
								$payout[$key]['from'] = $from[$key];
								$payout[$key]['to'] = $to[$key];
								$payout[$key]['type'] = $type[$key];
								$payout[$key]['amount'] = NULL;
								$payout[$key]['ticket_id'] = NULL;
								/* payout type is zero means prize is amount */
								if (($type[$key]) == 0) { 
									$payout[$key]['amount'] = $amount[$aindex];
									$aindex++;
								/* prize type is one means prize is ticket */	
								} else if (($type[$key]) == 1) { 
									$payout[$key]['ticket_id'] = $ticketId[$tindex];
									$tindex++;
								}
							}
							$Contests->prize_payouts = json_encode($payout);
						}
									
						$Contests->match_id = $request->match_id;

						$startTime = $request->start_time;
						$matchdate = date("Y-m-d", strtotime($request->start_time));
						$time = date("H:i", strtotime($startTime));
						$date = $matchdate . ' ' . $time;						           
						
						$Contests->created_by = $request->user_id;

						$Contests->start_time = $date;

						$Contests->contest_name = $request->contest_name;

						$Contests->sports_id = $request->sports_id;
						
						$weekDate = date('Y-m-d',strtotime($matchdate. " +1 week"));
						
						$GameStats = DB::table('game_stats')->select('game_date','game_stat')
								->where('sports_id', '=', $request->sports_id)
								->where('game_date', '>=', $matchdate)
								->where('game_date', '<=', $weekDate)
								->first();
								
						if($GameStats) {
							$contest_res = json_decode($GameStats->game_stat,true);
							$matchCount = count($contest_res['match']);
							if ($matchCount == 1) {
								$GameStats = DB::table('game_stats')->select('game_date','game_stat')
											->where('sports_id', '=', $request->sports_id)
											->where('game_date', '>=', $matchdate)
											->get();
								if ($GameStats) {
									$contest_res = array();
									foreach ($GameStats as $res) {
										$game_data = json_decode($res->game_stat, true);
										$contest_res[] = $game_data;
										$matcharraypop = array_pop($game_data['match']);
										$gameLastDate = date('Y-m-d H:i:s', strtotime($game_data['formatted_date'] . ' ' . $matcharraypop['time']));
									}
								}
							} else {
								$lastMatch = array_pop($contest_res['match']);
								$gameLastDate = date('Y-m-d H:i:s', strtotime($lastMatch['formatted_date'] . ' ' . $lastMatch['time']));
							}
						}
		
						switch ($request->sports_id) {
							case 1 :
								$gameLastDate = date('Y-m-d H:i:s', strtotime($gameLastDate . '+4hours'));
								break;

							case 2 :
								$gameLastDate = date('Y-m-d H:i:s', strtotime($gameLastDate . '+4hours'));
								break;

							case 3 :
								$gameLastDate = date('Y-m-d H:i:s', strtotime($gameLastDate . '+3hours'));
								break;

							case 4 :
								$gameLastDate = date('Y-m-d H:i:s', strtotime($gameLastDate . '+3hours'));
								break;
						}
						
						$Contests->end_time = $gameLastDate;
						$startTimeStamp = strtotime($Contests->start_time);
						$endTimeStamp = strtotime($Contests->end_time);
						if ($startTimeStamp == $endTimeStamp) {
							$Contests->end_time = date('Y-m-d H:i:s', strtotime("+5 hours", strtotime($Contests->end_time)));
						}
						
						$Contests->play_limit = $request->entry_limit;
						$Contests->challenge_limit = $request->challenge_limit;
						
						if($ContestsType==3){
							$Contests->play_limit = 2;
							$Contests->challenge_limit = 1;
						}
						
						$Contests->entry_fee = $request->fee;
						$Contests->fpp = (int)(($request->fee)*3.3); 
						$Contests->con_type_id = $request->contest_type;
						$Contests->play_type = $request->play_type;
						$Contests->description = $request->desctext;				   
						
						$Contests->save();
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'Contest has been created successfully.',
							'data'    =>  array('contest_id'=>$Contests->contest_id),
							'status'    =>  200
						);
						
						DB::commit();
						
					}else{
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
				}else{
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for find a contests
    ** Params : user_id, accessToken, authToken, contest_id Here contest_id is optional which denotes the contest id if you will not send its value then it will give value of all active contest. As it was mentioned in the requirement
    *** Return : Contest data json
    *********/
	
	public function getActiveContest(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'contest_id'   		=> 'nullable|numeric',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						if(empty($request->contest_id)){
							$Contests = Contests::where('status',1)->orderBy('contest_id', 'DESC')->get();
						}else{
							$Contests = Contests::where('contest_id',$request->contest_id)->first();
						}
						
						if($Contests){
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'Contest details.',
								'data'    =>  $Contests,
								'status'    =>  200
							);
						}else{
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'No record found in database.',
								'data'    =>  '',
								'status'    =>  200
							);
						}
						
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for fetching the players
    *** Params : 1 . accessToken  2 . user_id  3 . contest_id  4 .  method 5 .  searchKey  6 . searchValue  7 . sportId .
    *** Return : Contest data json
    *********/
	
	public function filterPlayer(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'contest_id'   		=> 'required|numeric',            
            'searchKey'   		=> 'required',            
            'searchValue'   	=> 'required',            
            'sports_id'   		=> 'required|numeric',              
            'method'   			=> 'required',              
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){					
					$Abbreviations = Abbreviations::getInstance();
		
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						
						$Contests = Contests::where('contest_id',$request->contest_id)->first();
						if($Contests){
							$game_date = date('Y-m-d', strtotime($Contests->start_time));
							$weekDate = date('Y-m-d',strtotime($game_date. " +1 week"));
			
							$GameStats = DB::table('game_stats')->select('game_date','game_stat')
										->where('sports_id', '=', $request->sports_id)
										->where('game_date', '>=', $game_date)
										->where('game_date', '<=', $weekDate)
										->first();
										
							switch ($request->sports_id) {
								case 1:
									$abbreviation = $Abbreviations->getNFLAbbreviations();
									break;
									
								case 2:
									$abbreviation = $Abbreviations->getMLBAbbreviations();
									break;
									
								case 3:
									$abbreviation = $Abbreviations->getNBAAbbreviations1();
									
									break;
									
								case 4:
									$abbreviation = $Abbreviations->getNHLAbbreviations();
									break;

								default:
									break;
							}
							
						}
						
						if (isset($GameStats)) {
							$contest_res = json_decode($GameStats->game_stat, true);
							
							$contestDate = strtotime(date('Y-m-d', strtotime($Contests->start_time)));
							$contestTimeStamp = strtotime($Contests->start_time);
							
							foreach ($contest_res['match'] as $crkey => $crData) {
								$matchTimeStamp = strtotime($crData['formatted_date'] . $crData['time']);
								if ($matchTimeStamp < $contestTimeStamp) { 
									unset($contest_res['match'][$crkey]);
								}
							}
							   
							$matchCount = count($contest_res['match']);
							if ($matchCount == 1) {
								$GameStats = DB::table('game_stats')->select('game_date','game_stat')
										->where('sports_id', '=', $request->sports_id)
										->where('game_date', '>=', $game_date)
										->get();
								
								if ($GameStats) {
									$contest_res = array();
									foreach ($GameStats as $res) {
										$game_stat = json_decode($res->game_stat, true);
										foreach ($game_stat['match'] as $gkey => $gVal) {
											$matchTimeStamp = strtotime($gVal['formatted_date'] . $gVal['time']);
											if ($matchTimeStamp < $contestTimeStamp) {
												unset($game_stat['match'][$gkey]);
											}
										}
										$contest_res[] = $game_stat;
										$matcharraypop = array_pop($game_stat['match']);
									}
								}
							}
							
							if (isset($abbreviation)) {
								$abbreviation = (array)json_decode($abbreviation);
								
								$teamCode = array();
								$team = array();
								$i = 0;

								if ($matchCount != 1) {
									
									foreach ($contest_res['match'] as $matchDetails) {
										
										$hometeamName = array_search($matchDetails['hometeam']['name'], $abbreviation); 
										$awayteamName = array_search($matchDetails['awayteam']['name'], $abbreviation);
										
										$teamCode[$i]['time'] = $matchDetails['formatted_date'] . $matchDetails['time'];
										$teamCode[$i]['hometeam']['name'] = $hometeamName;
										$teamCode[$i]['hometeam']['id'] = $matchDetails['hometeam']['id'];
										$teamCode[$i]['awayteam']['name'] = $awayteamName;
										$teamCode[$i]['awayteam']['id'] = $matchDetails['awayteam']['id'];
										$team[$hometeamName] = $awayteamName;
										$team[$awayteamName] = $hometeamName;
										$i++;
									}
								} else {

									foreach ($contest_res as $conres) {

										foreach ($conres['match'] as $matchDetails) {
											$hometeamName = array_search($matchDetails['hometeam']['name'], $abbreviation);
											$awayteamName = array_search($matchDetails['awayteam']['name'], $abbreviation);
											$teamCode[$i]['time'] = $matchDetails['formatted_date'] . $matchDetails['time'];
											$teamCode[$i]['hometeam']['name'] = $hometeamName;
											$teamCode[$i]['hometeam']['id'] = $matchDetails['hometeam']['id'];
											$teamCode[$i]['awayteam']['name'] = $awayteamName;
											$teamCode[$i]['awayteam']['id'] = $matchDetails['awayteam']['id'];
											$team[$hometeamName] = $awayteamName;
											$team[$awayteamName] = $hometeamName;
											$i++;
										}
									}
								}
								
								if (!empty($teamCode)) {
									$teamIds = array();
									
									foreach ($teamCode as $key => $value) {
										$teamIds[$value['hometeam']['name']] = $value['hometeam']['id'];
										$teamIds[$value['awayteam']['name']] = $value['awayteam']['id'];
									}
									
									$hometeam = array_map(function($item) {
												return strtolower($item['hometeam']['name']);
											}, $teamCode);
									$awayteam = array_map(function($item) {
												return strtolower($item['awayteam']['name']);
											}, $teamCode);
									
									/* merge hometeam and away team to get players   */
									$mergeTeamName = array_merge($hometeam, $awayteam);
									
									//$teamString = implode("','", $mergeTeamName);
									
									$playerLists = DB::table('game_players')->select('game_players.*')
										->where('sports_id', '=', $Contests->sports_id)
										->where('status', '=', 1)
										->whereIn('plr_team_code',$mergeTeamName)
										->get();
									
								}
								
								$playerListArray = array();
								if (!empty($playerLists)) {
									foreach ($playerLists as $plrkey => $plrvalue) {
										$dencode = json_decode($plrvalue->plr_details, true);
										if (isset($dencode)) {
											$playerListArray[$plrkey] = $dencode;
											$playerListArray[$plrkey]['team_vs'] = $team[$dencode['team_code']];
											$playerListArray[$plrkey]['team_id'] = $teamIds[$dencode['team_code']];
											$playerListArray[$plrkey]['fppg'] = $plrvalue->fppg;
											$playerListArray[$plrkey]['plr_value'] = $plrvalue->plr_value;
											$playerListArray[$plrkey]['injury_status'] = $plrvalue->injury_status;
										}
									}
								}
								
							}
						}
						
						if(isset($request->method)){
							
							switch ($request->method) {
								
								case 'teamfilter':
									
									$validation = Validator::make($request->all(), [
										'team'		    => 'required',
									]);
									if ($validation->fails()) { 
										$i=0;
										foreach($validation->errors()->all() as $error){ 
											$ErrorTxt[$i] = $error;
											$i++;
										}
										$returnArr = array(
											'error'     =>  1,
											'message'   =>  'validation failed',
											'reason'    =>  $ErrorTxt,
											'status'    =>  400
										);
									}else{
										$teamfilter = $request->team;
										$searchValue = $request->searchValue;
										$searchKey = $request->searchKey;
										$filterPlayerList = $this->filterArray($searchValue, $playerListArray, $searchKey, $teamfilter);
									}
									
									break;

								case 'playerfilter':
								
									$validation = Validator::make($request->all(), [
										'selectedTeam'  => 'required',
									]);
									if ($validation->fails()) { 
										$i=0;
										foreach($validation->errors()->all() as $error){ 
											$ErrorTxt[$i] = $error;
											$i++;
										}
										$returnArr = array(
											'error'     =>  1,
											'message'   =>  'validation failed',
											'reason'    =>  $ErrorTxt,
											'status'    =>  400
										);
									}else{
										$searchValue = $request->searchValue;
										$searchKey = $request->searchKey;
										$teamfilter = $request->selectedTeam;
										$sportId = $request->sports_id;
										if (($searchValue == "FLEX" && $sportId == 1 ) || ($searchValue == "F" && $sportId == 3 ) || ($searchValue == "G" && $sportId == 3 ) || $searchValue == "UTIL") {
											if ($teamfilter[0] != "All Games") { 
											
												$playerListArray = $this->specialPlayer($sportId, $searchValue, $searchKey, $teamfilter,$playerListArray);
											} else {
												$playerListArray = $this->specialPlayer($sportId, $searchValue,$searchKey,'',$playerListArray);
											}
											$value = array();
											foreach ($playerListArray as $key => $row) {
												$value[$key] = $row['plr_value'];
											}
											array_multisort($value, SORT_DESC, $playerListArray);
											
										} else {

											if ($searchValue == "ALL" && empty($teamfilter)) {
												$value = array();
												foreach ($playerListArray as $key => $row) {
													$value[$key] = $row['plr_value'];
												}
												array_multisort($value, SORT_DESC, $playerListArray);
												
											} else {
												if ($teamfilter[0] != "All Games") {
													$filterPlayerList = $this->filterArray($searchValue, $playerListArray, $searchKey, $teamfilter);
												} else {
													$filterPlayerList = $this->filterArray($searchValue, $playerListArray, $searchKey);
												}

												$value = array();
												foreach ($filterPlayerList as $key => $row) {
													$value[$key] = $row['plr_value'];
												}
												array_multisort($value, SORT_DESC, $filterPlayerList);
												
											}
										}
									}
																							
									break;

								case 'playerByTeam':
								
									$validation = Validator::make($request->all(), [
										'searchPos'   => 'required',
										'searchTeam'  => 'required',
									]);
									if ($validation->fails()) { 
										$i=0;
										foreach($validation->errors()->all() as $error){ 
											$ErrorTxt[$i] = $error;
											$i++;
										}
										$returnArr = array(
											'error'     =>  1,
											'message'   =>  'validation failed',
											'reason'    =>  $ErrorTxt,
											'status'    =>  400
										);
									}else{
										$searchPos 	= $request->searchPos;
										$searchTeam = $request->searchTeam;
										$searchKey 	= $request->searchKey;
										$sportId 	= $request->sports_id;
										
										if (($searchPos == "FLEX" && $sportId == 1 ) || ($searchPos == "F" && $sportId == 3 ) || ($searchPos == "G" && $sportId == 3 ) || $searchPos == "UTIL") {
											if ($searchTeam[0] != "All Games") {
												$playerListArray = $this->specialPlayer($sportId, $searchPos, $searchKey, $searchTeam,$playerListArray);
											} else {
												$playerListArray = $this->specialPlayer($sportId, $searchPos, $searchKey,'',$playerListArray);
											}

											echo json_encode($playerListArray);
										} else {

											if ($searchPos == "ALL") {
												echo json_encode($playerListArray);
											} else {

												if ($searchTeam[0] != "All Games") {
													$filterPlayerList = $this->filterTeamArray($searchPos, $playerListArray, $searchKey, $searchTeam);
												} else {
													$filterPlayerList = $this->filterTeamArray($searchPos, $playerListArray, $searchKey);
												}
											}
										}
									}
									
									break;
									
								default:
									break;
							}
						}
						
						if ($filterPlayerList) {							
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'All record.',
								'data'  	=>  $filterPlayerList,
								'status'    =>  200
							);
						}else{
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'No record found.',
								'data'  	=>  '',
								'status'    =>  200
							);
						}												
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	/**
     * Desc : Filter Array by searchkey and searchvalue
     * @param <String> $searchValue
     * @param <Array> $array
     * @param <String> $searchKey
     * @return <Array> $filtered
     */
    public function filterArray($searchValue, $playerListArray, $searchKey, $team = null) {
		$GameXml = GameXml::getInstance();
        if ($searchValue != "" && !empty($playerListArray) && $searchKey != "" && $team == null) {
            
            if ($searchValue != 'All Games') {
                $filterPlayerList = $GameXml->filterArray($searchValue, $playerListArray, $searchKey);
                return $filterPlayerList;
            } else {
                return $playerListArray;
            }
        }

        if ($searchValue != "" && !empty($playerListArray) && $searchKey != "" && $team != null) {

            $filterPlayerList = array();
            foreach ($team as $code) {
                if ($code != "") {

                    $searchTeamValue = $code;
                    $searchTeamKey = 'team_code';
                    $filterPlayerList[] = $GameXml->filterArray($searchTeamValue, $playerListArray, $searchTeamKey);
                }
            }

            if (!empty($filterPlayerList)) {

                if (count($filterPlayerList) > 1) {

                    $playerList = array();
                    foreach ($filterPlayerList as $data) {
                        $playerList = array_merge($playerList, $data);
                    }

                    if (!empty($playerList)) {
                        if ($searchValue == "ALL") {
                            return $playerList;
                        } else {
                            $newPlayerList = $GameXml->filterArray($searchValue, $playerList, $searchKey);
                            return $newPlayerList;
                        }
                    }
                } else {
                    $playerList = array();
                    foreach ($filterPlayerList as $data) {
                        $playerList = array_merge($playerList, $data);
                    }
                    $newPlayerList = $GameXml->filterArray($searchValue, $playerList, $searchKey);
                    return $newPlayerList;
                }
            }
        }
    }
	
	/**
     * Desc : specialPlayer Array by searchkey and searchvalue
     * @param <String> $searchValue
     * @param <Array> $array
     * @param <String> $searchKey
     * @return <Array> $filterPlayerList
     */
	 
	public function specialPlayer($sportId, $searchValue, $searchKey,$teamfilter = null,$playerListArray) {
        
        switch ($sportId):
            case 1 :
                if ($searchValue === "FLEX") {
                    $filterPlayerList = array();
                    $searchValueArray = array("WR", "TE", "RB");
                    foreach ($searchValueArray as $searchValue) {
                        if ($teamfilter != null || $teamfilter[0] != "All Games") { 
                            $searchdata = $this->filterTeamArray($searchValue, $playerListArray, $searchKey, $teamfilter);
                        } else {
                            $searchdata = $this->filterArray($searchValue, $playerListArray, $searchKey);
                        }

                        $filterPlayerList = array_merge($filterPlayerList, $searchdata);
                    }
                    if ($filterPlayerList) {
                        return $filterPlayerList;
                    }
                }
                break;
				
            case 2 :
                /*  no such condition for MLB sport players */
                break;
				
            case 3 :
                if ($searchValue === "G") {
                    $filterPlayerList = array();
                    $searchValueArray = array("SG", "PG");
                    foreach ($searchValueArray as $searchValue) {
                        if ($teamfilter != null || $teamfilter[0] != "All Games") {
                            $searchdata = $this->filterTeamArray($searchValue, $playerListArray, $searchKey, $teamfilter);
                        } else {
                            $searchdata = $this->filterArray($searchValue, $playerListArray, $searchKey);
                        }
                        $filterPlayerList = array_merge($filterPlayerList, $searchdata);
                    }
                    if ($filterPlayerList) {
                        return $filterPlayerList;
                    }
                } else if ($searchValue === "F") {
                    $filterPlayerList = array();
                    $searchValueArray = array("SF", "PF");
                    foreach ($searchValueArray as $searchValue) {
                        if ($teamfilter != null || $teamfilter[0] != "All Games") {
                            $searchdata = $this->filterTeamArray($searchValue, $playerListArray, $searchKey, $teamfilter);
                        } else {
                            $searchdata = $this->filterArray($searchValue, $playerListArray, $searchKey);
                        }
                        $filterPlayerList = array_merge($filterPlayerList, $searchdata);
                    }
                    if ($filterPlayerList) {
                        return $filterPlayerList;
                    }
                } else if ($searchValue === "UTIL") {
                    $filterPlayerList = array();
                    $searchValueArray = array("SF", "PF", "SG", "PG");
                    foreach ($searchValueArray as $searchValue) {
                        if ($teamfilter != null || $teamfilter[0] != "All Games") {
                            $searchdata = $this->filterTeamArray($searchValue, $playerListArray, $searchKey, $teamfilter);
                        } else {
                            $searchdata = $this->filterArray($searchValue, $playerListArray, $searchKey);
                        }
                        $filterPlayerList = array_merge($filterPlayerList, $searchdata);
                    }
                    if ($filterPlayerList) {
                        return $filterPlayerList;
                    }
                }
                break;
				
            case 4 :
                if ($searchValue === "UTIL") {
                    $filterPlayerList = array();
                    $searchValueArray = array("C", "W", "D");
                    foreach ($searchValueArray as $searchValue) {
                        if ($teamfilter != null || $teamfilter[0] != "All Games") {
                            $searchdata = $this->filterTeamArray($searchValue, $playerListArray, $searchKey, $teamfilter);
                        } else {
                            $searchdata = $this->filterArray($searchValue, $playerListArray, $searchKey);
                        }
                        $filterPlayerList = array_merge($filterPlayerList, $searchdata);
                    }
                    if ($filterPlayerList) {
                        return $filterPlayerList;
                    }
                }
                break;
				
        endswitch;
    }
	
	public function filterTeamArray($searchPos, $playerListArray, $searchKey, $searchTeam = null) {
		$GameXml = GameXml::getInstance();
        if ($searchPos != "" && !empty($playerListArray) && $searchKey != "" && $searchTeam == null) {
            $filterPlayerList = $GameXml->filterArray($searchPos, $playerListArray, 'pos_code');
            return $filterPlayerList;
        }

        if ($searchPos != "" && !empty($playerListArray) && $searchKey != "" && !empty($searchTeam)) {            
            $filterPlayerList = array();
            foreach ($searchTeam as $code) {
                if ($code != "") { 
                    $filterPlayerList[] = $GameXml->filterArray($code, $playerListArray, 'team_code');
                }
            }
			
            if (!empty($filterPlayerList)) {
                $playerList = array();
                foreach ($filterPlayerList as $data) {
                    $playerList = array_merge($playerList, $data);
                }

                if (!empty($playerList)) {
                    $newPlayerList = $GameXml->filterArray($searchPos, $playerList, 'pos_code');
                    return $newPlayerList;
                }
            }
        }
    }
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for save a linup
    *** Params : 1. method 2. sports_id 3. conid 4. start_time 5. rem_salary 6. end_time 7. user_balance 8. lineup 9. pos_details 10. accessToken 11. user_id
    *** Return : Contest data json
    *********/
	
	public function saveLineup(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',                    
            'sports_id'   		=> 'required',            
            'pos_details'   	=> 'required',            
            'player_ids'   		=> 'required',            
            'conid'   			=> 'required|numeric',            
            'start_time'   		=> 'required|date|date_format:"Y-m-d H:i:s"',            
            'rem_salary'   		=> 'required|min:1|max:50000',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						/* save lineup section is start here */
						$user_id 		= $request->user_id;
						$ticketId 		= $request->ticketid;
						$ticketStatus	= $request->tstatus;
						$lineup 		= $request->player_ids;
						$sports_id 		= $request->sports_id;
						$conid 			= $request->conid;
						$start_time 	= $request->start_time;
						$remSalary 		= $request->rem_salary;
						$current_date 	= date('Y-m-d H:i:s');
						$pos_details 	= $request->pos_details;
						$response_array = array();	
						
						switch($sports_id){
							case 1:					
								if(count($lineup)==10){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								   if($lineup[9] == null || $lineup[9] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'QB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'RB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'RB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'TE'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'FLEX'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[9][$lineup[9]] != 'K'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] != 'DST'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
							   break;						
							case 2:					
								if(count($lineup)==10){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								   if($lineup[9] == null || $lineup[9] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'P'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'P'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'C'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != '1B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != '2B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != '3B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'SS'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'OF'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] != 'OF'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
							   break;
							case 3;
								if(count($lineup)==8){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'PG'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'SG'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'SF'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != 'PF'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'C'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != 'G'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'F'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'UTIL'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
							break;
							case 4;
									
								if(count($lineup)==9){
									
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									
								}
								
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'C'){  
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'C'){									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'W'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[3][$lineup[3]] != 'W'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'W'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[5][$lineup[5]] != 'D'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'D'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[7][$lineup[7]] != 'G'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[8][$lineup[8]] != 'UTIL'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
							break;							
						}
						
						$Contests = Contests::where('contest_id',$conid)->first();
						
						if($Contests){
							$plrPosDet = array();

							array_walk_recursive($pos_details, function($key, $val) use (&$plrPosDet) {
										$plrPosDet[$val] = $key;
									});
									
							$userId =$user_id;
							
							$Lineup = new Lineup();
							$Lineup->sports_id = $sports_id;
							$Lineup->start_time = $start_time;
							$Lineup->player_ids = json_encode($lineup);
							$Lineup->pos_details = json_encode($plrPosDet);
							$Lineup->rem_salary = $remSalary;
							$Lineup->created_by = $userId;
							
							$User = User::where('users.user_id',$userId)->leftjoin('user_account','users.user_id','=','user_account.user_id')->first();
							
							if(!empty($User)){
								$allowEntry = true; 
								$allowStatus = 1; 
								/* default entry */
								/* check user having the valid ticket to enter the contest */
								/* $objTicketUserModel = Application_Model_TicketUsers::getInstance(); */
								if (isset($ticketStatus) && $ticketStatus != 0 && isset($ticketId) && $ticketId != 0) {
									/* check user is using ticket */
									$ticketUser['user_id'] = $userId;
									$ticketUser['ticket_id'] = $ticketId;
									$ticketUser['contest_id'] = $conid;
									$ticketUser['use_date'] = date('Y-m-d');
									
									/* $objTicketUserModel->insertTicketUser($ticketUser); */
									$allowStatus = 3; /* entry by ticket */
								}
								
								if($allowStatus ==1){
									if (isset($Contests->offers_to) && $Contests->offers_to != null) { 
										/* check user is offered for this contest entry */
										$offeredUsers = json_decode($Contests->offers_to, true);
										$checkoffer = in_array($userId, $offeredUsers);
										if ($checkoffer != false) {
											$allowEntry = true;
											$allowStatus = 2; /* entry by offer */
										}
									}
								}
							   
								if($allowStatus ==1){
									if($Contests->entry_fee != 0){ 
										/* check for user balance */
										if($Contests->entry_fee > $User->balance_amt){
											$allowEntry = false;
											$returnArr = array(
												'error'     =>  1,
												'message'   =>  'Insufficient Balance.',
												'reason'    =>  'You do not have sufficient amount to Make an Entry',
												'status'    =>  198
											);
										}
									}
								}
								
								if($allowEntry){ 
									/* check of contest entry limit */
									if($Contests->play_limit !=0 ){
										if ($Contests->total_entry == $Contests->play_limit) {
											$allowEntry = false;
											$returnArr = array(
												'error'     =>  1,
												'message'   =>  'Entry Full.',
												'reason'    =>  'Contest Entry is Full',
												'status'    =>  198
											);
										}
									}
								}
							   
								if($allowEntry){
									
									$entryCheck = DB::table('user_lineup')
										->join('lineup', 'user_lineup.lineup_id', '=', 'lineup.lineup_id')
										->select('user_lineup.*', 'lineup.*')
										->where('user_lineup.contest_id', '=',$conid)
										->where('lineup.created_by', '=',$userId)
										->count();
										
									if(isset($entryCheck) && !empty($entryCheck)){
										if($Contests->challenge_limit != 0){
											if($entryCheck == $Contests->challenge_limit){
												$allowEntry = false;
												$returnArr = array(
													'error'     =>  1,
													'message'   =>  'Invalid Entry.',
													'reason'    =>  'You already entered into this contest',
													'status'    =>  198
												);
												
											}
										}else{
											$allowEntry = false;
											$returnArr = array(
												'error'     =>  1,
												'message'   =>  'Invalid Entry.',
												'reason'    =>  'You already entered into this contest',
												'status'    =>  198
											);
										}
									}
								}
							 
								if($allowEntry){
									
									$Lineup->save(); 
									if (isset($Lineup->lineup_id)) {
										$UserLineup = new UserLineup();
										$UserLineup->lineup_id 		= $Lineup->lineup_id;
										$UserLineup->contest_id 	= $conid;
										$UserLineup->status 		= 1;
										$UserLineup->created_date	= $current_date;
										
										$UserLineup->save();
										
										if($allowStatus == 1){ 
											/* entry by balance amount */
											$fee_val = $Contests->entry_fee;
											
											DB::table('user_account')->where('user_id',$userId)->update(['balance_amt' => DB::raw('balance_amt - "$fee_val"')]);
											
											$UserTransactions = new UserTransactions();
											
											$UserTransactions->user_id = $userId;
											$UserTransactions->transaction_type   = 'From Balance';
											$UserTransactions->transaction_amount = $Contests->entry_fee;
											$UserTransactions->confirmation_code  = 'N/A';
											$UserTransactions->description        = 'Entry Fee';
											$UserTransactions->status             = '1';
											$UserTransactions->request_type 	  = '6';
											$UserTransactions->transaction_date   =  date('Y-m-d');
											$UserTransactions->save();
											
											if(isset($UserTransactions->transaction_id)){
												/* changes for contest details in transaction history */
												$ContestTransactions = new ContestTransactions();
												$ContestTransactions->transaction_id = $UserTransactions->transaction_id;
												$ContestTransactions->contest_id 	 = $Contests->contest_id;
												$ContestTransactions->user_id 		 = $userId;
												$ContestTransactions->save();
												
											}
										}
										
										DB::table('contests')->where('contest_id',$conid)->update(['total_entry' => DB::raw('total_entry + 1')]);
										
										$returnArr = array(
											'error'     =>  0,
											'message'   =>  'Lineup has added successfully.',
											'data'    =>  array('lineupId'=>$Lineup->lineup_id),
											'status'    =>  200
										);
										
									}else{
										$returnArr = array(
											'error'     =>  1,
											'message'   =>  'Opps something went wrong.',
											'reason'    =>  'Error Occured, Please try again',
											'status'    =>  198
										);
									}
								}
							}else{
								$returnArr = array(
									'error'     =>  1,
									'message'   =>  'Opps something went wrong.',
									'reason'    =>  'Invalid userAccount',
									'status'    =>  198
								);
							}
							   
							/* save lineup section is end here */
						}else{
							$returnArr = array(
								'error'     =>  1,
								'message'   =>  'Opps something went wrong.',
								'reason'    =>  'Contest not found in database',
								'status'    =>  198
							);
						}
						
												
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for save a linup
    *** Params : 1. method 2. sports_id 3. conid 4. start_time 5. rem_salary 6. end_time 7. user_balance 8. lineup 9. pos_details 10. accessToken 11. user_id
    *** Return : Contest data json
    *********/
	
	public function editLineup(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',                    
            'sports_id'   		=> 'required|numeric',        
            'lineup_id'   		=> 'required|numeric',           
            'start_time'   		=> 'required|date',            
            'rem_salary'   		=> 'required|min:1|max:50000',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						/* save lineup section is start here */
						/* save lineup section is start here */
						$user_id 		= $request->user_id;
						$lineup_id 		= $request->lineup_id;
						$ticketId 		= $request->ticketid;
						$ticketStatus	= $request->tstatus;
						$lineup 		= $request->player_ids;
						$sports_id 		= $request->sports_id;
						$start_time 	= $request->start_time;
						$remSalary 		= $request->rem_salary;
						$current_date 	= date('Y-m-d H:i:s');
						$pos_details 	= $request->pos_details;
						$response_array = array();	
						
						switch($sports_id){
							case 1:					
								if(count($lineup)==10){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								   if($lineup[9] == null || $lineup[9] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'QB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'RB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'RB'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != 'WR'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'TE'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'FLEX'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[9][$lineup[9]] != 'K'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] != 'DST'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
							   break;						
							case 2:					
								if(count($lineup)==10){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								   if($lineup[9] == null || $lineup[9] == ""){
										$response_array = array('message'=>'Please choose ninth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'P'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'P'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'C'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != '1B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != '2B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != '3B'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'SS'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'OF'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] != 'OF'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
							   break;
							case 3;
								if(count($lineup)==8){
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
								}
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'PG'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'SG'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'SF'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[3][$lineup[3]] != 'PF'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'C'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] != 'G'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'F'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] != 'UTIL'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
							break;
							case 4;
									
								if(count($lineup)==9){
									
									if($lineup[0] == null || $lineup[0] == ""){
										$response_array = array('message'=>'Please choose first player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[1] == null || $lineup[1] == ""){
										$response_array = array('message'=>'Please choose secound player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[2] == null || $lineup[2] == ""){
										$response_array = array('message'=>'Please choose third player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[3] == null || $lineup[3] == ""){
										$response_array = array('message'=>'Please choose fourth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[4] == null || $lineup[4] == ""){
										$response_array = array('message'=>'Please choose fifth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[5] == null || $lineup[5] == ""){
										$response_array = array('message'=>'Please choose sixth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}	
									if($lineup[6] == null || $lineup[6] == ""){
										$response_array = array('message'=>'Please choose seventh player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[7] == null || $lineup[7] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									if($lineup[8] == null || $lineup[8] == ""){
										$response_array = array('message'=>'Please choose eighth player.','data_status'=> 0);
										echo json_encode($response_array); die;
									}
									
								}
								
								if($pos_details[0][$lineup[0]] == null || $pos_details[0][$lineup[0]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[0][$lineup[0]] != 'C'){  
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								
								if($pos_details[1][$lineup[1]] == null || $pos_details[1][$lineup[1]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[1][$lineup[1]] != 'C'){									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								
								if($pos_details[2][$lineup[2]] == null || $pos_details[2][$lineup[2]] == ""){
									$response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									echo json_encode($response_array); die;
								}
								if($pos_details[2][$lineup[2]] != 'W'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									echo json_encode($response_array); die;
								} 
								if($pos_details[3][$lineup[3]] == null || $pos_details[3][$lineup[3]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[3][$lineup[3]] != 'W'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] == null || $pos_details[4][$lineup[4]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[4][$lineup[4]] != 'W'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[5][$lineup[5]] == null || $pos_details[5][$lineup[5]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[5][$lineup[5]] != 'D'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] == null || $pos_details[6][$lineup[6]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[6][$lineup[6]] != 'D'){
									
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[7][$lineup[7]] == null || $pos_details[7][$lineup[7]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[7][$lineup[7]] != 'G'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								if($pos_details[8][$lineup[8]] == null || $pos_details[8][$lineup[8]] == ""){
									 $response_array = array('message'=>'Please enter palyer position .','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
								if($pos_details[8][$lineup[8]] != 'UTIL'){
									$response_array = array('message'=>'Position already filled.','data_status'=> 0);
									 echo json_encode($response_array); die;
								}
								
							break;							
						}
						
						
						$plrPosDet = array();

						array_walk_recursive($pos_details, function($key, $val) use (&$plrPosDet) {
									$plrPosDet[$val] = $key;
								});
								
						$userId =$user_id;
						
						$Lineup = Lineup::find($request->lineup_id);						
						$Lineup->player_ids = json_encode($lineup);
						$Lineup->pos_details = json_encode($plrPosDet);
						$Lineup->rem_salary = $remSalary;
						$Lineup->created_by = $userId;
						$Lineup->update();
						
						$returnArr = array(
							'error'     =>  0,
							'message'   =>  'Lineup has updated successfully.',
							'data'    	=>  array('lineupId'=>$lineup_id),
							'status'    =>  198
						);
						
						/* update lineup section is end here */
												
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for get lineup details
    *** Params : user_id, authToken,lineup_id
    *** Return : Contest data json
    *********/
	
	public function getLineupDetails(Request $request){
		$returnArr = array();
		$ErrorTxt = array();		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'lineup_id'   		=> 'required|numeric',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						
						$UserLineup = DB::table('user_lineup')
								->join('lineup', 'user_lineup.lineup_id', '=', 'lineup.lineup_id')
								->join('contests', 'user_lineup.contest_id', '=', 'contests.contest_id')
								->select('user_lineup.*', 'lineup.*', 'contests.*')
								->where('lineup.lineup_id', $request->lineup_id)
								->first();
								
						if($UserLineup){
							
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'Lineup details.',
								'data'    	=> $UserLineup,
								'status'    =>  200
							);
						}else{
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'No record found in database.',
								'data'    => '',
								'status'    =>  200
							);
						}
						
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for remove player from lineup
    *** Params : 1. lineup_id 2. player_id 3. user_id 4. accessToken 5. authToken
    *** Return : deleted player id
    *********/
	
	public function removePlayerFromLineup(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'player_id'   		=> 'required|numeric',            
            'lineup_id'   		=> 'required|numeric',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						/* remove player section start here */
						
						$Lineup = Lineup::where('lineup_id',$request->lineup_id)->first();
						if($Lineup){
							$count_payers=count(json_decode($Lineup->player_ids,true));
							$player_ids=json_decode($Lineup->player_ids,true); 
							
							if(in_array($request->player_id,$player_ids)){
								$key =  array_search($request->player_id,$player_ids);	
								unset($player_ids[$key]);
								$pos_details=json_decode($Lineup->pos_details,true);
								unset($pos_details[$request->player_id]);
								
								$Lineup->player_ids  = json_encode($player_ids);
								$Lineup->pos_details = json_encode($pos_details);
								$Lineup->update();
								
								$returnArr = array(
									'error'     =>  0,
									'message'   =>  'Player has been deleted successfully.',
									'data'    	=>  array('player_id'=>$request->player_id),
									'status'    =>  200
								);
								
							}else{
								$returnArr = array(
									'error'     =>  1,
									'message'   =>  'Player id  not valid.',
									'reason'    =>  'Supplied Player id is not valid',
									'status'    =>  198
								);
							}
						}
						
						/* remove player section end here */
						
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API for add player to lineup
    *** Params : user_id, authToken, lineup_id, player_id, player_position
    *** Return : Output will be in the form of JSON.
    *********/
	
	public function addPlayerToLineup(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'player_id'   		=> 'required|numeric',            
            'lineup_id'   		=> 'required|numeric',            
            'player_position'   => 'required',            
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						/* remove player section start here */
						
						$Lineup = Lineup::where('lineup_id',$request->lineup_id)->first();
						if($Lineup){
							$count_players=count(json_decode($Lineup->player_ids,true));
							$player_ids=json_decode($Lineup->player_ids,true); 
							
							if($count_players<10){
								array_push($player_ids,$request->player_id);
								$pos_details=json_decode($Lineup->pos_details,true);
								$pos_details[$request->player_id]=$request->player_position;
								
								$Lineup->player_ids  = json_encode($player_ids);
								$Lineup->pos_details = json_encode($pos_details);
								$Lineup->update();
								
								$returnArr = array(
									'error'     =>  0,
									'message'   =>  'Player has been added successfully.',
									'data'    	=>  array('player_id'=>$request->player_id),
									'status'    =>  200
								);
								
							}else{
								$returnArr = array(
									'error'     =>  1,
									'message'   =>  'Player positions already filled.',
									'reason'    =>  'Supplied Player positions is already filled',
									'status'    =>  198
								);
							}
						}
						
						/* remove player section end here */
						
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
	/**********
    *** Author : Prince Kumar Dwivedi
    *** Date   : 22th DEC 2017
    *** Description : API For find the applicable matches of a sport  from a given date
    *** Params : user_id, authToken, lineup_id, sports_id, game_date
    *** Return : Output will be in the form of JSON.
    *********/
	
	public function getApplicableMatch(Request $request){
		$returnArr = array();
		$ErrorTxt = array();
		
		$validation = Validator::make($request->all(), [
            'accessToken'		=> 'required',
			'authToken'   		=> 'required',
            'user_id'   		=> 'required|numeric',            
            'sports_id'   		=> 'required|numeric',            
            'game_date'   		=> 'required|date|date_format:"Y-m-d"',     
        ]);
		
		if ($validation->fails()) { 
			$i=0;
            foreach($validation->errors()->all() as $error){ 
                $ErrorTxt[$i] = $error;
				$i++;
            }
            $returnArr = array(
                'error'     =>  1,
                'message'   =>  'validation failed',
                'reason'    =>  $ErrorTxt,
                'status'    =>  400
            );
        }else{
			try{
				$isValid = $this->validateAccessToken($request->accessToken);
				
				if($isValid){
					
					$matchKeys = ['user_id' =>$request->user_id, 'access_token' => $request->authToken];
					$UserDetail = User::where($matchKeys)->first();
					if($UserDetail) {
						/* get match section start here */
						$end_date=date('Y-m-d');
						$GameStats = DB::table('game_stats')->select('game_date','game_stat')
								->where('sports_id', '=', $request->sports_id)
								->where('game_date', '>=', $request->game_date)
								->where('game_date', '<=', $end_date)
								->get();
						
						if(!empty($GameStats)){
							$j=0;
							$data=array();
							foreach($GameStats as $type_list){
								$game_data = json_decode($type_list->game_stat , true);
								$i=0;
								$my_array = array();
								foreach($game_data['match'] as $gm_data){
									$my_array[$i]['game_id'] = $gm_data['id'];
									$my_array[$i]['time'] = $gm_data['time']; 
									$my_array[$i]['date'] = $gm_data['formatted_date'];
									$i++;
								}
								$data[$j]['match']=	$my_array;				
								$j++;
							}
							
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'Match data available.',
								'data'    	=>  $data,
								'status'    =>  200
							);
							
							
						}else{
							$returnArr = array(
								'error'     =>  0,
								'message'   =>  'No match available on this date.',
								'data'    	=>  '',
								'status'    =>  200
							);
						}
			
						/* get match section end here */
						
					}else{
						
						$returnArr = array(
							'error'     =>  1,
							'message'   =>  'Authentication Failed.',
							'reason'    =>  'Supplied authToken or user_id is not valid',
							'status'    =>  198
						);
					}
					
				}else{
					
					$returnArr = array(
						'error'     =>  1,
						'message'   =>  'accessToken does not valid.',
						'reason'      =>  'accessToken session has been expired or invalid.',
						'status'    =>  422
					); 
				}
				
				
			}catch(\Illuminate\Database\QueryException $e){
                
                $returnArr = array(
                    'error'     =>  1,
                    'message'   =>  'Oops ! some thing is wrong.',
                    'reason'      =>  $e->getMessage(),
                    'status'    =>  200
                );
               
			}
		} 
		return json_encode($returnArr);	
	}
	
}
