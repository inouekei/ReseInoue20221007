@extends('layouts.customer')
<style>
    .form-index{
        border-radius: 5px;
        padding: 5px;
        box-shadow: 3px 3px 3px 0 gray; 
        background: white;
    }
    .select-index, .input-index{
        border: none;
    }
    .select-index{
        border-right: solid 1px lightgray;
    }
    .content-main{
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
    }

</style>
@section('header-item')
    <form class='form-index'>
        <select class='select-index' name='area'>
            <option value='All area' selected>All area</option>
            <option value='東京'>東京</option>
            <option value='大阪'>大阪</option>
            <option value='名古屋'>名古屋</option>
        </select>
        <select class='select-index' name='genre'>
            <option value='All genre' selected>All genre</option>
            <option value='寿司'>寿司</option>
            <option value='焼肉'>焼肉</option>
            <option value='イタリアン'>イタリアン</option>
        </select>
        <input class='input-index' name='name' placeholder='Search ...'>
    </form>
@endsection
@section('content')
<div class='content-main'>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
    <div class='div-restaurant-card'>
        <div class='div-restaurant-card-img'></div>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>仙人</p>
            <small class='small-tags'>#東京都#寿司</small>
            <a class='btn-main btn-restaurant-card' href='/detail/1'>詳しくみる</a>
            <i class="fa-solid fa-heart div-heart"></i>
        </div>
    </div>
</div>
@endsection
