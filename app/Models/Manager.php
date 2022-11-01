<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Managerモデルクラス
 * 
 * 店舗代表者情報を管理
 * 
 * @var protected Integer user_id
 * ユーザーID
 * 
 * @関数 public function restaurants()
 * 店舗代表者の管理店舗を出力
 * 
 * @関数 public function reservations()
 * 店舗代表者の管理店舗すべてに紐づく予約情報を出力
 * 
 */
class Manager extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'user_id',
    ];

    /**
     * restaurants()
     * 
     * 店舗代表者の管理店舗すべてを出力
     * 
     * @return $this->belongsToMany('App\Models\Restaurant');
     * 店舗代表者の管理店舗すべて
     */
    public function restaurants(){
        return $this->belongsToMany('App\Models\Restaurant');
    }

    /**
     * reservations()
     * 
     * 店舗代表者の管理店舗すべてに紐づく予約情報を出力
     * 0番目に今日以後のもの、1番目に昨日以前のものを挿入
     * 
     * @var Restaurant[] $allRestaurants
     * 店舗代表者の管理店舗すべて
     * 
     * @var Reservation[] $allReservations
     * 店舗代表者の各管理店舗に紐づく予約情報
     * 
     * @var Reservation[] $nextReservations
     * 店舗代表者の管理店舗すべてに紐づく未来の予約情報
     * 
     * @var Reservation[] $pastReservations
     * 店舗代表者の管理店舗すべてに紐づく過去の予約情報
     * 
     * @var DateTime $todayDate
     * 今日の0時を示す変数
     * 
     * @var DateTime $iNext
     * 未来の予約表示のナンバリング
     * 
     * @var DateTime $iPast
     * 過去の予約表示のナンバリング
     * 
     * @var DateTime $resDateTime
     * 各予約の日時情報
     * 
     * @return [
     *      Reservation[] $nextReservations,
     *      Reservation[] $pastReservations,
     * ]
     * 予約情報
     */
    public function reservations(){
        $allRestaurants = $this->restaurants;
        $nextReservations = [];
        $pastReservations = [];
        $todayDate = Carbon::today();
        $iNext = 1;
        $iPast = 1;
        foreach($allRestaurants as $restaurant){
            $allReservations = $restaurant->reservations();
            foreach($allReservations as $reservation){
                $resDateTime = Carbon::parse($reservation->reservation_datetime);
                if($todayDate->lt($resDateTime)){
                    $reservation['numbering'] = $iNext;
                    $iNext++;
                    array_push($nextReservations, $reservation);
                }else{
                    $reservation['numbering'] = $iPast;
                    $iPast++;
                    array_push($pastReservations, $reservation);
                }
            }
        }
        return [$nextReservations, $pastReservations];
    }
}
