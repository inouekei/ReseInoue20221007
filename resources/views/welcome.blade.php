@extends('layouts.customer-reservation-info')

<style>
    .reserve-card{
        position: relative;
        width: 300px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 3px 3px 3px 0 gray; 
        background: darkblue;
        color: white;
    }
    .div-cancel{
        position: absolute;
        top: 15px;
        right: 15px;
        width: 20px;
        height: 20px;
        padding: 0;
        border: solid white 2px;
        border-radius: 20px;
        text-align: center;
        line-height: 20px;
        color: white;
        cursor: pointer;
    }
    .tbl-reserve{
        margin: 20px 0 10px;
        color: white;
    }
    .td-reserve{
        padding-right: 30px;
    }
    .div-right-content{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>

@section('info-top-ttl', '予約状況')
@section('info-top')
<div class="reserve-card">
    <div class="div-cancel">×</div>
    <i class="fa-solid fa-clock"></i>
    <span>予約1</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>仙人</td>
        </tr>
        <tr>
            <td class='td-reserve'>Date</td>
            <td>2021-04-01</td>
        </tr>
        <tr>
            <td class='td-reserve'>Time</td>
            <td>17:00</td>
        </tr>
        <tr>
            <td class='td-reserve'>Number</td>
            <td>1人</td>
        </tr>
    </table>
</div>
@endsection
@section('info-bottom-ttl', '過去のご来店')
@section('info-bottom')
<div class="reserve-card">
    <i class="fa-solid fa-clock"></i>
    <span>予約1</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>仙人</td>
        </tr>
        <tr>
            <td class='td-reserve'>Date</td>
            <td>2021-04-01</td>
        </tr>
        <tr>
            <td class='td-reserve'>Time</td>
            <td>17:00</td>
        </tr>
        <tr>
            <td class='td-reserve'>Number</td>
            <td>1人</td>
        </tr>
    </table>
</div>
@endsection
@section('div-right-ttl', 'お気に入り店舗')
@section('div-right-content')
<div class='div-restaurant-card div-restaurant-card-mypage'>
    <div class='div-restaurant-card-img'></div>
    <div class='div-restaurant-card-content'>
        <p class='p-restaurant-name'>仙人</p>
        <small class='small-tags'>#東京都#寿司</small>
        <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
        <div class='div-heart'>♥</div>
    </div>
</div>
<div class='div-restaurant-card div-restaurant-card-mypage'>
    <div class='div-restaurant-card-img'></div>
    <div class='div-restaurant-card-content'>
        <p class='p-restaurant-name'>仙人</p>
        <small class='small-tags'>#東京都#寿司</small>
        <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
        <div class='div-heart'>♥</div>
    </div>
</div>
<div class='div-restaurant-card div-restaurant-card-mypage'>
    <div class='div-restaurant-card-img'></div>
    <div class='div-restaurant-card-content'>
        <p class='p-restaurant-name'>仙人</p>
        <small class='small-tags'>#東京都#寿司</small>
        <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
        <div class='div-heart'>♥</div>
    </div>
</div>
@endsection
