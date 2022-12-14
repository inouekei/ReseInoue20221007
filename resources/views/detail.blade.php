@extends('layouts.restaurant-info')

<style>
.mode-confirm{
    padding: 10px;
    background: blue;
    color: blue;
}
.mode-create{
    padding: 10px 50px 10px 10px;
    color: white;
}

.td-confirm{
    padding-right: 30px;
}

.btn-modify{
    margin: 10px;
}
.div-error{
    display: table-cell;
    margin: 0 0 20px;
    height: 10px;
    color: red;
}
</style>

@section('back-page', $backPage)
@section('restaurant-name', $restaurant->name)
@section('restaurant-img', 'url(' . $restaurant->image_path . ');')
@section('restaurant-tags', '#' . $restaurant->area . '#' . $restaurant->genre)
@section('restaurant-disc', $restaurant->description)

@if(($formAction === 'confirm') || ($formAction === 'create'))
@section('form-ttl', '予約')
@elseif(($formAction === 'edit') || ($formAction === 'update'))
@section('form-ttl', '修正')
@endif

@if(($formAction === 'confirm') || ($formAction === 'create'))
@section('form-main-action', '/reservation/' . $formAction)
@elseif($formAction === 'edit')
@section('form-main-action', '/reservation/confirm')
@elseif($formAction === 'update')
@section('form-main-action', '/reservation/' . $reservation_id . '/edit')
@endif

@section('content-form-main')
    <input type='hidden' name='redirect' value={{$backPage}}>
    <input class='input-main' type="date" name="resDate"
        value={{$resDate ?? ''}}
        {{(($formAction === 'create') || ($formAction === 'update')) ? 'readonly' : ''}}
    >
    <div class='div-error'>@error('resDate')<small>{{$message}}</small>@enderror</div>
    <select class='input-main input-full' name="resTime"
        {{(($formAction === 'create') || ($formAction === 'update')) ? 'disabled' : ''}}
    >
        @foreach (config('const.AVAILABLE_HOURS') as $hour)
        <option value={{$hour}}
            {{(($resTime ?? false) && $resTime === $hour) ? 'selected' : ''}}        
        >
            {{$hour}}
        </option>
        @endforeach
    </select>
    <div class='div-error'>@error('resTime')<small>{{$message}}</small>@enderror</div>

    <select class='input-main input-full' name="num_of_seats"
        {{(($formAction === 'create') || ($formAction === 'update')) ? 'disabled' : ''}}
    >
    @foreach (config('const.AVAILABLE_SEATS') as $seats)
        <option value={{$seats}}
            {{(($num_of_seats ?? false) && $num_of_seats == $seats) ? 'selected' : ''}}
        >
            {{$seats . '人'}}
        </option>
        @endforeach
    </select>
    <div class='div-error'>@error('num_of_seats')<small>{{$message}}</small>@enderror</div>
    @if(($formAction === 'create') || ($formAction === 'update'))
    <input type='hidden' name='resTime' value={{$resTime}}>
    <input type='hidden' name='num_of_seats' value={{$num_of_seats}}>
    @endif
    @if(($formAction === 'edit') || ($formAction === 'update'))
    <input type='hidden' name='reservation_id' value={{$reservation_id}}>
    @endif

    <input type="hidden" name="restaurant_id" value={{$restaurant->id}}>

@endsection
@section('button-txt')
@if($formAction === 'confirm')
入力内容を確認する
@elseif($formAction === 'create')
予約する
@elseif($formAction === 'edit')
入力内容を確認する
@elseif($formAction === 'update')
この内容で予約を修正する
@endif
@endsection


@if(($formAction === 'create') || ($formAction === 'update'))
@if($formAction === 'create')
@section('form-confirm-action', '/detail/' . $restaurant->id)
@elseif($formAction === 'update')
@section('form-confirm-action', '/reservation/' . $reservation_id . '/edit')
@endif
@section('content-form-confirm')
<input type='hidden' name='redirect' value={{$backPage}}>
<table class="mode-create">
    <tr>
        <td class='td-confirm'>Shop</td>
        <td>{{$restaurant->name}}</td>
    </tr>
    <tr>
        <td class='td-confirm'>Date</td>
        <td>
            {{$resDate ?? ''}}
        </td>
        <input type='hidden' name='resDate' value={{$resDate ?? ''}}>
    </tr>
    <tr>
        <td class='td-confirm'>Time</td>
        <td>
            {{$resTime ?? ''}}
        </td>
        <input type='hidden' name='resTime' value={{$resTime ?? ''}}>
    </tr>
    <tr>
        <td class='td-confirm'>Number</td>
        <td>
            {{($num_of_seats  ?? '') . '人'}}
        </td>
        <input type='hidden' name='num_of_seats' value={{$num_of_seats ?? ''}}>
    </tr>
</table>
<button submit class='btn-main btn-modify'>入力内容を修正する</button>
@endsection
@endif
