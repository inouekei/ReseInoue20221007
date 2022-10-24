@extends('layouts.customer')
@section('content')
<div class='disp-wrapper'>
    <div class='mini-disp'>
        <div class='disp-main'>
            <p class='p-message'>ご予約ありがとうございます。</p>
            <a class='btn-main' href={{$backPage}}>戻る</a>
        </div>
    </div>
</div>
@endsection
