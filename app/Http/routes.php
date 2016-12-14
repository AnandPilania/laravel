<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::localizedGroup(function() {
    Route::get('/', function() {
        $universities = DB::table('universities')
            ->Join('univeristy_content', 'universities.id', '=', 'univeristy_content.universityId')
            ->where('universityName', '!=', 'Others')
            ->where('Overview', '<>', '')
            ->select('universities.id', 'universities.universityName')
            ->orderBy('universityName', 'asc')->get();
        return View::make('index', compact('universities'));
    });

    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);

    Route::get('home', 'HomeController@profile');
    Route::get('travelogue', 'front\BlogController@blogs');
    Route::get('travelogue/{id}/{slug}', 'front\BlogController@singleblog');
    Route::get('travelogue/{user_id}', 'front\BlogController@blogs_userid');
    Route::get('travelogue_tags/{tagy}', 'front\BlogController@blogs_tags');

    Route::get('register/verify/{confirmationCode}', [
        'as' => 'confirmation_path',
        'uses' => 'RegistrationController@confirm'
    ]);

    Route::get('pages/{pageslug?}', 'PagesController@view');

    //Remove {provider?} and add facebook to get old working
    Route::get('login/{provider?}', 'AccountController@facebook_redirect');

    Route::get('account/facebook', 'AccountController@facebook');

    Route::get('community', array('uses' => 'UpdateController@connect'));

    Route::get('discounts', array('uses' => 'front\DiscountsController@index'));

    Route::post('store', array('uses' => 'UpdateController@store'));

    Route::get('exchange-update', array('uses' => 'UpdateController@exchange'));

    Route::get('university', 'UniversityController@create');

    Route::get('university-detail/{id?}/{friendly_name?}/{param?}', 'UniversityController@detail');
    Route::get('university/{id?}/{friendly_name?}/{param?}', 'UniversityController@detail');

    Route::post('university-filter', 'UniversityController@filterByCountry');

    Route::post('university/review', 'UniversityController@review');

    Route::post('university/getUniversityCountryName', [
        'as' => 'getUniversityCountryName',
        'uses' => 'UpdateController@getUniversityCountryName'
    ]);

    Route::group(['middleware' => ['auth']], function() {
        Route::get('edit-profile', array('uses' => 'UpdateController@create'));
        Route::post('exchange-store', array('uses' => 'UpdateController@exchange_store'));
        Route::post('blogs/{id}/storeComment',  'front\BlogController@storeComment');
    });
});

Route::get('friendslist', [
    'uses' => 'UserRequestController@friendslist'
]);
Route::post('friendlistdetails','UserRequestController@friendlistdetails');
Route::post('logindetails','UserRequestController@logindetails');
Route::post('send-message-offline','UserRequestController@sendMessageOffline');
Route::resource('subscriber', 'SubscriberController', [
    "only" => ['create', 'store']
]);
Route::resource('requestsend', 'UserRequestController', [
    "only" => ['create', 'store']
]);
Route::post('users/uploadImage', [
    'as' => 'uploadImage',
    'uses' => 'UpdateController@uploadImage'
]);

Route::post('password2/email', 'Auth\PasswordController@postEmail');
Route::post('password2/reset', 'Auth\PasswordController@postReset');
Route::post('users/uploadImage2', [
    'as' => 'uploadImage2',
    'uses' => 'UpdateController@uploadImage'
]);

Route::post('send-message-offline2','UserRequestController@sendMessageOffline');

Route::group(['prefix' => 'ajax'], function () {
    Route::get('getUniversitiesByCountry', function () {
        return \Response::json(\App\Country::getUniversitiesByCountry(\Input::get('name')));
    });
    Route::get('getAllUniversities', function () {
        return \Response::json(\App\University::orderBy('universityName', 'asc')->get(['universityname']));
    });
});
