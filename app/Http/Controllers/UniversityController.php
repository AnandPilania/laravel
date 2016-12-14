<?php

namespace App\Http\Controllers;

use Auth;
use App\ExchangeStudent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Redirect;
use App\University;

class UniversityController extends Controller {
    /**
     * Show the form to update basic profile
     *
     * @return Response
     */
    public function create() {
        $universities = DB::table('universities')
        ->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
        ->where('universityName','!=','Others')
        ->where('Overview', '<>','')
        ->select('universities.id', 'universities.universityName', 'universities.image')
        ->orderBy('universityName', 'asc')->get();
    	$country = DB::table('countries')->orderBy('countryName', 'asc')->lists('countryName', 'countryID');
    	return view('university.university', compact('universities','country'));
    }

    public function detail($id, $friendly_name, $param = '') {
    	$universities = University::whereId($id)->with(['reviews','reviews.userdetail','universitycontent'])->first();
		$isUserAddedExchange = 0;
		if (Auth::check()) {
			$isUserAddedExchange = ExchangeStudent::where('user_id','=',Auth::user()->id)->count();
			if($isUserAddedExchange == 0) {
				Session::put('custom_error', "Please update your Exchange / International studies details under \"Profile\".");
			}
		}
    	return view('university.detail', compact('universities', 'friendly_name', 'param', 'isUserAddedExchange'));
    }

    public function filterByCountry(Request $request) {
    	if ($request->country == "all") {
    		$universites = DB::table('universities')
	    		->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
	    		->where('universityName', '!=','Others')
	    		->where('Overview', '<>', '')
	    		->select('universities.id', 'universities.universityName', 'universities.image')
	    		->orderBy('universityName', 'asc')->get();
    		$countData = DB::table('universities')
	    		->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
	    		->where('universityName', '!=','Others')
	    		->where('Overview', '<>', '')
	    		->select('universities.id', 'universities.universityName', 'universities.image')
	    		->orderBy('universityName', 'asc')->count();
    		return json_encode(array('success' => true, 'data' => $universites, 'countData' => $countData));
    	} else {
    		$countryId = DB::table('countries')->WHERE('countryName', $request->country)->lists('countryID');
    		$cityid = DB::table('cities')->WHERE('countryID', $countryId)->lists('id');
    		$universites = DB::table('universities')
	    		->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
	    		->where('universityName', '!=','Others')
	    		->whereIn('cityID', $cityid)
	    		->where('Overview', '<>','')
	    		->select('universities.id', 'universities.universityName', 'universities.image')
	    		->orderBy('universityName', 'asc')->get();
    		$countData = DB::table('countries')->WHERE('countryName',$request->country)->lists('countryID');
    		$cityid = DB::table('cities')->WHERE('countryID',$countryId)->lists('id');
    		$universitescountData = DB::table('universities')
	    		->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
	    		->where('universityName','!=', 'Others')
	    		->whereIn('cityID', $cityid)
	    		->where('Overview', '<>', '')
	    		->select('universities.id', 'universities.universityName', 'universities.image')
	    		->orderBy('universityName', 'asc')->count();
    		return json_encode(array('success' => true, 'data' => $universites, 'countData' => $universitescountData));
    	}
    }

    public function review(Request $request) {
    	if ($request->userid != '') {
    		DB::table('reviews')->insert([
    			'universityId' => $request->universityid,
    			'userId' => $request->userid,
    			'message' => $request->message
    		]);
    		Session::put('custom_success', "Thank you for your contribution.");
    		return redirect()->action('UniversityController@detail', [$request->universityid, 'university']);
    	}
    }
}
