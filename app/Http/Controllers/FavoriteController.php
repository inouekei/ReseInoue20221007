<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\Favorite;

/**
 * Favoriteコントローラークラス
 * 
 * 利用者に紐づくFavoriteモデルの作成、削除の処理
 * 
 * @関数 public function create()
 * 作成処理
 * 
 * @関数 public function remove()
 * 削除処理
 */
class FavoriteController extends Controller
{
    /**
     * create()
     * 
     * 作成処理
     * 
     * @param Request $request
     * お気に入り情報
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Array $favorite
     * テーブルに代入する値の配列
     * 
     * @var Array $favorites
     * テーブルに代入する値がすでに登録されている場合の該当レコード
     * 
     * @return redirect('/');
     * 
     */
    public function create(Request $request)
    {
        $customerId = Auth::user()->customer()->id;
        $favorite = [
            'customer_id' => $customerId,
            'restaurant_id' => $request->restaurant_id,
        ];
        $favorites = Favorite::where([
            ['customer_id', '=', $customerId],
            ['restaurant_id', '=', $request->restaurant_id],
        ])->get();
        if(sizeof($favorites) === 0){
            Favorite::create($favorite);
        } 
        return redirect('/');
    }

    /**
     * remove()
     * 
     * 削除処理
     * 
     * @param Request $request
     * 移動前ページの情報
     * 
     * @param String $id
     * 削除するFavoriteレコードのID
     * 
     * @var Integer $customerId
     * ログイン中の利用者の利用者ID
     * 
     * @var Array $favorite
     * 削除予定のお気に入り
     * ログイン中利用者のものでない場合は空
     * 
     * @return redirect('/');
     * 
     */
    public function remove(Request $request, $id)
    {
        $customerId = Auth::user()->customer()->id;
        $favorite = Favorite::where('id', $id)
                        ->where('customer_id', $customerId)->get();
        if(sizeof($favorite) === 0) return redirect($request->redirect);
        $favorite[0]->delete();
        return redirect($request->redirect);
    }        
}
