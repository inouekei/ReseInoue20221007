<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

/**
 * Restaurantモデル一覧参照、、検索、個別参照、作成、更新の処理
 * 
 * @関数 public function index()
 * 一覧参照、検索結果表示
 * 
 * @関数 public function show()
 * 個別参照
 * 
 * @関数 public function edit()
 * 作成、更新ページ表示
 * 
 * @関数 public function update()
 * 作成、更新処理
 *  
 */
class RestaurantController extends Controller
{
    /**
     * index()
     * 
     * 一覧参照、検索結果表示
     * 
     * @param Request $request
     * 検索条件（ないときは一覧表示）
     * 
     * @var [[String, String, String]] $restaurantQuery
     * Restaurantを検索するための（カラム名、演算子、検索キー）のクエリ配列
     * 
     * @var Restaurant[] $restaurants
     * 表示するRestaurant一覧
     * 
     * @var Restaurant[] $message
     * 検索に関してページに表示するメッセージ
     * 
     * @return view('index', [
     *              一覧ビュー
     *             'restaurants' => $restaurants,
     *              店舗一覧
     *             'message' => $message,
     *              検索結果が０のときのメッセージ
     *             'request' => $request,
     *              保持する検索条件
     *         ]);
     * 表示するRestaurant一覧をindexビューに渡す
     */
    public function index(Request $request)
    {
        $restaurantQuery = [];
        $message = null;

        if($request->area <> null && $request->area <> 'All area'){
            array_push($restaurantQuery, ['area', '=', $request->area]);
        };
        if($request->genre <> null && $request->genre <> 'All genre'){
            array_push($restaurantQuery, ['genre', '=', $request->genre]);
        };
        if($request->name <> null){
            array_push($restaurantQuery, ['name', 'LIKE BINARY', "%{$request->name}%"]);
        };

        $restaurants = Restaurant::where($restaurantQuery)->get();
        if(sizeof($restaurants) === 0) $message = '条件に合う店舗がありません';

        return view('index', [
            'restaurants' => $restaurants,
            'message' => $message,
            'request' => $request,
        ]);
    }

    /**
     * show()
     * 
     * 個別参照
     * 
     * @param Request $request
     * 移動前ページの情報
     * 
     * @param Integer $id
     * 参照するRestaurantレコードのID
     * 
     * @var Restaurant $redirect
     * 戻り先のページリンク
     * 店舗一覧から移動した場合は検索状況も保持する
     * 
     * @var Restaurant $restaurant
     * 表示するRestaurant
     * 
     * @return view('detail', [
     *              詳細ページ
     *             'restaurant' => $restaurant,
     *              店舗モデル
     *             'formAction' => 'confirm',
     *              ページのアクション
     *             'backPage' => $redirect,
     *              戻り先
     *             'resDate' => $request->resDate ?? null,
     *              予約日入力内容
     *             'resTime' => $request->resTime ?? null,
     *              予約時刻入力内容
     *             'num_of_seats' => $request->num_of_seats ?? null,
     *              予約人数入力内容
     *         ]);
     * 表示するRestaurant一覧をindexビューに渡す
     */
    public function show(Request $request, $id)
    {
        $redirect = $request->redirect
        . ((($request->searchArea)||($request->searchGenre)||($request->searchName))
            ? '?' : '') 
        . ($request->searchArea ? ('&area=' . $request->searchArea) : '') 
        . ($request->searchGenre ? ('&genre=' . $request->searchGenre) : '') 
        . ($request->searchName ? ('&name=' . $request->searchName) : '');

        $restaurant = Restaurant::where('id', $id)->get()[0];
        return view('detail', [
            'restaurant' => $restaurant,
            'formAction' => 'confirm',
            'backPage' => $redirect,
            'resDate' => $request->resDate ?? null,
            'resTime' => $request->resTime ?? null,
            'num_of_seats' => $request->num_of_seats ?? null,
        ]);
    }
    /**
     * edit()
     * 
     * 作成、更新ページ表示
     * 
     * @param Integer $id
     * 参照するRestaurantレコードのID
     * 0のときは新規作成
     * 
     * @var Restaurant $restaurant
     * 表示するRestaurant
     * 新規作成時はnull
     * 
     * @return view('edit-restaurant', [
     *              店舗作成・更新ページ
     *             'restaurant' => $restaurant,
     *              店舗モデル
     *         ]);
     * 表示するRestaurant一覧をindexビューに渡す
     */
    public function edit($id)
    {
        $restaurant = ($id <> 0 ? Restaurant::find($id) : null);
        return view('edit-restaurant', [
                    'restaurant' => $restaurant,

        ]);
    }
    /**
     * update()
     * 
     * 作成、更新ページ表示
     * 
     * @param Integer $id
     * 参照するRestaurantレコードのID
     * 0のときは新規作成
     * 
     * @param Request $request
     * 登録するRestaurant情報
     * 
     * @var Restaurant $restaurant
     * 登録するRestaurantモデル
     * 
     * @return view('edit-restaurant', [
     *              店舗作成・更新ページ
     *             'restaurant' => $restaurant,
     *              店舗モデル
     *         ]);
     * 表示するRestaurant一覧をindexビューに渡す
     */
    public function update(Request $request, $id)
    {
        if(!($request->image->isValid())) return;
        $restaurant = $request->all();
        $restaurant['image_path'] = str_replace(
            'public/', '/storage/', $request->image->store('public'));        
        unset($restaurant['_token']);
        unset($restaurant['image']);
        if($id <> 0){
            Restaurant::find($id)->update($restaurant);
            return redirect('/mypage');
        }
        Restaurant::create($restaurant);
        $restaurant = Restaurant::latest('id')->first();
        $restaurant->managers()->attach(Auth::user()->manager()->id);
        return redirect('/mypage');
    }
}
