@extends('layouts.customer-reservation-info')

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
    @media screen and (max-width: 768px){
        .reserve-card{
            width: 100%;
        }
</style>

@section('customer-name', $customerName)
@section('message', $message ?? '')
@section('info-top-ttl', '予約状況')
@section('info-top')
@if(sizeof($nextReservations) === 0)
<span>ご予約はありません。</span>
@else
@foreach($nextReservations as $reservation)
<div class="reserve-card">
    <form action={{'/reservation/' . $reservation->id . '/remove'}} method='post'>
        @csrf
        <button class="btn-cancel" submit>×</button>
    </form>
    <i class="fa-solid fa-clock"></i>
    <span>{{'予約' . $reservation->numbering}}</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>{{$reservation->restaurant->name}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Date</td>
            <td>{{$reservation->resDate()}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Time</td>
            <td>{{$reservation->resTime()}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Number</td>
            <td>{{$reservation->num_of_seats . '人'}}</td>
        </tr>
    </table>
    <a href={{'/reservation/' . $reservation->id . '/edit'}} class="btn-main btn-reserve-card">修正する</a>
    <a href={{'/reservation/' . $reservation->id . '/qr'}} class="btn-main btn-reserve-card">QR表示</a>
</div>
@endforeach
@endif
@endsection
@section('info-bottom-ttl', '過去のご来店')
@section('info-bottom')
@if(sizeof($pastReservations) === 0)
<span>過去のご来店はありません。</span>
@else
@foreach($pastReservations as $reservation)
<div class="reserve-card">
    <i class="fa-solid fa-clock"></i>
    <span>{{'来店' . $reservation->numbering}}</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>{{$reservation->restaurant->name}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Date</td>
            <td>{{$reservation->resDate()}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Time</td>
            <td>{{$reservation->resTime()}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Number</td>
            <td>{{$reservation->num_of_seats . '人'}}</td>
        </tr>
    </table>
    @if(!$reservation->review)
    <form action='/review/add' method='get'>
        <input type='hidden' name='reservation_id' value={{$reservation->id}}>
        <button class="btn-main btn-reserve-card">評価する</button>
    </form>
    @endif
</div>
@endforeach
@endif
@endsection
@section('div-right-ttl', 'お気に入り店舗')
@section('div-right-content')
@if(sizeof($favorites) === 0)
<span>お気に入りはありません。</span>
@else
@foreach($favorites as $favorite)
<div class='div-restaurant-card div-restaurant-card-mypage'>
    <img class='img-restaurant-card' src={{$favorite->restaurant->image_path}}></img>
    <div class='div-restaurant-card-content'>
        <p class='p-restaurant-name'>{{$favorite->restaurant->name}}</p>
        <small class='small-tags'>
            {{'#' . $favorite->restaurant->area .
                '#' . $favorite->restaurant->genre}}
        </small>
        <form action={{'/detail/' . $favorite->restaurant->id}} method='get'>
            @csrf
            <input type='hidden' name='redirect' value='/mypage'>
            <button class='btn-main btn-restaurant-card' submit>詳しくみる</button>
        </form>
        <form action={{'/favorite/' . $favorite->id . '/remove'}} method='post'>
            @csrf
            <input type='hidden' name='redirect' value='/mypage'>
            <button class='div-heart div-heart-red'><i class="fa-solid fa-heart"></i></button>
        </form>
    </div>
</div>
@endforeach
@endif
@endsection
