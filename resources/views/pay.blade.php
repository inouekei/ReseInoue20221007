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
</style>

@section('page-ttl', 'お支払い')
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
@section('div-right-content')
<div>
    <!-- <form class='form-main' action={{'/reservation/' . $reservation->id . '/pay'}}  method='post'>
        @csrf
        <input name='amount' placeholder='Total Payment' class='input-main input-full'>
        <input name='' placeholder='Total Payment' class='input-main input-full'>
        <button class='btn-right-form' submit>送信</button>
    </form> -->
    <form action={{'/reservation/' . $reservation->id . '/pay'}}  method='post'>
        {{ csrf_field() }}
        <script
            src="https://checkout.stripe.com/checkout.js"
            class="stripe-button"
            data-key="{{ env('STRIPE_KEY') }}"
            data-amount={{$amount}}
            data-name="お支払い"
            data-email="{{$reservation->customer->user->email}}"
            data-label="決済をする"
            data-description="カード情報をご入力ください"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-currency="JPY">
        </script>
    </form>
</div>
@endsection
