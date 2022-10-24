<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Reservationモデルクラス
 * 
 * 予約情報を管理
 * 
 * @var protected Integer customer_id
 * 利用客ID
 * 
 * @var protected Integer restaurant_id
 * 店舗ID
 * 
 * @var protected DateTime reservation_datetime
 * 予約日時
 * 
 * @var protected DateTime num_of_seats
 * 予約人数
 * 
 * @関数 public function restaurant()
 * 予約したRestaurantモデルを出力
 * 
 * @関数 public function resDate()
 * 予約日を出力
 * 
 * @関数 public function resTime()
 * 予約時刻を出力
 * 
 */
class Reservation extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'customer_id',
        'restaurant_id',
        'reservation_datetime',
        'num_of_seats',
    ];

    /**
     * restaurant()
     * 
     * 予約したRestaurantモデルを出力
     * 
     * @return Restaurant $this->belongsTo('App\Models\Restaurant');
     * 予約したRestaurantモデルを出力
     */
    public function restaurant(){
        return $this->belongsTo('App\Models\Restaurant');
    }

    /**
     * resDate()
     * 
     * 予約日を出力
     * 
     * @return Carbon::parse($this->reservation_datetime)->format('Y-m-d')
     * 予約日を出力
     */
    public function resDate(){
        return Carbon::parse($this->reservation_datetime)->format('Y-m-d');
    }

    /**
     * resTime()
     * 
     * 予約時刻を出力
     * 
     * @return Carbon::parse($this->reservation_datetime)->format('H:i')
     * 予約時刻を出力
     */
    public function resTime(){
        return Carbon::parse($this->reservation_datetime)->format('H:i');
    }
}


