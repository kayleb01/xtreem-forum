<?php

namespace App\Http\Controllers\Auth;

use Image;
use App\Feed;
use App\User;
use App\Trending;
use App\NewThread;
use App\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/ ';

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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sex'      => ['required'],
            'location' => ['required'],
            // 'avatar'   => ['image', 'mimes:jpeg,jpg,png,gif,svg'],
            'birthday' => ['required'],
            'categories'=> ['sometimes'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){

        if(!$data){
            return redirect('/');
        }
        $avatar = 'https://ptetutorials.com/images/user-profile.png';
        //upload the avatar using Intervention
        if (isset($data['avatar'])) {
            $originalImage  = $data['avatar'];
            $avatar         = Image::make($originalImage);
            $path           = public_path()."/storage/img/";
            $avatar->resize(200,200, function($constraint){
                $constraint->aspectratio();
                $constraint->upsize();
            });
            $avatar->save($path.time().$originalImage->getClientOriginalName());
        }


        //then save the data
         $userCreate =   User::Create([
            'email'     => $data['email'],
            'location'  => $data['location'],
            'dob'       => $data['birthday'],
            'sex'       => $data['sex'],
            'avatar'    => $avatar,
            'role'      => 3,
            'password'  => Hash::make($data['password']),
            'confirmation_token' => Str::limit(Hash::make($data['email'].Str::random()), 25, ''),
            'username'  => $data['username']
        ]);

        abort_if (!$userCreate, 500, 'Error creating user account, please try again');
        return $userCreate;
    }

public function registered(Request $request, $user)
{

// Mail::to($user)->send(new PleaseConfirmYourEmail($user));
}

public function showRegistrationForm(NewThread $newThread, Trending $trending)
    {
        $newThread = $newThread->get();
        $trending = $trending->get();
        $cat = Categories::get();
        $title = "XtreemForum - Register";
        return view('auth.register', compact('title', 'newThread', 'trending', 'cat'));
    }
}
