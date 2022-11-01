@extends('layouts.default')
<style>
</style>
@section('menu-item')
    <li class='menu-item'>
        <a class='menu-link' href='/'>Home</a>
    </li>
    <li class='menu-item'>
        <form action='/logout' method='post'>
            @csrf
            <button class='menu-link'>Logout</button>
        </form>
    </li>
    <li class='menu-item'>
        <a class='menu-link'  href='/mypage'>Mypage</a>
    </li>
@endsection