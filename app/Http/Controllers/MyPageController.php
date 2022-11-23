<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

/**
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
     * @var Administrator $administrator
     * ログイン中の管理者
     * 
     * @var Customer $customer
     * ログイン中の利用者
     * 
     * @var Customer $customerName
     * ログイン中の利用者のユーザー名
     * 
     * @var Customer $manager
     * ログイン中の店舗代表者
     * 
     * @var Customer $managerName
     * ログイン中の店舗代表者のユーザー名
     * 
     * @var [Reservation[], Reservation[]] $reservations
     * ログインユーザーに紐づく予約（利用者の場合は自身が予約したもの、店舗代表者の場合は自身の管理店舗に紐づくもの）
     * 0番目に未来のもの、1番目に過去のものが挿入
     * 
     * @var Restaurant[] $restaurants
     * ログイン中の店舗代表者の管理店舗一覧
     * 
     * @var Favorite[] $favorites
     * ログイン中の利用者のお気に入り一覧
     * 
     * @return view('admin-mypage');
     * 管理者用マイページビュー
     * @return view('customer-mypage', [
     * 利用者用マイページビュー
     *                 'customerName' => $customerName,
     *                  利用者のユーザー名
     *                 'nextReservations' => $reservations[0],
     *                  未来の予約一覧
     *                 'pastReservations' => $reservations[1],
     *                  過去の予約一覧
     *                 'favorites' => $favorites,
     *                  お気に入り情報
     *                 'message' => $request->message ?? null,
     *                  メッセージ
     *             ]);
     *@return view('manager-mypage', [
     * 店舗代表者用マイページビュー
     *                 'managerName' => $managerName,
     *                  利用者のユーザー名
     *                 'nextReservations' => $reservations[0],
     *                  未来の予約一覧
     *                 'pastReservations' => $reservations[1],
     *                  過去の予約一覧
     *                 'restaurants' => $restaurants,
     *                  管理店舗一覧
     *                 'message' => $request->message ?? null,
     *                  メッセージ
     *             ]);
     */
    public function index(Request $request)
    {
        $administrator = Auth::user()->administrator();
        if($administrator) return view('admin-mypage');

        $customer = Auth::user()->customer();
        if($customer){
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
        $manager = Auth::user()->manager();
        if($manager){
            $managerName = Auth::user()->name;
            $restaurants = $manager->restaurants;
            $reservations = $manager->reservations();
    
            return view('manager-mypage', [
                'managerName' => $managerName,
                'nextReservations' => $reservations[0],
                'pastReservations' => $reservations[1],
                'restaurants' => $restaurants,
                'message' => $request->message ?? null,
            ]);
        }

    }
}
