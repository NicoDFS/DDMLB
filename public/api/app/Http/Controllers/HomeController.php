<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Model\States;
use App\Model\Cities;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	/**
     * fetch the state according to country id.
     *
     * @return \Illuminate\Http\Response
     */
	public function fetchState(Request $request){ 
		if ($request->ajax()) {
			
			$state = States::where('country_id',$request->cid)->get();
			
			$data= view('states',array('allstates'=>$state));
			echo $data;
			//return view('states',array('allstates'=>$state));
			//return response()->json( array('success' => true, 'data'=>$data) );
		}
	}
	
	/**
     * fetch the city according to state id.
     *
     * @return \Illuminate\Http\Response
     */
	public function fetchCity(Request $request){ 
		if ($request->ajax()) {
			
			
			$city = Cities::where('state_id',$request->stid)->get();
			
			$data= view('cities',array('allcities'=>$city));
			echo $data;
			//return view('states',array('allstates'=>$state));
			//return response()->json( array('success' => true, 'data'=>$data) );
		}
	}
}
