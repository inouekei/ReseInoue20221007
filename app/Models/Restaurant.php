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
 * ログイン中利用客の該当店舗におけるお気に入りレコードを出力
 * 
 * @関数 public function reservations()
 * 該当店舗に紐づく全予約を出力
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

    /**
     * reservations()
     * 
     * 該当店舗に紐づく全予約を出力
     * 
     * @return boolean $myFavorite
     * お気に入り登録されている場合の該当レコード
     */
    public function reservations(){
        return $this->hasMany('App\Models\Reservation')->get();
    }
    
    /**
     * managers()
     * 
     * 該当店舗の店舗代表者すべてを出力
     * 
     * @return $this->belongsToMany('App\Models\Manager');
     * 店舗代表者の管理店舗すべて
     */
    public function managers(){
        return $this->belongsToMany('App\Models\Manager');
    }

}
