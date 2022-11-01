@extends('layouts.auth-mini-disp-with-title')
@section('disp-title')
    Login
@endsection
@section('disp-main')
    <form class='form-auth' action='/login' method='post'>
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
                <td><i class="fa-solid fa-lock"></i></td>
                <td><input class='input-auth' name='password' type='password' placeholder='Password'></td>
            </tr>
            <tr>
                <td></td>
                <td class='td-error'>@error('password')<small>{{$message}}</small>@enderror</td>
            </tr>
            <tr>
                <td></td>
                <td class='td-right'>
                    <button class='btn-main' submit>ログイン</button>
                </td>
            </tr>
        </table>
    </form>
@endsection