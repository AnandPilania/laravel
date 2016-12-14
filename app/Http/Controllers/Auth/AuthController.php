<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailer;
use Session;
use DB;
use Mail;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AuthController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers;

    private $mailer;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct() {

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
    * Show the application registration form.
    *
    * @return Response
    */
    public function getRegister() {
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        $confirmation_code = str_random(30);
        // $validator = $this->registrar->validator($request->all());
        // if ($validator->fails()) {
        //     $this->throwValidationException(
        //         $request, $validator
        //     );
        // }
        $updateData = $request->all();

		if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
			Session::put('custom_error','Please enter a valid email address');
            return Redirect::to('/auth/register');
		}

		if (empty($updateData['password']) || strlen($updateData['password']) < 6){
			Session::put('custom_error','Password must be at least six characters long');
            return Redirect::to('/auth/register');
		}


		//Name: Twisha Mankad
        //Purpose: To save encrypted password in database
        //Date: 21-9-2016
        $updateData['password']=bcrypt($updateData['password']);

        $check = User::where('email',$updateData['email'])->count();

        if($check > 0)
        {
            Session::put('custom_error','Email Address already exists. Please try with different email address!');
            return Redirect::to('/auth/register');
        }
        else
        {


        $updateData['confirmation_code'] = $confirmation_code;

        $user = User::create($updateData);
        if ($request->get('active')) {
            Auth::login($user);
        }
        DB::table('role_user')->insert(
            ['role_id' => '2', 'user_id' => $user->id,'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
        $data=array('confirmation_code' => $confirmation_code);
        Mail::send('emails.verify', compact('data'), function($message) use($updateData) {

            $message->to($updateData['email'])->subject('Flying Chalks - New Registration');
        });

        Session::put('custom_success','You have successfully registered an account! Please check your mailbox for the verification email.');
        return Redirect::to('/auth/login');
      }
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        $emailCount = DB::table('users')->where('email','=',$request->email)->count();
        if ($emailCount == 0) {
                    $request->session()->put('custom_error', 'You have not registered an account with this email. Please proceed to sign up.');
                    return Redirect::to('/auth/register')->withInput($request->only('email'));
        }

        $verifyCount = DB::table('users')
            ->where('confirmed','=',1)
            ->where('confirmation_code','=','')
            ->where('email','=',$request->email)
            ->count();
        if ($verifyCount > 0) {

			$password = DB::table('users')->where('email', $credentials['email'])->value('password');
				if (strcmp($credentials['password'],$password)==0){

					DB::table('users')->where('email', $credentials['email'])->update(['password' => bcrypt($password)]);

				}

            if (Auth::attempt($credentials, $request->has('remember'))) {
                DB::table('users')->where('email', $credentials['email'])->update(['last_logged_in' => date('Y-m-d H:i:s')]);

                if ($request->get('referrer')) {
                    return Redirect::to($request->get('referrer'));
                }

                $user = User::where('email', $credentials['email'])->with('exchange')->first();
				//echo '<pre>'; print_r($user->exchange); exit;
                $isProfileEdited = ($user->exchange != null) ? true : false;

                if ($isProfileEdited) {
                    if ($user->exchange->type == null) {
                        $isProfileEdited = false;
                    }
                }

                if ($isProfileEdited) {
                    return Redirect::to(localization()->localizeURL('/community'));
                } else {
                    $request->session()->put('custom_error', 'Please complete your profile. This helps others to know you better!');
                    return Redirect::to(localization()->localizeURL('/edit-profile'));
                }

//              return Redirect::to('/community');
            }
        } else {
            return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => "A verification email has been sent to  " . $request->email . ". Please verify to log in.",
                        ]);
        }
        if ($emailCount > 0) {
            return redirect($this->loginPath())
                    ->withInput($request->only('email', 'remember'))
                    ->withErrors([
                        'email' => 'Incorrect password. Please try again.',
                    ]);
        }
    }
}
