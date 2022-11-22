@extends('layouts.manager-reservation-info')

<style>
    .reserve-card{
        position: relative;
        width: 300px;
        margin-bottom: 30px;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 3px 3px 3px 0 gray; 
        background: darkblue;
        color: white;
    }
    .btn-cancel{
        position: absolute;
        top: 15px;
        right: 15px;
        width: 30px;
        height: 30px;
        padding: 0;
        border: solid white 2px;
        border-radius: 20px;
        background: none;
        text-align: center;
        font-size: 20pt;
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
    .div-restaurant-card-new{
        height: 200px;
        background: darkblue;
        line-height: 200px;
        text-align: center;
    }
    .a-new{
        text-decoration: none;
        color: white;
    }
    .form-main{
        position: relative;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 20px;
        background: mediumblue;
        box-shadow: 3px 3px 3px 0 gray; 
        border-radius: 5px;
    }
    .div-form-content{
        padding: 20px;
    }
    #canvas{
        margin-bottom: 20px;
    	width: 100%;
        height: auto;
    	background-color: silver;
    }
    #div-msg{
        color: white;
    }
</style>
<script src="{{ secure_asset('js/jsQR.js') }}"></script>
<script src="{{ secure_asset('js/main.js') }}"></script>
@section('page-title', 'QR読取')
@section('info-top-ttl', 'お客様情報')
@section('info-top')
<div class="reserve-card">
    <i class="fa-solid fa-clock"></i>
    <span>{{'予約'}}</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>{{$reservation->restaurant->name ?? '読取中'}}</td>
        </tr>
        @if ($reservation)
        <tr>
            <td class='td-reserve'>Customer</td>
            <td>{{$reservation->customer->user->name ?? ''}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Date</td>
            <td>{{$reservation->resDate() ?? ''}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Time</td>
            <td>{{$reservation->resTime() ?? ''}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Number</td>
            <td>{{$reservation->num_of_seats . '人' ?? ''}}</td>
        </tr>
        @endif
    </table>
    @if ($reservation)
    <form action={{'/reservation/'. $reservation->id .'/send'}} method='get'>
        <input class='input-main input-full' name='amount' placeholder='Amount'>
        <button class='btn-reserve-card btn-main'>お支払いリンクを送信</button>
    </form>
    @endif
</div>
@endsection
@section('div-right-ttl', 'QRコード')
@section('div-right-content')
<div>
    <form name='formMain' class='form-main' action='' method='post'>
        <canvas id="canvas"></canvas>
        @csrf
        <div id='div-msg'>カメラのアクセスを許可してください</div>
    </form>
</div>
@endsection
