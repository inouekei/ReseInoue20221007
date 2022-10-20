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

    .disp-main{
        padding: 50px;
        border-radius: 10px;
        background: white;
        text-align: center;
    }

    .p-message{
        font-weight: bold;
    }
    
</style>
@section('content')
<div class='disp-wrapper'>
    <div class='mini-disp'>
        <div class='disp-main'>
            <p class='p-message'>会員登録ありがとうございます。</p>
            <a class='btn-main' href='/login'>ログインする</a>
        </div>
    </div>
</div>
@endsection
