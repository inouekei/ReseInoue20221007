@extends('layouts.manager-restaurant-info')

<style>
#input-file{
    display: none;
}
.span-message{
    color: white;
}
.btn-file{
    display: block;
    margin-bottom: 10px;
    text-align: center;
}
</style>

@section('back-page', '/mypage')
@section('restaurant-name', $restaurant ? $restaurant->name : 'Restaurant name')
@section('restaurant-img', 'url(' . ($restaurant ? $restaurant->image_path : null) . ');')
@section('restaurant-tags', '#' . ($restaurant ? $restaurant->area : 'area') . '#' . ($restaurant ? $restaurant->genre : 'genre'))
@section('restaurant-disc', $restaurant ? $restaurant->description : 'Description')

@section('form-ttl', $restaurant ? '店舗情報更新' :'新規店舗情報作成')
@section('form-main-action', '/restaurant/' . ($restaurant->id ?? 0) . '/update')

@section('content-form-main')
<input class='input-main input-full' name='name' placeholder='Restaurant name' value={{$restaurant->name ?? ''}}>
<label for="input-file" class="btn-main btn-file btn-reserve-card">画像ファイルをアップロード</label>
<input type="file" name="image" accept="image/*" id="input-file">
<select class='input-main input-full' name="area">
    @foreach (config('const.AREAS') as $area)
    <option value={{$area}}
        {{(($restaurant->area ?? false) === $area) ? 'selected' : ''}}        
    >
        {{$area}}
    </option>
    @endforeach
</select>
<select class='input-main input-full' name="genre">
    @foreach (config('const.GENRES') as $genre)
    <option value={{$genre}}
        {{(($restaurant->genre ?? false) === $genre) ? 'selected' : ''}}        
    >
        {{$genre}}
    </option>
    @endforeach
</select>
<textarea class='input-main input-full textarea-main' maxlength=191 name='description' placeholder='Description'>
{{$restaurant->description ?? ''}}
</textarea>

@endsection
@section('button-txt', '送信する')