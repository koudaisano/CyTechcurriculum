<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArticleRequest;

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
    protected $redirectTo = '/login';

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
        $messages = [
            'name' => '名前は入力必須です。',
            'email' => '有効なメールアドレスを入力してください。',
            'password' => 'パスワードは入力必須です。',
            'password.confirmed' => '入力したパスワードとパスワード確認用が一致しません。',
            'password_confirmation' => 'パスワード確認用は入力必須です。',
                    ];
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>['required', 'string', 'min:8', 'same:password'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'password_confirmation' => $data['password_confirmation'],
        ]);
        return redirect()->route('login');
    }


    public function register(Request $request)
    {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    //ユーザー新規登録したらログイン画面に遷移させるためにコメントアウト
    //Auth::login($user);

    return redirect()->route('login')->with('status', '登録が完了しました。ログインしてください。');
    }
}
