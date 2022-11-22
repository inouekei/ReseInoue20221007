<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailMain;
use App\Models\Reservation;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

/**
 * 支払処理
 * 
 * @関数 public function sendLink()
 * 支払リンク送信処理
 *
 * @関数 public function add()
 * 支払内容入力ページ表示処理
 * 
 * @関数 public function pay()
 * 支払記録処理
 */
class PaymentController extends Controller
{
    /**
     * sendLink()
     * 
     * 支払リンク送信処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 支払に紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * メールの送信先利用者に紐づくReservationモデル
     * 
     * @var User $user
     * メールの送信先利用者のUserモデル
     * 
     * @var Array $data
     * Mailableに渡すデータ
     * 
     * @return redirect('/mypage')->with('message', 'メールが送信されました');
     * マイページにメッセージ付きでリダイレクト
     */
    public function sendLink(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $user = $reservation->customer->user;
        $data = [
            'from' => $reservation->restaurant->name . '　代表スタッフ',
            'subject' => $request->subject,
            'message' => 'ご利用ありがとうございます。こちらのリンクより' . $request->amount . '円をお支払いください。'
                . "https://reseinoue.herokuapp.com/reservation/" . $id . '/pay?amount=' . $request->amount
        ];
    	Mail::to($user->email, $user->name . '様')
                ->send(new MailMain($data));
    	return redirect('/mypage')->with('message', 'メールが送信されました');
    }

    /**
     * add()
     * 
     * 支払内容入力ページ表示処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 支払に紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * 支払に紐づくReservationモデル
     * 
     * @return redirect('/mypage');
     * ログイン中利用者に紐づかない予約の場合は、マイページにリダイレクト
     * 
     * @return view('pay', [
     *              支払ページ
     *             'reservation' => $reservation,
     *              支払に紐づくReservationモデル
     *         ]);
     */
    public function add(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!(Auth::user()->customer()->id === $reservation->customer->id)) return redirect('/mypage');
        return view('pay', [
            'reservation' => $reservation,
            'amount' => $request->amount,
        ]);
    }

    /**
     * pay()
     * 
     * 支払記録処理
     * 
     * @param Request $request
     * 入力内容
     * 
     * @param Integer $id
     * 支払に紐づくReservationモデルのID
     * 
     * @var Reservation $reservation
     * 支払に紐づくReservationモデル
     * 
     * @var Customer $customer
     * Stripeの顧客モデル
     * 
     * @var Charge $charge
     * Stripeの支払モデル
     * 
     * @return view('paid');
     *              支払完了ページ
     */
    public function pay(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!(Auth::user()->customer()->id === $reservation->customer->id)) return;

        try
        {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

            return view('paid');
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }
    }
}
