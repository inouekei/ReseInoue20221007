@extends('layouts.restaurant-info')

<style>
.div-confirm{
    margin-top: 20px;
}
.mode-confirm{
    padding: 10px;
    background: blue;
    color: blue;
}
.mode-create{
    padding: 10px 100px 10px 10px;
    border-radius: 5px;
    background: royalblue;
    color: white;
}

.tbl-confirm{
}
.td-confirm{
    padding-right: 30px;
}
</style>

@section('restaurant-img', 'url(' . $restaurant->image_path . ');')
@section('restaurant-name', $restaurant->name)
@section('restaurant-tags', '#' . $restaurant->area . '#' . $restaurant->genre)
@section('restaurant-disc', $restaurant->description)

@section('form-ttl', '予約')
@section('back-page', $backPage)
@section('form-action', '/reservation/' . $formAction)

@section('content-form')
    <input class='input-main' type="date" name="resDate" value={{$resDate ?? ''}}>
    <select class='input-main input-full' name="resTime">
        @foreach (config('const.AVAILABLE_HOURS') as $hour)
        <option value={{$hour}}
            @if(($resTime ?? false) && $resTime === $hour)
            selected
            @endif
        >
            {{$hour}}
        </option>
        @endforeach
    </select>
    <select class='input-main input-full' name="num_of_seats">
    @foreach (config('const.AVAILABLE_SEATS') as $seats)
        <option value={{$seats}}
            @if(($num_of_seats ?? false) && $num_of_seats == $seats)
            selected
            @endif
        >
            {{$seats . '人'}}
        </option>
        @endforeach
    </select>
    <input type="hidden" name="restaurant_id" value={{$restaurant->id}}>

    <div class='div-confirm'>
        <table class={{"mode-" . $formAction}}>
            <tr>
                <td class='td-confirm'>Shop</td>
                <td>{{$restaurant->name}}</td>
            </tr>
            <tr>
                <td class='td-confirm'>Date</td>
                <td>
                    {{$resDate ?? ''}}
                </td>
            </tr>
            <tr>
                <td class='td-confirm'>Time</td>
                <td>
                    {{$resTime ?? ''}}
                </td>
            </tr>
            <tr>
                <td class='td-confirm'>Number</td>
                <td>
                    {{($resSeats  ?? '') . '人'}}
                </td>
            </tr>
        </table>
    </div>
@endsection
@section('button-txt')
@if($formAction === 'confirm')
入力内容を確認する
@elseif($formAction === 'create')
予約する
@endif
@endsection
