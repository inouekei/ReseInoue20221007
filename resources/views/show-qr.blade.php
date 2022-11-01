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
</style>

@section('customer-name', $reservation->customer->user->name)
@section('info-top-ttl', '予約状況')
@section('info-top')
<div class="reserve-card">
    <i class="fa-solid fa-clock"></i>
    <span>予約</span>
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
</div>
@endsection
@section('div-right-ttl', 'QRコード')
@section('div-right-content')
{{QrCode::size(300)->generate('[ "reservation_id" => ' . $reservation->id . ']');}}
@endsection
