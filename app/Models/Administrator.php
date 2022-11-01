<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Administratorモデルクラス
 * 
 * 管理者情報を管理
 * 
 * @var protected Integer user_id
 * ユーザーID
 * 
 */
class Administrator extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = [
        'user_id',
    ];
}
