<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Restaurant;

/**
 * Reservationコントローラークラス
 * 
 * 利用者に紐づくReservationモデルの作成、削除、更新、QRコード表示の処理
 * 
 * @関数 public function confirm()
 * 作成前の内容確認表示処理
 * 
 * @関数 public function create()
 * 作成処理
 * 
 * @関数 public function remove()
 * 削除処理
 * 
 * @関数 public function edit()
 * 更新ページ表示
 * 
 * @関数 public function update()
 * 更新処理
 * 
 * @関数 public function showQr()
 * QRコード表示処理
 */
class ReservationController extends Controller
{
    /**
     * confirm()
     * 
     * 作成前の内容確認表示処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @var Restaurant $restaurant
     * 表示するRestaurant
     * 
     * @return view('detail', [
     *             'restaurant' => $restaurant,
     *             'formAction' => '/reservation/create',
     *             'resDate' => $request->resDate,
     *             'resTime' => $request->resTime,
     *             'num_of_seats' => $request->num_of_seats,
     *             'backPage' => $request->redirect,
     *             'reservation_id' => $request->id,
     *         ]);
     */
    public function confirm(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)->get()[0];
        return view('detail', [
            'restaurant' => $restaurant,
            'formAction' => $request->reservation_id ? 'update' : 'create',
            'resDate' => $request->resDate,
            'resTime' => $request->resTime,
            'num_of_seats' => $request->num_of_seats,
            'backPage' => $request->redirect,
            'reservation_id' => $request->reservation_id ?? null,
        ]);
    }

    /**
     * create()
     * 
     * 作成処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Array $reservation
     * テーブルに代入する値の配列
     * 
     * @return view('done', [
     *             'backPage' => $request->redirect,
     *         ]);
     */
    public function create(Request $request)
    {
        $customerId = Auth::user()->customer()->id;
        $reservation = [
            'customer_id' => $customerId,
            'restaurant_id' => $request->restaurant_id,
            'reservation_datetime' => $request->resDate . ' ' . $request->resTime . ':00',
            'num_of_seats'=> $request->num_of_seats
        ];
        Reservation::create($reservation);
        return view('done', [
            'backPage' => $request->redirect,
        ]);
    }

    /**
     * remove()
     * 
     * 削除処理
     * 
     * @param Integer $id
     * 削除するReservationレコードのID
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Reservation[] $reservation
     * 削除予定の予約
     * ログイン中利用者のものでない場合は空
     * 
     * @return redirect('/mypage');
     * 
     */
    public function remove($id)
    {
        $customerId = Auth::user()->customer()->id;
        $reservation = Reservation::where('id', $id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($reservation) === 0) return redirect('/mypage');
        $reservation[0]->delete();
        return redirect('/mypage');
    }        

    /**
     * edit()
     * 
     * 更新ページ表示
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 更新するReservationレコードのID
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Reservation[] $reservation
     * 更新予定の予約
     * ログイン中利用者のものでない場合は空
     * 
     * @var Restaurant $restaurant
     * 表示するRestaurant
     * 
     * @return view('detail', [
     *             'restaurant' => $reservation[0]->restaurant()->first(),
     *             'formAction' => 'edit',
     *             'resDate' => $request->resDate ?? $reservation[0]->resDate(),
     *             'resTime' => $request->resTime ?? $reservation[0]->resTime(),
     *             'num_of_seats' => $request->num_of_seats ?? $reservation[0]->num_of_seats,
     *             'backPage' => '/mypage',
     *         ]);
     */
    public function edit(Request $request, $id)
    {
        $customerId = Auth::user()->customer()->id;
        $reservation = Reservation::where('id', $id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($reservation) === 0) return redirect('/mypage');
        return view('detail', [
            'restaurant' => $reservation[0]->restaurant()->first(),
            'formAction' => 'edit',
            'resDate' => $request->resDate ?? $reservation[0]->resDate(),
            'resTime' => $request->resTime ?? $reservation[0]->resTime(),
            'num_of_seats' => $request->num_of_seats ?? $reservation[0]->num_of_seats,
            'backPage' => '/mypage',
            'reservation_id' => $id,
        ]);
    }

    /**
     * create()
     * 
     * 作成処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 更新するReservationレコードのID
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Reservation[] $reservation
     * 更新予定の予約
     * ログイン中利用者のものでない場合は空
     * 
     * @return view('done', [
     *             'backPage' => 'mypage',
     *         ]);
     */
    public function update(Request $request, $id)
    {
        $customerId = Auth::user()->customer()->id;
        $reservation = Reservation::where('id', $id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($reservation) === 0) return redirect('/mypage');
        $reservation[0]->reservation_datetime = $request->resDate . ' ' . $request->resTime . ':00';
        $reservation[0]->num_of_seats = $request->num_of_seats;
        Reservation::where('id', $id)->update([
            'customer_id' => $customerId,
            'restaurant_id' => $reservation[0]->restaurant_id,
            'reservation_datetime' => $reservation[0]->reservation_datetime,
            'num_of_seats'=> $reservation[0]->num_of_seats
        ]);
        return view('done', [
            'backPage' => '/mypage',
        ]);
    }
}
