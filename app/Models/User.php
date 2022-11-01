<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Userモデルクラス
 * 
 * ユーザー（利用者、店舗代表者、管理者）を管理
 * 
 * @var protected String name
 * ユーザー名
 * 
 * @var proteccted String email
 * メールアドレス
 * 
 * @var protected String password
 * パスワード
 * 
 * @var protected String remember_token
 * ログイントークン
 * 
 * @var protected String email_verified_at
 * メールアドレス確認日時
 * 
 * @関数 public function customer()
 * ユーザーに紐づく利用客レコードを出力
 * 
 * @関数 public function administrator()
 * ユーザーに紐づく管理者レコードを出力
 * 
 * @関数 public function manager()
 * ユーザーに紐づく管理者レコードを出力
 * 
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * customer()
     * 
     * ユーザーに紐づく利用客レコードを出力
     * 
     * @var Customer $customer
     * ユーザーに紐づく利用客レコード
     * 
     * @return Customer $customer
     * ユーザーに紐づく利用客レコード
     */
    public function customer(){
        $customer = $this->hasOne('App\Models\Customer')->first();
        return $customer;        
    }

    /**
     * administrator()
     * 
     * ユーザーに紐づく管理者レコードを出力
     * 
     * @var Administrator $administrator
     * ユーザーに紐づく管理者レコード
     * 
     * @return Administrator $administrator
     * ユーザーに紐づく管理者レコード
     */
    public function administrator(){
        $administrator = $this->hasOne('App\Models\Administrator')->first();
        return $administrator;        
    }

    /**
     * manager()
     * 
     * ユーザーに紐づく管理者レコードを出力
     * 
     * @var Manager $manager
     * ユーザーに紐づく管理者レコード
     * 
     * @return Manager $manager
     * ユーザーに紐づく管理者レコード
     */
    public function manager(){
        $manager = $this->hasOne('App\Models\Manager')->first();
        return $manager;        
    }
}
