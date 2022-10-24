<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Reviewモデルクラス
 * 
 * 各予約に対する評価情報を管理
 * 
 * @var protected Integer reservation_id
 * 予約ID
 * 
 * @var protected Integer score
 * 5段階評価
 * 
 * @var protected String comment
 * コメント
 * 
 */
class Review extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'reservation_id',
        'score',
        'comment',
    ];

}
