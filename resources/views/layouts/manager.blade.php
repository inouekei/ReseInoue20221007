@extends('layouts.default')
<style>
</style>
@section('menu-item')
    <li class='menu-item'>
        <a class='menu-link' href='/mypage'>Home</a>
    </li>
    <li class='menu-item'>
        <a class='menu-link' href='/reservation/0/show'>Read QR</a>
    </li>
    <li class='menu-item'>
        <form action='/logout' method='post'>
            @csrf
            <button class='menu-link'>Logout</button>
        </form>
    </li>
@endsection