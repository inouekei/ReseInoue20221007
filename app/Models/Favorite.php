<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Favoriteモデルクラス
 * 
 * お気に入り情報を管理
 * 
 * @var protected Integer customer_id
 * 利用客ID
 * 
 * @var protected Integer restaurant_id
 * 店舗ID
 * 
 * @関数 public function restaurant()
 * お気に入りのRestaurantモデルを出力
 */
class Favorite extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'customer_id',
        'restaurant_id',
    ];

    /**
     * restaurant()
     * 
     * お気に入りのRestaurantモデルを出力
     * 
     * @return Restaurant $this->belongsTo('App\Models\Restaurant');
     * お気に入りのRestaurantモデルを出力
     */
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }
}
