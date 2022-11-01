@extends('layouts.auth-mini-disp-with-title')
<style>
    .auth-message{
        font-size: 10pt;
        text-align: left;
    }
</style>
@section('disp-title')
    Email Verification
@endsection
@section('disp-main')
    <p class='auth-message'>ログインにはメールアドレスの確認が必要です。<br>
        確認メールを再送する場合は登録したメールアドレスをご入力ください。</P>
    <form class='form-auth' action='/email/verification-notification' method='post'>
        @csrf
        <table class='table-auth'>
            <tr>
                <td><i class="fa-solid fa-envelope"></i></td>
                <td><input class='input-auth' name='email' placeholder='Email'></td>
            </tr>
            <tr>
                <td></td>
                <td class='td-error'>@error('email')<small>{{$message}}</small>@enderror</td>
            </tr>
            <tr>
                <td></td>
                <td class='td-right'>
                    <button class='btn-main' submit>再送</button>
                </td>
            </tr>
        </table>
    </form>
@endsection