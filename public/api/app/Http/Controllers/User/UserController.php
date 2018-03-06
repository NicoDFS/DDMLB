<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Model\AppUser;
use App\Model\ApiApps;
use DB;
use Auth;
use carbon\Carbon;
use File;

class UserController extends Controller
{
	const STATUS = 1;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth:appuser');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        $Arr = array();
        $homeTitle = 'User\'s Dashboard';
        $apps = ApiApps::where('user_id',Auth::guard('appuser')->user()->id)->count();
        return view('user.home',array('homeTitle'=>$homeTitle,'apps'=>$apps));
    }

	/**
     * Show the application doctor profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request){            
        $homeTitle = 'Profile'; 
		$id = Auth::guard('appuser')->user()->id;
        $AppUser= AppUser::where('id',$id)->first();
		//dd($AppUser);
        return view('user.profile',compact('homeTitle','AppUser'));        
    }
	
	
	public function Editprofile(request $request){
			
		 $validation = Validator::make($request->all(), [            
            'name'  	=> 'required',                
            'password' 	=> 'nullable|string|min:6|confirmed',
			'profile_image'  => 'nullable|mimes:jpeg,jpg,png,gif|max:100000', 
        ]);
		if ($validation->fails()) { 
            return redirect()->back()->withErrors($validation)->withInput($request->all()); 
        }else{
			try {
				$u_id = Auth::guard('appuser')->user()->id;
				//dd($u_id);
				$AppUser = AppUser::where('id',$u_id)->first();
				
				$AppUser->name = $request->name;
				if ($request->hasFile('profile_image')) {
                    $file = $request->file('profile_image');
					$path  = public_path().'/assets/Apps/'.$u_id.'/profile';
					
                    if(!File::exists($path)){     
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
					$ProfileName = time().'_'.$file->getClientOriginalName();
					if(!empty($AppUser->profile_image)){
						$Oldfilename=$path."/".$AppUser->profile_image;
					
						File::delete($Oldfilename);
					}
					
					$file->move($path, $ProfileName);
					
					$AppUser->profile_image = $ProfileName;
					
                }	
				if ($request->password) {
                    $AppUser->password = Hash::make($request->password);	
                }	
				$AppUser->save();
				DB::commit(); 
				$request->session()->flash('alert-success', 'Profile Updated successfully!');
				return redirect()->route("user.home");
			}catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                return redirect()->back()->withErrors(['Oops ! some thing is wrong.'])->withInput($request->all());
                
			} 
		}
    }
   
    /**
     * Show the application list.
     *
     * @return \Illuminate\Http\Response
     */
	public function AppList(Request $request){
	    
	    $apps = ApiApps::where('user_id',Auth::guard('appuser')->user()->id)->OrderBy('created_at','desc');
	    $applications = $apps->paginate(env('RECORD_PER_PAGE'));
	    $homeTitle = 'Applications List';            
        return view('user.applist',array('homeTitle'=>$homeTitle,'applications'=>$applications,'params'=>$request))
         ->with('i', ($request->input('page', 1) - 1) * env('RECORD_PER_PAGE'));
	}
	 /**
     * Show the application list.
     *
     * @return \Illuminate\Http\Response
     */
    public function DeleteApp(Request $request){
	    
	    $Apps = ApiApps::where('id',$request->id)->first();
		
	    if($Apps->app_logo){
	        $dir = 'public/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$Apps->id;
	        File::deleteDirectory($dir);
	    }
			$status = $Apps->delete();
		 
			if($status){
				return 1;
			}else{
				return 0;
			}
         
	}
	
	
	public function changeAppId(Request $request){
		
		$validation = Validator::make($request->all(), [
            'id'     => 'required',
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
				DB::beginTransaction(); 
				$Apps = ApiApps::where('id',$request->id)->first();
				
				$Apps->appId = $this->generateRandomNumberString();
				$Apps->save();
				
				$returnArr = array(
					'error'     =>  0,
					'message'   =>  'Updated.',
					'appId'    => $Apps->appId,
					'status'    =>  200
				);
				
					DB::commit();
			}catch(\Illuminate\Database\QueryException $e){
				DB::rollBack();
				$returnArr = array(
					'error'     =>  1,
					'message'   =>  'Oops ! some thing is wrong.',
					'reason'      =>  $e->getMessage(),
					'status'    =>  200
				);
				
			}
		}
		return json_encode($returnArr); die;
	}
	 /**
     * Show the new application.
     *
     * @return \Illuminate\Http\Response
     */
	public function AppNew(Request $request){
	    $homeTitle = 'Add New App';            
        return view('user.new-app',array('homeTitle'=>$homeTitle));  
	}
	
	public function PostAppNew(Request $request){
	   //validate the new application form
		$validation = Validator::make($request->all(), [            
            'app_name'     => 'required|unique:dd_api_apps',
            'domain_name'  =>  'required|regex:/^(http[s]?\:\/\/)?((\w+)\.)?(([\w-]+)?)(\.[\w-]+){1,2}$/',
            'description'  => 'required',
			'app_logo' 	   => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',
        ]);
		
        if ($validation->fails()) { 
            return redirect()->back()->withErrors($validation)->withInput($request->only('app_name', 'domain_name','description'));
        }
		try {
			DB::beginTransaction(); 
			$App = new ApiApps();
			$App->app_name = $request->app_name;
			$App->user_id = Auth::guard('appuser')->user()->id;
			$App->domain_name = $request->domain_name;
			$App->app_desc = $request->description;
			$App->appId = $this->generateRandomNumberString();
			$App->secretId = $this->generateRandomString();
			$App->status = 2;
			$App->save();					
			if ($request->hasFile('app_logo')) {
				$file = $request->file('app_logo');
			 
				$path  = public_path().'/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.
				$App->id;
				if(!File::exists($path)){     
					File::makeDirectory($path, $mode = 0777, true, true);
				}
				$LogoName = time().'_'.$file->getClientOriginalName();
				$file->move($path, $LogoName);
				
				$App->app_logo = $LogoName;
				$App->update();
			}	 
			
			DB::commit();
			$request->session()->flash('alert-success', 'App has been added successfully and your App submitted to Admin approval.');
			return redirect()->route("AppList");
		}catch(\Illuminate\Database\QueryException $e){
			DB::rollBack();
			return redirect()->back()->withErrors(['Oops ! some thing is wrong.'])->withInput($request->all());
			
		} 
		
	}
	
	/***Edit App Details*******/
	
	public function AppEdit(Request $request){         
		$id = base64_decode($request->id);
        $Apps= ApiApps::where(['id'=>$id,'user_id'=>Auth::guard('appuser')->user()->id])->first();
		if($Apps){
			return view('user.editApp',compact('Apps')); 
		}else{
			return redirect()->route("AppList")->withErrors(['Invalid action performed.']);
		} 
    }
	
	public function AppPostEdit(request $request){
			
		$validation = Validator::make($request->all(), [            
            'name'   			=> 'required',
            'domain_name'       => 'required', 
            'description'       => 'required',                 
            'app_logo'     	    => 'nullable|mimes:jpeg,jpg,png,gif|max:100000',                 
        ]);
		if ($validation->fails()) { 
            return redirect()->back()->withErrors($validation)->withInput($request->all()); 
        }else{
			try {
				
				$Apps = ApiApps::where('id',$request->id)->first();
				//dd($Apps);
				
				$Apps->app_name = $request->name;
				$Apps->domain_name =  $request->domain_name;
				$Apps->app_desc = $request->description;
				if ($request->hasFile('app_logo')) {
                    $file = $request->file('app_logo');
					$path  = public_path().'/assets/Apps/'.Auth::guard('appuser')->user()->id.'/'.$Apps->id;
                    if(!File::exists($path)){     
                        File::makeDirectory($path, $mode = 0777, true, true);
                    }
					$LogoName = time().'_'.$file->getClientOriginalName();
					$file->move($path, $LogoName);
					
					$Apps->app_logo = $LogoName;
					
                }	
				
				$Apps->update();
				
				DB::commit(); 
				 $request->session()->flash('alert-success', 'App Updated successfully!');
				return redirect()->route("AppList");
			}catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                return redirect()->back()->withErrors(['Oops ! some thing is wrong.'])->withInput($request->all());
                
			} 
		}
    }
	
	function generateRandomNumberString($length = 11) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function generateRandomString($length = 16) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
	public function viewAppDetail(Request $request){         
		$id = base64_decode($request->id);
        $ApiApps= ApiApps::where(['id'=>$id,'user_id'=>Auth::guard('appuser')->user()->id])->first();
		//dd($ApiApps);
		if($ApiApps){
			return view('user.view-app',compact('ApiApps')); 
		}else{
			return redirect()->route("AppList")->withErrors(['Invalid action performed.']);
		} 	
    }
	
	
	public function showDocumentation(Request $request){         
		 return view('user.documentation'); 
    }
	
}
