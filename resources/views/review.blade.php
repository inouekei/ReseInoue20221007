@extends('layouts.restaurant-info')

<style>
.span-message{
    color: white;
}
.div-star-wrapper{
    display: flex;
    color: white;
}
.div-star{
    margin: 10px;
    width: 30px;
    text-align: center;
}
.i-star{
    display: block;
    font-size: 30pt;
}
.lbl-none{
    color: yellow;
}
#star-check-1:checked ~ .div-star .lbl-none {
    color: white;
}
#star-check-2:checked ~ .div-star .lbl-none {
    color: white;
}
#star-check-3:checked ~ .div-star .lbl-none {
    color: white;
}
#star-check-4:checked ~ .div-star .lbl-none {
    color: white;
}
#star-check-5:checked ~ .div-star .lbl-none {
    color: white;
}
.lbl-none{
    background: none;
}
</style>

@section('back-page', '/mypage')
@section('restaurant-name', $restaurant->name)
@section('restaurant-img', 'url(' . $restaurant->image_path . ');')
@section('restaurant-tags', '#' . $restaurant->area . '#' . $restaurant->genre)
@section('restaurant-disc', $restaurant->description)

@section('form-ttl', '評価')
@section('form-main-action', '/review/add')

@section('content-form-main')
<span class='span-message'> ご来店ありがとうございました<br>お店に対する評価を5段階で教えてください</span>
<input type='hidden' name='reservation_id' value={{$reservation_id}}>
<div class="div-star-wrapper">
    <div class="div-star">
        <label for="star-check-1" class="lbl-none lbl-none1">
            <i class="fa-solid fa-star i-star"></i>
        </label>
        <small>大変不満</small>
    </div>
    <input type='radio' name='score' id="star-check-1" value='1' checked class='check-hidden'>
    <div class="div-star">
        <label for="star-check-2" class="lbl-none lbl-none2">
            <i class="fa-solid fa-star i-star"></i>
        </label>
        <small>やや不満</small>
    </div>
    <input type='radio' name='score' id="star-check-2" value='2' class='check-hidden'>
    <div class="div-star">
        <label for="star-check-3" class="lbl-none lbl-none3">
            <i class="fa-solid fa-star i-star"></i>
        </label>
        <small>普通</small>
    </div>
    <input type='radio' name='score' id="star-check-3" value='3' class='check-hidden'>
    <div class="div-star">
        <label for="star-check-4" class="lbl-none lbl-none4">
            <i class="fa-solid fa-star i-star"></i>
        </label>
        <small>やや満足</small>
    </div>
    <input type='radio' name='score' id="star-check-4" value='4' class='check-hidden'>
    <div class="div-star">
        <label for="star-check-5" class="lbl-none lbl-none5">
            <i class="fa-solid fa-star i-star"></i>
        </label>
        <small>大変満足</small>
    </div>
    <input type='radio' name='score' id="star-check-5" value='5' class='check-hidden'>
</div>
<textarea class='input-main input-full textarea-main' maxlength=191 name='comment' placeholder='Comment ...'></textarea>

@endsection
@section('button-txt', '送信する')