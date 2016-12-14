<?php 

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\UserType;
use App\ExchangeStudent;
use DB;

class HomeController extends Controller {	
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		parent::__construct();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function profile() {
		if(Auth::check()) {
			$userId =  Auth::user()->id;
			$userData = User::where('id','=',$userId)->with(['exchange','exchange.homeUniversity','exchange.hostUniversity','exchange.userType','exchange.hostUniversity.city.country'])->first();
			$rquest_send = DB::table('users as u') 
				->select(array('u.*'))
				->join('user_requests as ur', 'ur.user_id', '=', 'u.id')
				->where('ur.to_id', '=', $userId);		
			$rquest_recive = DB::table('users as u')
				->select(array('u.*'))
				->join('user_requests as ur', 'ur.to_id', '=', 'u.id')
				->where('ur.user_id', '=', $userId)
				->union($rquest_send);
			$friendlist = DB::table(DB::raw("({$rquest_recive->toSql()}) as friend"))
				->mergeBindings($rquest_recive)
				->orderBy(DB::raw('RAND()'))
				->get();
			return view('home.profile', compact('userData', 'friendlist'));
		}
	}

	public function connect(){
		if(Auth::check()) {
			$isUserAddedExchange = ExchangeStudent::where('user_id', '=', Auth::user()->id)->count();
			if($isUserAddedExchange==0) {
				Session::put('custom_error',"Please update your Exchange / International studies details under \"Profile\".");
			}
			$peersExchanges = ExchangeStudent::join('universities as home', 'exchangestudents.homeUniversityID','=', 'home.id')
				->join('universities as host', 'exchangestudents.hostUniversityID','=', 'host.id')
				->join('users', 'exchangestudents.user_id','=', 'users.id')
				->join('cities', 'host.cityID', '=', 'cities.id')
				->join('countries', 'cities.countryID', '=', 'countries.countryID')
				->select('exchangestudents.id as eId','home.universityName as homeUniversity', 'matriculationYear as year', 'host.universityName as hostUniversity', 'exchangeTerm', 'countries.countryName as hostCountry','users.fname','users.lname','users.avatar','users.avatar','users.id as userId')
				->where('hostUniversityID', '<>', '0')
				->where('type', '=', '1')
				->where('user_id', '<>', Auth::user()->id)
				->orderBy('users.fname', 'asc')
				->get()->toArray();
			$seniorExchanges = ExchangeStudent::join('universities as home', 'exchangestudents.homeUniversityID','=', 'home.id')
				->join('universities as host', 'exchangestudents.hostUniversityID','=', 'host.id')
				->join('users', 'exchangestudents.user_id','=', 'users.id')
				->join('cities', 'host.cityID', '=', 'cities.id')
				->join('countries', 'cities.countryID', '=', 'countries.countryID')
				->select('exchangestudents.id as eId','home.universityName as homeUniversity', 'matriculationYear as year', 'host.universityName as hostUniversity', 'exchangeTerm', 'countries.countryName as hostCountry','users.fname','users.lname','users.avatar','users.id as userId' )
				->where('hostUniversityID', '<>', '0')
				->where('type', '=', '2')
				->where('user_id', '<>', Auth::user()->id)
				->orderBy('users.fname', 'asc')
				->get()->toArray();	
			$seniorsExchanges=array();
			$seniorsExchangesWithImg=array();
			$seniorsExchangesWithoutImg=array();
			foreach ($seniorExchanges as $key=>$custseniors) {
				if (!empty($custseniors['avatar'])) {
					$seniorsExchangesWithImg[$custseniors['eId']] = $custseniors;
				} else {
					$seniorsExchangesWithoutImg[$custseniors['eId']] = $custseniors;
				}
			}
			$seniorsExchanges = $seniorsExchangesWithImg + $seniorsExchangesWithoutImg;
			$peerExchanges=array();
			$peerExchangesWithImg=array();
			$peerExchangesWithoutImg=array();
			foreach ($peersExchanges as $custpeer) {
				if (!empty($custpeer['avatar'])) {
					$peerExchangesWithImg[$custpeer['eId']] = $custpeer;
				} else {
					$peerExchangesWithoutImg[$custpeer['eId']] = $custpeer;
				}
			}
			$peerExchanges = $peerExchangesWithImg + $peerExchangesWithoutImg;
		} else {
			$peerExchanges = array();
			$seniorsExchanges  = array();
		}
		return view('users.connect', compact('homeUnivList', 'hostUnivList', 'countryList','peerExchanges','seniorsExchanges','isUserAddedExchange'));
	}	
}
