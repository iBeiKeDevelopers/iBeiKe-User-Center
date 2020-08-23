<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'username' => ['required', 'string', 'unique:cdb_uc_members', 'min:6', 'max:20'],
            'email' => [
                'required', 'string', 'email', 'max:30',
                'unique:cdb_uc_members', function ($attribute, $value, $fail) {
                    if (!Str::endsWith($value, 'ustb.edu.cn')) {
                        return $fail($attribute . ' 必须以 \'xs.ustb.edu.cn\' 结尾。');
                    }
                },
            ],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data, Request $request)
    {
        // Database: city
        // Table: cdb_uc_members
        $salt = Str::random(6);
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => md5(md5($data['password']) . $salt),
            'salt' => $salt,
            'regip' => $request->ip(),
            'regdate' => now()->timestamp,
        ]);
        if (!$user)
            return null;

        // Database: city
        // Table: users
        $secret = "";
        for ($i = 0; $i < 10; $i++)
            $secret .= pack("C1", random_int(0, 256));
        $status = DB::table('users')->insert([
            'username' => $user->username,
            'secret' => $secret,
            'passhash' => md5($secret . $data['password'] . $secret),
            'email' => $user->email,
            'status' => 'confirmed',
            'added' => now(),
            'modcomment' => '',
            'last_access_v6' => new Carbon(0),
        ]);

        // TODO: Send mail if create PT user on error
        // if (!status) {
        //     //
        // }

        // Database: newcity
        // Table: pre_common_member
        $status = DB::connection('mysql_newcity')
            ->table('pre_common_member')->insert([
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
                'groupid' => 17,
                'regdate' => $user->regdate,
                'timeoffset' => "9999",
            ]);

        return $user;
    }
}
