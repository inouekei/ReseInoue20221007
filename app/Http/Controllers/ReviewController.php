<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Review;

/**
 * Reviewコントローラークラス
 * 
 * 予約に紐づくReviewモデルの作成
 * 
 * @関数 public function add()
 * 作成ページ表示処理
 * 
 * @関数 public function create()
 * 作成処理
 */
class ReviewController extends Controller
{
    /**
     * add()
     * 
     * 作成ページ表示処理
     * 
     * @param Request $request
     * 予約ID
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Reservation[] $reservations
     * 評価予定の予約
     * ログイン中利用者のものでない場合は空
     * 
     * @var Review[] $reviews
     * 評価予定の予約に紐づく評価
     * まだ登録されていない場合は空
     * 
     * @return view('review', [
     *             'restaurant' => $reservations[0]->restaurant()->first(),
     *             'reservation_id' => $request->reservation_id,
     *         ]);
     */
    public function add(Request $request)
    {
        $customerId = Auth::user()->customer()->id;
        $reservations = Reservation::where('id', $request->reservation_id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($reservations) === 0) return redirect('/mypage');
        $reviews = Review::where('reservation_id', $request->reservation_id)->get();
        if(sizeof($reviews) <> 0) return redirect('/mypage');

        return view('review', [
            'restaurant' => $reservations[0]->restaurant()->first(),
            'reservation_id' => $request->reservation_id,
        ]);
    }
    /**
     * create()
     * 
     * 作成処理
     * 
     * @param Request $request
     * 評価情報
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Reservation[] $reservations
     * 評価予定の予約
     * ログイン中利用者のものでない場合は空
     * 
     * @var Array $reviews
     * テーブルに代入する値がすでに登録されている場合の該当レコード
     * 
     * @var Array $review
     * テーブルに代入する値の配列
     * 
     * @var String $redirect
     * 戻り先のページリンク
     * 
     * @return redirect($redirect);
     * 
     */
    public function create(Request $request)
    {
        $customerId = Auth::user()->customer()->id;
        $reservations = Reservation::where('id', $request->reservation_id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($reservations) === 0) return redirect('/mypage');
        $reviews = Review::where('reservation_id', $request->reservation_id)->get();
        if(sizeof($reviews) <> 0) return redirect('/mypage');

        $review = [
            'customer_id' => $customerId,
            'reservation_id' => $request->reservation_id,
            'score' => $request->score,
            'comment' => $request->comment,
        ];
        Review::create($review);
        $redirect = '/mypage?message=' . urlencode('ご評価いただきありがとうございます');
        return redirect($redirect);
    }
}
