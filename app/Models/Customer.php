<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Customerモデルクラス
 * 
 * 利用客情報を管理
 * 
 * @var protected Integer user_id
 * ユーザーID
 * 
 * @関数 public function user()
 * 利用客のユーザーを出力
 * 
 * @関数 public function reservations()
 * 利用客の予約情報を出力
 * 
 * @関数 public function favorites()
 * 利用客のお気に入りレコードを出力
 * 
 */
class Customer extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'user_id',
    ];

    /**
     * user()
     * 
     * 利用客のユーザーを出力
     * 
     * @return User $this->belongsTo('App\Models\User')
     * 利用客のユーザーを出力
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * reservations()
     * 
     * 利用客の予約情報を出力
     * 0番目に今日以後のもの、1番目に昨日以前のものを挿入
     * 
     * @var Reservation[] $allReservations
     * 利用客の全予約情報
     * 
     * @var Reservation[] $nextReservations
     * 利用客の未来の予約情報
     * 
     * @var Reservation[] $pastReservations
     * 利用客の過去の予約情報
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
     * 利用客の予約情報
     */
    public function reservations(){
        $allReservations = $this->hasMany('App\Models\Reservation')->get();
        $nextReservations = [];
        $pastReservations = [];
        $todayDate = Carbon::today();
        $iNext = 1;
        $iPast = 1;
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
        return [$nextReservations, $pastReservations];
    }

    /**
     * favorites()
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
     * @return Favorite $favorites
     * お気に入り登録されている場合の該当レコード
     */
    public function favorites(){
        return $this->hasMany('App\Models\Favorite')->get();
    }
}