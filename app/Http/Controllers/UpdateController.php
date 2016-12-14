<?php

namespace App\Http\Controllers;

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
use Input;
use Carbon\Carbon;

class UpdateController extends Controller {

    private $exchangeStudent;
    protected $uploader;

    public function __construct(ExchangeStudent $exchangeStudent, ImageUploader $uploader) {
        $this->exchangeStudent = $exchangeStudent;
        $this->uploader = $uploader;
    }

    /**
    * Show the form to update basic profile
    *
    * @return Response
    */
    public function create() {
        $user_id = Auth::user()->id;
        $userData = User::where('id','=',$user_id)->with(['exchange','exchange.homeUniversity','exchange.hostUniversity','exchange.userType','exchange.hostUniversity.city.country'])->first();

        if (!ExchangeStudent::whereUserId($user_id)->first()) {
            ExchangeStudent::create(['user_id' => $user_id]);
        }

        $exchangeDetail = ExchangeStudent::whereUserId($user_id)->with(['homeUniversity','hostUniversity','hostUniversity.city.country'])->first();
        $homeUnivList = [''=>''] +University::orderBy('universityName')->lists('universityName','id')->toArray();
        $homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, true);
        $hostUnivList = $homeUnivList;
        $countryList = [''=>''] +Country::orderBy('countryName')->lists('countryName', 'countryID')->toArray();;
        $userTypes = [''=>''] +UserType::orderBy('id')->lists('title', 'id')->toArray();;
        //return $userTypes;
        return view('users.edit',compact('homeUnivList', 'hostUnivList', 'countryList','exchangeDetail','userTypes','userData'));
    }

    /**
    * Store a new blog post.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request) {
        $data = $request->all();
        $messages = array(
            'fname.required' => 'This field is required',
            'lname.required' => 'This field is requ ired',
            'email.required' => 'This field is required',
            'contact.required' => 'This field is required',
            'email.email' => 'Please enter valid email address',
            );
        $rules = array(
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
        );
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()){
            return Redirect::to('/edit-profile')->withInput()->withErrors($validator);
        }
        else{
            if($this->emailExist($data['email'],$data['id'])=='1') {
                Session::put('custom_error','Email Address already exists. Please try with different email address!');
            } else {
                if(!empty($data['password'])){
                    DB::table('users')
                        ->where('id', $data['id'])
                        ->update([
                            'fname' => $data['fname'],
                            'lname' => $data['lname'],
                            'email' => $data['email'],
                            'password' => bcrypt($data['password']),
                        ]);
                } else {
                    DB::table('users')
                        ->where('id', $data['id'])
                        ->update([
                            'fname' => $data['fname'],
                            'lname' => $data['lname'],
                            'email' => $data['email'],
                    ]);
                }
                Session::put('custom_success','You have successfully updated your profile.');
            }
            return Redirect::to('/home');
        }
    }

    public function emailExist($email = NULL, $userId = NULL) {
        $flag = '0';
        if ($email != '' && $userId != '') {
            $user = DB::table('users')
                ->where('id', $userId)
                ->where('email', '=', $email)
                ->first();
            if ($user) {
                $flag = '1';
            }
        }
        return $flag;
    }

    /**
    * Show the form for update exchange information
    *
    * @return Response
    */
    public function exchange() {
        $user_id = Auth::user()->id;
        $exchangeDetail = ExchangeStudent::whereUserId($user_id)->with(['homeUniversity','hostUniversity','hostUniversity.city.country'])->first();
        $homeUnivList = University::whereIn('cityID', array('147'))->orderBy('universityName')->lists('universityName','id');
        $homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, false);
        $hostUnivList = University::whereNotIn('cityID',  array('147'))->orderBy('universityName')->lists('universityName', 'id');
        $hostUnivList = $homeUnivList + $hostUnivList;
        $homeUnivList = $hostUnivList;
        $countryList = Country::orderBy('countryName')->lists('countryName', 'countryID');
        return view('users.exchange',compact('homeUnivList', 'hostUnivList', 'countryList','exchangeDetail'));
    }

    public function changeOrderForUniversityOthersOption($listOfUni, $isTop) {
      //  return $listOfUni;
        $others = array_search('Others', $listOfUni);
        // remove others from the array
        unset($listOfUni[$others]);
        if ($isTop) {
            // put others option at the top of the array
            $first = array();
            $first[$others] = "Others";
            $listOfUni = $first + $listOfUni;
        } else {
            // put others at the end of the array
            $listOfUni[$others] = "Others";
        }
        return $listOfUni;
    }

    public function getUniversityCountryName(Request $request){
        $requestedData = $request->all();
        $id = $requestedData['id'];
        $uniCountry = University::find($id)->city->country;
        return json_encode(array('success' => true, 'data' => $uniCountry->countryName, 'id'=>$id));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param ExchangeStudentFormRequest $request
    * @return Response
    */
    public function exchange_store(ExchangeStudentFormRequest $request)
    {
        $data = $request->all();

        $user_id = Auth::id();
        $user = Auth::user();

        $user->update([
            'fname'  => trim($data['fname']),
            'lname'  => trim($data['lname']),
        ]);

        $user->gender = $data['gender'];
        $user->save();

        $email = trim($data['email']);
        if ($user->email != $email) {
            if (User::whereEmail($email)->first() == null) {
                $user->update(['email' => $email]);
            } else {
                if($request->ajax()){
                    return response()->json([
                        'errorText' => "Email Address already exists. Please try with different email address!"
                    ]);
                } else {
                    Session::flash('custom_error','Email Address already exists. Please try with different email address!');
                    return redirect('/edit-profile');
                }
            }
        }

        $password = trim($data['password']);
        if ($password != '' ) {
            $user->update(['password' => $password]);
        }

        if ($data["type"] == '0') {
            //first submission success
            return response()->json([
                'responseText' => "1"
            ]);
        }

        $student = ExchangeStudent::whereUserId($user_id)->first();
        $studentArr = array();
        $studentType = $request->type;
        $studentArr['user_id'] = $user_id;
        $studentArr['homeUniversityID'] = $request->homeUniversityID;
        $studentArr['exchangeTerm'] = $request->exchangeTerm;
        $studentArr['matriculationYear'] = $request->matriculationYear;
        $studentArr['hostUniversityID'] = $request->hostUniversityID;
        $studentArr['type'] = (int)$studentType;

        if ($studentArr['type'] === 3 || $studentArr['type'] === 4) {
            $studentArr['exchangeTerm'] = '';
            $studentArr['hostUniversityID'] = 0;
        }
        // user choose 'Others" home university option
        if ($studentArr['homeUniversityID'] == 1) {
            // create new host city
            $cityName = $this->nameize($request->homecity);
            $isCityExist = City::where('cityName', 'like', '%' . $cityName . '%')->where('countryID', '=', $request->homecountry )->count();
            // check if city exist
            if ($isCityExist == 0) {
                $newCity = ['cityName' => $cityName, 'countryID' => $request->homecountry];
                City::create($newCity);
            }
            $universityName = $this->nameize($request->homeuniversityName);
            // check if university exist
            $isUniversityExist = University::where('universityName', 'like', '%' . $universityName . '%')->count();
            if ($isUniversityExist == 0) {
                // get the city ID
                $cityID = City::select("id")->where("cityName", $cityName)->where('countryID', '=', $request->homecountry )->first();
                $newUniversity = ['universityName' => $universityName, 'cityID' => $cityID->id];
                University::create($newUniversity);
                $newUniID = University::select("id")->where('universityName', '=', $universityName)->first();
                $studentArr['homeUniversityID'] = $newUniID->id;
            }
        }

        if (in_array($studentType,array('3','4'))) {
            $studentArr['program'] = $data['program'];
            $studentArr['buddy'] = $data['buddy'];
        } else {
            $studentArr['program'] = $data['program_exp'];
        }

        if (in_array($studentType,array('1','2'))) {
            //school term case
            $fromDate = date("Y-m-d", strtotime($data["term_from"]));
            $toDate = date("Y-m-d", strtotime($data["term_to"]));

            if ($toDate > $fromDate) {

            $studentArr["term_from"] = $fromDate;
            $studentArr["term_to"] = $toDate;
            } else{
                 return response()->json([
                'errorText' => "School Term is invalid. 'To' cannot be before 'From'"]);
            }

            // user choose 'Others" host university option
            if ($studentArr['hostUniversityID'] == 1) {
                // create new host city
                $cityName = $this->nameize($request->hostcity);
                $isCityExist = City::where('cityName', 'like', '%' . $cityName . '%')->where('countryID', '=', $request->hostNewcountry )->count();
                // check if city exist
                if ($isCityExist == 0) {
                    $newCity = ['cityName' => $cityName, 'countryID' => $request->hostNewcountry];
                    City::create($newCity);
                }
                $universityName = $this->nameize($request->hostuniversityName);
                // check if university exist
                $isUniversityExist = University::where('universityName', 'like', '%' . $universityName . '%')->count();
                if ($isUniversityExist == 0) {
                    // get the city ID
                    $cityID = City::select("id")->where("cityName", $cityName)->where('countryID', '=', $request->hostNewcountry )->first();
                    $newUniversity = ['universityName' => $universityName, 'cityID' => $cityID->id];
                    University::create($newUniversity);
                    $newUniID = University::select("id")->where('universityName', '=', $universityName)->first();
                    $studentArr['hostUniversityID'] = $newUniID->id;
                }
            }
        }
        if(!$student) {
            if (ExchangeStudent::create($studentArr)) {
                if($request->ajax()) {
                    return response()->json([
                        'successText' => "You have successfully updated your Exchange / International studies details!"
                    ]);
                } else {
                    Session::flash('custom_success','You have successfully updated your Exchange / International studies details!');
                    return redirect('/home');
                }
            } else {
                if($request->ajax()) {
                    return response()->json([
                        'errorText' => "Some problem occur. Please try again!"
                    ]);
                } else {
                    Session::flash('custom_error','Some problem occur. Please try again!');
                    return redicrect('/edit-profile');
                }
            }
        } else {
            if (ExchangeStudent::where('user_id', $studentArr['user_id'])->update($studentArr)) {
                if($request->ajax()) {
                    return response()->json([
                        'successText' => "You have successfully updated your Exchange / International studies details!"
                    ]);
                } else {
                    Session::flash('custom_success','You have successfully updated your Exchange / International studies details!');
                    return redirect('/home');
                }
            } else {
                if($request->ajax()) {
                    return response()->json([
                        'errorText' => "Some problem occur. Please try again!"
                    ]);
                } else {
                    Session::flash('custom_error','Some problem occur. Please try again!');
                    return redirect()->back()->withInput();
                }
            }
        }
    }

    function nameize($str, $a_char = array("'","-"," ")) {
        //$str contains the complete raw name string
        //$a_char is an array containing the characters we use as separators for capitalization. If you don't pass anything, there are three in there as default.
        $string = strtolower($str);
        foreach ($a_char as $temp) {
            $pos = strpos($string, $temp);
            if ($pos) {
                //we are in the loop because we found one of the special characters in the array, so lets split it up into chunks and capitalize each one.
                $mend = '';
                $a_split = explode($temp,$string);
                foreach ($a_split as $temp2) {
                    //capitalize each portion of the string which was separated at a special character
                    $mend .= ucfirst($temp2).$temp;
                }
                $string = substr($mend,0,-1);
            }
        }
        return ucfirst($string);
    }

    public function uploadImage(Request $request) {
        $requestedData = $request->all();
        $userId = $requestedData['userId'];
        ini_set('memory_limit','750M');
        ini_set('upload_max_filesize','750M');
        ini_set('post_max_size','750M');
        if ($_FILES['uploadfile']['name'] != "") {
            $uploadFolder="memberImages";
            $logoWidth = "100";
            $logoHeight = "100";
            $logoSize="10485760";
            $logoKb = '10 MB';
            $imgName = pathinfo($_FILES['uploadfile']['name']);
            $file = $_FILES['uploadfile'];
            $image = $_FILES['uploadfile']['name'];
            $ext = trim(substr($image, strrpos($image,'.')));
            $explodeExt = explode('.',$image);
            $explodeExt =  end($explodeExt);
            $imageStatus = 0;
            if ($explodeExt=='jpg' || $explodeExt=='jpeg' || $explodeExt=='png' || $explodeExt=='gif' || $explodeExt=='bmp') {
                if ($_FILES['uploadfile']['size'] <= $logoSize) {
                    $this->uploader->upload('uploadfile')->save('img/memberImages','front');
                    $imageName = $this->uploader->getFilename();
                    $imgStatus = 1;
                    DB::table('users')->where('id','=',$userId)->update(['avatar'=>$imageName]);
                    echo  "success:".$imageName.':uploaded';
                    if ($imgStatus == 1) {
                        Session::put('custom_success','Your profile picture has been successfully updated.');
                        return true;
                    }
                } else {
                    Session::put('custom_error',"File size should be less than $logoKb.");
                    echo  "error:File size should be less than $logoKb.";
                }
            } else {
                Session::put('custom_error',"Only JPG, PNG, BMP or GIF files are allowed!");
                echo  "error:Only JPG, PNG, BMP or GIF files are allowed!";
            }
        } else {
            Session::put('custom_error',"Some error occur. Please try again!");
            echo  "error:Some error occur. Please try again!";
        }
        echo '';
    }

    /**
    * Function to generate random string
    */
    public function RandomStringGenerator($length = 10) {
        $string = "";
        $pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        for($i=0; $i<$length; $i++) {
            $string .= $pattern{rand(0,61)};
        }
        return $string;
    }

    private function applyUserSearch() {

        $exchanges = ExchangeStudent::
            join('users', 'exchangestudents.user_id','=', 'users.id')
            ->join('universities as home', 'exchangestudents.homeUniversityID','=', 'home.id')
            ->join('cities as homeCities', 'home.cityID', '=', 'homeCities.id')
            ->join('countries as homeCountries', 'homeCities.countryID', '=', 'homeCountries.countryID')
            ->leftJoin('universities as host', 'exchangestudents.hostUniversityID','=', 'host.id')
            ->leftJoin('cities', 'host.cityID', '=', 'cities.id')
            ->leftJoin('countries', 'cities.countryID', '=', 'countries.countryID')
            ->select('exchangestudents.id as eId','home.universityName as homeUniversity', 'matriculationYear as year', 'host.universityName as hostUniversity', 'exchangeTerm', 'countries.countryName as hostCountry', 'homeCountries.countryName as homeCountry', 'exchangestudents.program','exchangestudents.term_from','exchangestudents.term_to', 'exchangestudents.type', 'users.fname','users.lname','users.avatar','users.id as userId' );

        $program = Input::get('program');

        if ($program == -1) {
            $exchanges = $exchanges->where('exchangestudents.program', null);
        } else if ($program == 0 || $program == 1) {
            $exchanges = $exchanges->where('exchangestudents.program', $program);
        }

        $keyword = Input::get('exchangeKeyword');
        $tab = Input::get('tab');

        if ($keyword) {
            $exchanges = $exchanges->where(function ($query) use ($keyword, $tab) {
                $query
                    ->orWhere(DB::raw("concat(users.fname, ' ', users.lname)"), 'like', "%{$keyword}%")
                    ->orWhere('countries.countryName', 'like', "%{$keyword}%")
                    ->orWhere('host.universityName', 'like', "%{$keyword}%")
                    ->orWhere('home.universityName', 'like', "%{$keyword}%")
                    ->orWhere('homeCountries.countryName', 'like', "%{$keyword}%");
            });
        }

        if (Input::get('hostCountryC')) {
            $exchanges = $exchanges->where('countries.countryName', Input::get('hostCountryC'));
        }

        if (Input::get('homeCountryC')) {
            $exchanges = $exchanges->where('homeCountries.countryName', Input::get('homeCountryC'));
        }

        if (Input::get('hostUniv')) {
            $exchanges = $exchanges->where('host.id', Input::get('hostUniv'));
        }

        if (Input::get('homeUniv')) {
            $exchanges = $exchanges->where('home.id', Input::get('homeUniv'));
        }

        if ($tab == 1) {
            $termFrom = $termTo = null;

            if (Input::get('termFrom')) {
                $termFrom = Carbon::createFromFormat('M Y', Input::get('termFrom'))->startOfMonth();
            }

            if (Input::get('termTo')) {
                $termTo = Carbon::createFromFormat('M Y', Input::get('termTo'))->startOfMonth();
            }

            if ($termFrom && $termTo) {
                $exchanges = $exchanges
                    ->where('exchangestudents.term_from', '<=', $termTo)
                    ->where('exchangestudents.term_to', '>=', $termFrom);
            } else if ($termFrom) {
                $exchanges = $exchanges->where('exchangestudents.term_from', '<=', $termFrom);
            } else if ($termTo) {
                $exchanges = $exchanges->where('exchangestudents.term_to', '>=', $termTo);
            }
        }

        return $exchanges;
    }

    public function connect() {
        $localExchanges = $seniorExchanges = $peersExchanges = [];

        $limit = 10;

        $offset = filter_input(INPUT_GET, "offset", FILTER_VALIDATE_INT);

        if (!$offset) {
            $offset = 0;
        }

        if (!Input::get('tab') ||  Input::get('tab') == 1) {
            $prePeersExchanges = $this->applyUserSearch();

            $prePeersExchanges = $prePeersExchanges
                ->where('type', '=', '1')
                ->where('avatar','<>','')
                ->orderBy('fname')
                ->orderBy('lname');

            $withImageCount = $prePeersExchanges->count();
            $withImageCount = ceil($withImageCount / 10) * 10;

            $prePeersExchanges=$prePeersExchanges->offset($offset)
            ->limit($limit);

            $peersExchanges+=$prePeersExchanges->get()->toArray();

            if ($offset >= $withImageCount) {

                $prePeersExchanges = $this->applyUserSearch();

                $prePeersExchanges = $prePeersExchanges
                    ->where('type', '=', '1')
                    ->where('avatar','=','')
                    ->orderBy('fname')
                    ->orderBy('lname');

                $prePeersExchanges=$prePeersExchanges->offset($offset-$withImageCount)
                ->limit($limit);

                $peersExchanges+=$prePeersExchanges->get()->toArray();
            }
        }
        if (Input::get('tab') == 2) {
            $preSeniorExchanges = $this->applyUserSearch();
            $preSeniorExchanges = $preSeniorExchanges->where('type', '=', '2')
            ->where('avatar','<>','')
            ->orderBy('fname')
            ->orderBy('lname');

            $withImageCount = $preSeniorExchanges->count();
            $withImageCount = ceil($withImageCount / 10) * 10;

            $preSeniorExchanges=$preSeniorExchanges->offset($offset)
            ->limit($limit);

            $seniorExchanges=$preSeniorExchanges->get()->toArray();

            if ($offset >= $withImageCount) {

                $preSeniorExchanges = $this->applyUserSearch();

                $preSeniorExchanges = $preSeniorExchanges
                    ->where('type', '=', '2')
                    ->where('avatar','=','')
                    ->orderBy('fname')
                    ->orderBy('lname');

                $preSeniorExchanges = $preSeniorExchanges
                    ->offset($offset-$withImageCount)
                    ->limit($limit);

                $seniorExchanges+=$preSeniorExchanges->get()->toArray();
            }
        }
        if (Input::get('tab') == 3) {
            $preLocalExchanges = $this->applyUserSearch();
            $preLocalExchanges
                ->where('avatar','<>','')
                ->orderBy('fname')
                ->orderBy('lname');

            $withImageCount = $preLocalExchanges->count();
            $withImageCount = ceil($withImageCount / 10) * 10;

            $preLocalExchanges=$preLocalExchanges->offset($offset)
            ->limit($limit);

            $localExchanges=$preLocalExchanges->get()->toArray();

            if ($offset >= $withImageCount) {

                $preLocalExchanges = $this->applyUserSearch();

                $preLocalExchanges = $preLocalExchanges
                    ->where('avatar','=','')
                    ->orderBy('fname')
                    ->orderBy('lname');

                $preLocalExchanges = $preLocalExchanges
                    ->offset($offset-$withImageCount)
                    ->limit($limit);

                $localExchanges+=$preLocalExchanges->get()->toArray();
            }
        }

        if (Auth::check()) {
            $homeUnivLists = University::where('id', '<>', 1)->orderBy('universityname')->get(['id', 'universityname', 'cityID'])->toArray();
            // $homeUnivList = $this->changeOrderForUniversityOthersOption($homeUnivList, true);
            $others = University::find(1)->get(['id', 'universityname', 'cityID']);
            array_push($homeUnivLists, $others[0]);
            $homeUnivList = [];
            foreach ($homeUnivLists as $home) {
                $homeUnivList[$home['id']] = $home['universityname'];
            }

            $hostUnivList = $homeUnivList;
            $countryList = Country::orderBy('countryName')->lists('countryName', 'countryName')->toArray();
            $isUserAddedExchange = ExchangeStudent::where('user_id','=',Auth::user()->id)->count();
            if($isUserAddedExchange == 0) {
                Session::put('custom_error', "Please update your Exchange / International studies details under \"Profile\".");
                //return redirect('edit-profile');
            }
        } else {
            $hostUnivList = array();
            $homeUnivList = array();
            $countryList = array();
            if (@$_GET['from'] == 'email') {
                Session::flash('custom_error', "Please log in to view your messages and reply");

                return redirect()->guest('auth/login');
            }
        }

        $peerExchanges = $peersExchanges;
        $seniorsExchanges =$seniorExchanges;

        if(Auth::check()) {
            $userId =  Auth::user()->id;
            $userData = User::where('id','=',$userId)->with(['exchange','exchange.homeUniversity','exchange.hostUniversity','exchange.userType','exchange.hostUniversity.city.country', 'exchange.homeUniversity.city.country'])->first();
        } else {
            $userData = NULL;
        }

        if (!Input::get('tab')) {
            return view('users.connect', compact('userData', 'homeUnivList', 'hostUnivList', 'countryList', 'peerExchanges','seniorsExchanges', 'localExchanges', 'isUserAddedExchange'));
        } else if (Input::get('tab') == 1) {
            return view('users.connect-peers', compact('userData', 'homeUnivList', 'hostUnivList', 'countryList', 'peerExchanges','seniorsExchanges', 'localExchanges', 'isUserAddedExchange'));
        } else if (Input::get('tab') == 2) {
            return view('users.connect-seniors', compact('userData', 'homeUnivList', 'hostUnivList', 'countryList', 'peerExchanges','seniorsExchanges', 'localExchanges', 'isUserAddedExchange'));
        } else {
            return view('users.connect-locals', compact('userData', 'homeUnivList', 'hostUnivList', 'countryList', 'peerExchanges','seniorsExchanges', 'localExchanges', 'isUserAddedExchange'));
        }
    }
}
