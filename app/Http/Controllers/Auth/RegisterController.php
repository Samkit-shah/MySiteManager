<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Sharepostmail;
use App\Mail\Welcomemail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use Socialite;
use Auth;
use Exception;
use Carbon\Carbon;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/showposts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contactno' => ['required', 'int', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([

            'name' => $data['name'],
            'email' => $data['email'],
            'contactno' => $data['contactno'],
            'password' => Hash::make($data['password']),
        ]);

//        $mailto = $user->email;
//        $name = $user;
//        Mail::to($mailto)->send(new Welcomemail($name));

        $user->sendEmailVerificationNotification();



         return $user;
    }


     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function redirectToGoogle()
     {
     return Socialite::driver('google')->redirect();
     }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function handleGoogleCallback()
     {
     try {

     $user = Socialite::driver('google')->user();

     $finduser = User::where('email', $user->email)->first();

     if($finduser){

     Auth::login($finduser);

     return redirect('/home');

     }else{
     $newUser = User::create([
     'name' => $user->name,
     'email' => $user->email,
     'google_id'=> $user->id,
     'password' => bcrypt('123456dummy'),
    'contactno' => '1234567890',
 
     ]);
     $newUser->markEmailAsVerified();


     Auth::login($newUser);

     return redirect('/home');
     }

     } catch (Exception $e) {
     dd($e->getMessage());
     echo "Sorry,We Got An Error"
     }
     
     }
}
