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
</style>

@section('manager-name', $managerName)
@section('message', $message ?? '')
@section('info-top-ttl', '予約状況')
@section('info-top')
@if(sizeof($nextReservations) === 0)
<span class='span-block'>ご予約はありません。</span>
@else
@foreach($nextReservations as $reservation)
<div class="reserve-card">
    <i class="fa-solid fa-clock"></i>
    <span>{{'予約' . $reservation->numbering}}</span>
    <table class='tbl-reserve'>
        <tr>
            <td class='td-reserve'>Shop</td>
            <td>{{$reservation->restaurant->name}}</td>
        </tr>
        <tr>
            <td class='td-reserve'>Customer</td>
            <td>{{$reservation->customer->user->name}}</td>
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
    <form action={{'reservation/' . $reservation->id . '/email'}} method='get'>
        <button class="btn-main btn-reserve-card">連絡する</button>
    </form>
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
            <td class='td-reserve'>Customer</td>
            <td>{{$reservation->customer->user->name}}</td>
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
    <form action={{'reservation/' . $reservation->id . '/email'}} method='get'>
        <button class="btn-main btn-reserve-card" submit>連絡する</button>
    </form>
</div>
@endforeach
@endif
@endsection
@section('div-right-ttl', '管理店舗一覧')
@section('div-right-content')
@foreach($restaurants as $restaurant)
<div class='div-restaurant-card div-restaurant-card-mypage'>
    <img class='img-restaurant-card' src={{$restaurant->image_path}}></img>
    <div class='div-restaurant-card-content'>
        <p class='p-restaurant-name'>{{$restaurant->name}}</p>
        <small class='small-tags'>
            {{'#' . $restaurant->area .
                '#' . $restaurant->genre}}
        </small>
        <form action={{'/restaurant/' . $restaurant->id . '/edit'}} method='get'>
            @csrf
            <input type='hidden' name='redirect' value='/mypage'>
            <button class='btn-main btn-restaurant-card' submit>更新する</button>
        </form>
    </div>
</div>
@endforeach
<div class='div-restaurant-card div-restaurant-card-mypage div-restaurant-card-new'>
    <a class='a-new' href='/restaurant/0/edit'>新規店舗作成</a>
</div>

@endsection
