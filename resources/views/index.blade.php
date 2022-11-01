@extends('layouts.customer')
<style>
    .form-index{
        border-radius: 5px;
        height: 24px;
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
    .btn-index-header{
        height: 24px;
        margin: 0;
        background: none;
        border: none;
        cursor: pointer;
    }
    @media screen and (max-width: 768px){
        .content-main{
            display: block;
        }
        .form-index{
            position: relative;
            height: 50px;
            margin-top: 10px;
        }
        .select-index, .input-index{
            width: 100%;
            border: none;
        }
        .btn-index-header{
            position: absolute;
            bottom: 0;
            right: 0;
        }
    }

</style>
@section('header-item')
    <form class='form-index' action='/' method='get'>
        @csrf
        <select class='select-index' name='area'>
            <option value='All area' selected>All area</option>
            @foreach (config('const.AREAS') as $area)
            <option value={{$area}}
                @if($request->area && $request->area === $area)
                selected
                @endif
            >
                {{$area}}
            </option>
            @endforeach
        </select>
        <select class='select-index' name='genre'>
            <option value='All genre' selected>All genre</option>
            @foreach (config('const.GENRES') as $genre)
            <option value={{$genre}}
                @if($request->genre && $request->genre === $genre)
                selected
                @endif
            >
                {{$genre}}
            </option>
            @endforeach
        </select>
        <input class='input-index' name='name' @if($request->name) value = {{$request->name}} @endif placeholder='Search ...'>
        <button submit class='btn-index-header'><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
@endsection
@section('content')
<div class='content-main'>
    @if($message)
    <span>{{$message}}<span>
    @endif
    @foreach ($restaurants as $restaurant)
    <div class='div-restaurant-card'>
        <img class='img-restaurant-card' src={{$restaurant->image_path}}></img>
        <div class='div-restaurant-card-content'>
            <p class='p-restaurant-name'>{{$restaurant->name}}</p>
            <small class='small-tags'>#{{$restaurant->area}}#{{$restaurant->genre}}</small>
            <form action={{'/detail/' . $restaurant->id}} method='get'>
                @csrf
                <input type='hidden' name='redirect' value='/'>
                @if($request->area ?? false)
                <input type='hidden' name='searchArea' value={{urlencode($request->area)}}>
                @endif
                @if($request->genre ?? false)
                <input type='hidden' name='searchGenre' value={{urlencode($request->genre)}}>
                @endif
                @if($request->name ?? false)
                <input type='hidden' name='searchName' value={{urlencode($request->name)}}>
                @endif
                <button class='btn-main btn-restaurant-card' submit>詳しくみる</button>
            </form>

            @if($restaurant->myFavorite() ?? false)
            <form action={{'/favorite/' . $restaurant->myFavorite()->id . '/remove'}} method='post'>
                @csrf
                <input type='hidden' name='redirect' value='/'>
                @if($request->area ?? false)
                <input type='hidden' name='searchArea' value={{urlencode($request->area)}}>
                @endif
                @if($request->genre ?? false)
                <input type='hidden' name='searchGenre' value={{urlencode($request->genre)}}>
                @endif
                @if($request->name ?? false)
                <input type='hidden' name='searchName' value={{urlencode($request->name)}}>
                @endif
                <button class='div-heart div-heart-red'><i class="fa-solid fa-heart"></i></button>
            </form>
            @else
            <form action='/favorite/create' method='post'>
            @csrf
                <input type='hidden' name='restaurant_id' value={{$restaurant->id}}>
                <input type='hidden' name='redirect' value='/'>
                @if($request->area ?? false)
                <input type='hidden' name='searchArea' value={{urlencode($request->area)}}>
                @endif
                @if($request->genre ?? false)
                <input type='hidden' name='searchGenre' value={{urlencode($request->genre)}}>
                @endif
                @if($request->name ?? false)
                <input type='hidden' name='searchName' value={{urlencode($request->name)}}>
                @endif
                <button class='div-heart'><i class="fa-solid fa-heart"></i></button>
                @endif
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
