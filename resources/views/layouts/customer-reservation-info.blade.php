@extends('layouts.customer')
<style>
    .content-main{
        margin-top: 10px;
        display: flex;
    }
    .div-right{
        width: 100%;
        margin-left: 200px; 
    }
    .p-ttl{
        font-size: 20pt;
        font-weight: bold;
    }
    .div-right-content{
        width: 100%;
    }
    
</style>
@section('content')
<p class='page-ttl'>testさん</p>
<div class='content-main'>
    <div class='div-half'>
        <p class='p-ttl'>@yield('info-top-ttl')</p>
        <div class='info-top'>
            @yield('info-top')
        </div>
        <p class='p-ttl'>@yield('info-bottom-ttl')</p>
        <div class='info-bottom'>
            @yield('info-bottom')
        </div>
    </div>
    <div class='div-right'>
        <p class='p-ttl'>@yield('div-right-ttl')</p>
        <div class='div-right-content'>
            @yield('div-right-content')
        </div>
    </div>
</div>
@endsection
