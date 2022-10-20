@extends('layouts.restaurant-info')

<style>
.div-confirm{
    margin-top: 20px;
    padding: 10px;
    background: royalblue;
    border-radius: 5px;
}
.tbl-confirm{
    color: white;
}
.td-confirm{
    padding-right: 30px;
}
</style>

@section('restaurant-img')
url('https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg');
@endsection

@section('restaurant-name', '仙人')
@section('restaurant-tags', '#東京都#寿司')
@section('restaurant-disc', '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追求したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。')
@section('form-ttl', '予約')

@section('content-form')
    <input class='input-main' type="date" name="resDate">
    <select class='input-main input-full' name="resTime">
        <option value='10:00'>10:00</option>
        <option value='11:00'>11:00</option>
        <option value='12:00'>12:00</option>
        <option value='13:00'>13:00</option>
        <option value='14:00'>14:00</option>
        <option value='15:00'>15:00</option>
        <option value='16:00'>16:00</option>
        <option value='17:00'>17:00</option>
        <option value='18:00'>18:00</option>
        <option value='19:00'>19:00</option>
        <option value='20:00'>20:00</option>
        <option value='21:00'>21:00</option>
        <option value='22:00'>22:00</option>
        <option value='23:00'>23:00</option>
    </select>
    <select class='input-main input-full' name="resSeats">
        <option value='1人'>1人</option>
        <option value='2人'>2人</option>
        <option value='3人'>3人</option>
        <option value='4人'>4人</option>
        <option value='5人'>5人</option>
        <option value='6人'>6人</option>
        <option value='7人'>7人</option>
        <option value='8人'>8人</option>
        <option value='9人'>9人</option>
        <option value='10人'>10人</option>
    </select>

    <div class='div-confirm'>
        <table class='tbl-confirm'>
            <tr>
                <td class='td-confirm'>Shop</td>
                <td>仙人</td>
            </tr>
            <tr>
                <td class='td-confirm'>Date</td>
                <td>2021-04-01</td>
            </tr>
            <tr>
                <td class='td-confirm'>Time</td>
                <td>17:00</td>
            </tr>
            <tr>
                <td class='td-confirm'>Number</td>
                <td>1人</td>
            </tr>
        </table>
    </div>
@endsection
@section('button-txt', '予約する')
