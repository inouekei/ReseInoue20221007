<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Mail\MailMain;
use App\Models\User;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Http\Requests\ReservationRequest;

/**
 * 利用者に紐づくReservationモデルの作成、削除、更新、メール送信、QRコード処理
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
 * @関数 public function createEmail()
 * メール作成ページ表示処理
 *
 * @関数 public function sendEmail()
 * メール送信処理
 *
 * @関数 public function showQr()
 * QRコード表示処理
 *
 * @関数 public function show()
 * QRコード読取ページ、参照ページ表示
 */
class ReservationController extends Controller
{
    /**
     * confirm()
     * 
     * 作成前の内容確認表示処理
     * 
     * @param ReservationRequest $request
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
    public function confirm(ReservationRequest $request)
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
     * @param ReservationRequest $request
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
    public function create(ReservationRequest $request)
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
     * マイページ表示
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
     * update()
     * 
     * 更新処理
     * 
     * @param ReservationRequest $request
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
    public function update(ReservationRequest $request, $id)
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

    /**
     * createEmail()
     * 
     * メール作成ページ表示処理
     * 
     * @param Integer $id
     * メールの送信先利用者に紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * メールの送信先利用者に紐づくReservationモデル
     * 
     * @return view('email', [
     *              メール作成ページ
     *             'reservation_id' => $id,
     *              メールの送信先利用者に紐づくReservationモデル
     *         ]);
     */
    public function createEmail($id)
    {
        $reservation = Reservation::find($id);
        return view('email', [
            'reservation' => $reservation,
        ]);
    }
    /**
     * sendEmail()
     * 
     * メール送信処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * メールの送信先利用者に紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * 表示QRコードに紐づくReservationモデル
     * 
     * @var User $user
     * メールの送信先利用者に紐づくUserモデル
     * 
     * @var Array $data
     * Mailableに渡すデータ
     * 
     * @return redirect('/mypage');
     */
    public function sendEmail(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $user = $reservation->customer->user;
        $data = [
            'from' => $reservation->restaurant->name . '　代表スタッフ',
            'subject' => $request->subject,
            'message' => $request->message,
        ];
    	Mail::to($user->email, $user->name . '様')
                ->send(new MailMain($data));
    	return redirect('/mypage')->with('message', 'メールが送信されました');
    }
    /**
     * showQr()
     * 
     * QRコード表示処理
     * 
     * @param Integer $id
     * 表示QRコードに紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * 表示QRコードに紐づくReservationモデル
     * 
     * @return view('show-qr', [
     *              QRコード表示ページ
     *             'reservation' => $reservation,
     *              表示QRコードに紐づくReservationモデル
     *         ]);
     */
    public function showQr($id)
    {
        $reservation = Reservation::find($id);
        return view('show-qr', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * show()
     * QRコード読取ページ、参照ページ表示
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 更新するReservationレコードのID
     * 
     * @var Reservation $reservation
     * 表示QRコードに紐づくReservationモデル
     * 
     * @return view('read-qr', ['reservation' => null]);
     * idが0もしくは該当する予約がないとき
     * @return view('read-qr', ['reservation' => $reservation]);
     * 該当する予約があったとき
     */
    public function show(Request $request, $id)
    {
        if ($id === "0") return view('read-qr', ['reservation' => null]);
        $reservation = Reservation::find($id);
        if ($reservation->restaurant->managers->find(Auth::user()->manager())){
            return view('read-qr', ['reservation' => $reservation]);
        }
    }
}
