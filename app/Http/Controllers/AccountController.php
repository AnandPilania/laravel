<?php

namespace App\Http\Controllers;

use Redirect;
use Socialite;
use App\AuthenticateUser;
use Illuminate\Http\Request;
use DB;

class AccountController extends Controller {
	private $authenticateUser;

	// To redirect facebook
	//remove AuthenticateUser $authenticateUser, Request $request, $provider = null (to get old working from function param)
	public function facebook_redirect(AuthenticateUser $authenticateUser, Request $request, $provider = null) {
		return $authenticateUser->execute($request->all(), $this, $provider);
	}

	// to get authenticate user data
	public function facebook() {
		$user = Socialite::with('facebook')->user();
		return $user;
	}

	public function userHasLoggedIn($user) {
		\Session::flash('message', 'Welcome, ' . $user->username);

		$exchangeCount = DB::table('exchangestudents')->where('user_id',$user->id)->whereNotNull('type')->count();

		if ($exchangeCount > 0) {
			return redirect(localization()->localizeURL('/community'));
		} else {
			return redirect(localization()->localizeURL('/edit-profile'));
		}
	}

	public function connect() {
 		return view('users.connect');
	}
}
