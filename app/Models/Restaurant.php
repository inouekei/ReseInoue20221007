<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Restaurantモデルクラス
 * 
 * 店舗情報を管理
 * 
 * @var protected String name
 * 店舗名
 * 
 * @var proteccted String image_path
 * 画像格納パス
 * 
 * @var protected String area
 * 地域名
 * 
 * @var protected String genre
 * ジャンル名
 * 
 * @var protected String description
 * 概要
 * 
 * @関数 public function myFavorite()
 * 利用客の該当店舗におけるお気に入りレコードを出力
 * 
 */
class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'name',
        'image_path',
        'area',
        'genre',
        'description',
    ];

    /**
     * myFavorite()
     * 
     * 利用客のお気に入り登録を出力
     * 
     * @param Integer $customer_id
     * 検索する利用客ID
     * 
     * @var Favorite $myFavorite
     * お気に入り登録されている場合の該当レコード
     * なければnull
     * 
     * @return boolean $myFavorite
     * お気に入り登録されている場合の該当レコード
     */
    public function myFavorite(){
        $customerId = Auth::user()->customer()->id;
        $myFavorite = $this->hasMany('App\Models\Favorite')
                        ->where([['customer_id', '=', $customerId]])
                        ->get();
        if(sizeof($myFavorite) === 0) return null;
        else return $myFavorite[0];
    }

    
}
