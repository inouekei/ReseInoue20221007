<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ログインコントローラークラス
 * 
 * ユーザのログイン状態を管理
 * 
 * @関数 public function create()
 * ユーザーログインページ表示処理
 * 
 * @関数 public function store()
 * ユーザーログイン処理
 * 
 * @関数 public function destroy()
 * ユーザーログアウト処理
 * 
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * create()
     * 
     * ユーザーログインページ表示処理
     * 
     * @return view('register')
     * 
     */
    public function create()
    {
        return view('login');
    }

    /**
     * store()
     * 
     * ユーザーログイン処理
     * 
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * ログイン情報
     * 
     * @return \Illuminate\Http\RedirectResponse
     * ログイン後リダイレクト情報
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(Auth::user()->customer()){
            return redirect('/');
        }else{
            return redirect('/mypage');
        }
    }

    /**
     * destroy()
     * 
     * ユーザーログアウト処理
     * 
     * @param  \Illuminate\Http\Request  $request
     * ログアウト情報
     * 
     * @return \Illuminate\Http\RedirectResponse
     * ログアウト後リダイレクト情報
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
