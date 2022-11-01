<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use App\Models\Customer;
use App\Models\Manager;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

/**
 * 登録ユーザコントローラークラス
 * 
 * ユーザの登録処理を管理
 * 
 * @関数 public function create()
 * 利用者登録ページ表示処理
 * 
 * @関数 public function store()
 * ユーザー登録処理
 * 
 */
class RegisteredUserController extends Controller
{
    /**
     * create()
     * 
     * 利用者登録ページ表示処理
     * 
     * @return view('register')
     * 
     */
    public function create()
    {
        return view('register');
    }

    /**
     * store()
     * 
     * Handle an incoming registration request.
     *
     * @param  UserRegistrationRequest  $request
     * ユーザ登録内容
     * 
     * @var User $user
     * 登録するユーザモデル
     * 
     * @var User $user_id
     * 登録したユーザのID
     * 
     * @var Customer $customer
     * 登録ユーザが利用客の場合における、紐づけるCustomerモデル
     * 
     * @var Manager $manager
     * 登録ユーザが店舗代表者の場合における、紐づけるManagerモデル
     * 
     * @return redirect('/mypage?message=' . urlencode('店舗代表者が登録されました'))
     * 店舗代表者作成の場合
     *
     * @return redirect('/login')
     * 利用客作成の場合
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $user_id = User::where('email', '=', $user['email'])->get()[0]->id;

        if($request->role === 'customer'){
            $customer = [
                'user_id' => $user_id,
            ];
            Customer::create($customer);    
            return redirect('/login');
        }elseif(Auth::user()->administrator() && $request->role === 'manager'){
            $manager = [
                'user_id' => $user_id,
            ];
            Manager::create($manager);               
            return redirect('/mypage');
        }
    }
}
