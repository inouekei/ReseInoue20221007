<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Reservation;

/**
 * MyPageコントローラークラス
 * 
 * マイページ表示処理
 * 
 * @関数 public function index()
 * マイページ表示処理
 * 
 */

class MyPageController extends Controller
{
    /**
     * index()
     * 
     * マイページ表示処理
     * 
     * @param Request $request
     * メッセージがある場合は格納される
     * 
     * @var Customer $customer
     * ログイン中の利用者
     * 
     * @var [Reservation[], Reservation[]] $reservations
     * ログイン中の利用者の予約
     * 0番目に未来のもの、1番目に過去のものが挿入
     * 
     * @var Restaurant[] $myFavorites
     * ログイン中の利用者のお気に入り店舗一覧
     * 
     * @return redirect('/mypage');
     * 
     */
    public function index(Request $request)
    {
        $customer = Auth::user()->customer();
        $customerName = Auth::user()->name;
        $reservations = $customer->reservations();
        $favorites = $customer->favorites();

        return view('customer-mypage', [
            'customerName' => $customerName,
            'nextReservations' => $reservations[0],
            'pastReservations' => $reservations[1],
            'favorites' => $favorites,
            'message' => $request->message ?? null,
        ]);
    }
}
