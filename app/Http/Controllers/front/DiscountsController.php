<?php

namespace App\Http\Controllers\front;

use App\User;
use App\ExchangeStudent;
use App\Http\Requests\ExchangeStudentFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Redirect;
use Validator;
use App\University;
use App\City;
use App\Country;
use Auth;
use App\ImageUploader;
use App\UserType;
use Image;

class DiscountsController extends Controller {
    public function index() {
        $promotions = DB::table('promotions')->get();
        $data_promotions = array();
        $data_filter=DB::table('promotion_types')->get();
        foreach ($promotions as $key => $value) {

            $data_promotions[$key] = $value;
        }
        return view('discounts.index')->with("data_promotions", $data_promotions)->with("data_filter", $data_filter);
    }
}