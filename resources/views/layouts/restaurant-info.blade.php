@extends('layouts.customer')
<style>
    .content-main{
        margin-top: 10px;
        display: flex;
    }
    .p-name{
        display: inline-block;
        margin-left: 20px;
        font-size: 25pt;
        font-weight: bold;
    }
    .span-back{
        display: inline-block;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        font-size: 20pt;
        font-weight: bold;
        color: black;
        border-radius: 5px;
        background: white;
    }
    .div-img{
        height: 300px;
        margin-bottom: 30px;
        background-image: @yield('restaurant-img');
        background-size: cover;
        background-position: center;
    }
    .p-disc{
        margin-top: 30px;
    }
    .div-forms{
        position: relative;
    }
    .form-main{
        position: relative;
        width: 300px;
        height: 100%;
        margin: 20px;
        border-radius: 5px;
        background: blue;
        box-shadow: 3px 3px 3px 0 gray; 
    }
    .div-form-content{
        padding: 20px;

    }
    .div-form-ttl{
        margin-bottom: 20px;
        font-size: 20pt;
        color: white;
    }
    .form-confirm{
        position: absolute;
        left: 20px;
        bottom: 100px;
        margin: 20px;
        background: royalblue;
        border-radius: 5px;
    }
    
</style>
@section('content')
<div class='content-main'>
    <div class='div-info'>
        <a href=@yield('back-page')><span class="span-back"><</span></a>
        <p class='p-name'>@yield('restaurant-name')</p>
        <div class='div-img'></div>
        <p class='p-tags'>@yield('restaurant-tags')</p>
        <p class='p-disc'>@yield('restaurant-disc')</p>
    </div>
        <div class="div-forms">
            <form class='form-main' action=@yield('form-main-action') method='post'>
                @csrf
                <div class="div-form-content">
                <div class='div-form-ttl'>@yield('form-ttl')</div>
                    @yield('content-form-main')
                </div>
                <button class='btn-right-form' submit>@yield('button-txt')</button>
            </form>
            <form action=@yield('form-confirm-action') class="form-confirm">
                @csrf
                @yield('content-form-confirm')
            </form>
        </div>
</div>
@endsection
