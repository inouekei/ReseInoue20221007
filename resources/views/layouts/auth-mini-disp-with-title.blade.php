@extends('layouts.auth')
<style>
    .disp-wrapper{
        height: 100%;
        display: flex;
        align-content: center;
    }

    .mini-disp{
        width: 400px;
    	margin: auto;
        border-radius: 10px;
    }

    .disp-title{
        height: 30px;
        padding: 10px;
        border-radius: 10px 10px 0 0;
        background: darkblue;
        line-height: 30px;
        color: white;
    }    
    .disp-main{
        padding: 10px;
        border-radius: 0 0 10px 10px;
        background: white;

    }
    .form-auth{
    }
    
    .table-auth{
        margin: auto;
    }
    .input-auth{
        width: 100%;
        margin: 5px;
        border-style: none;
        border-bottom: solid 1pt;
    }
    .td-right{
        display: flex;
        justify-content: flex-end;
    }
    .td-error{
        height: 15px;
        margin: 0;
        padding: 0 5px;
        color: red;
        font-size: 8pt;
    }
</style>
@section('content')
<div class='disp-wrapper'>
    <div class='mini-disp'>
        <div class='disp-title'>
            @yield('disp-title')
        </div>
        <div class='disp-main'>
            @yield('disp-main')
        </div>
    </div>
</div>
@endsection