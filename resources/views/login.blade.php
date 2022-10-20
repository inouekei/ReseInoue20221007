@extends('layouts.auth-mini-disp-with-title')
@section('disp-title')
    Login
@endsection
@section('disp-main')
    <form class='form-auth'>
        <table class='table-auth'>
            <tr>
                <td><i class="fa-solid fa-envelope"></i></td>
                <td><input class='input-auth' name='Email' placeholder='Email'></td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-lock"></i></td>
                <td><input class='input-auth' name='password' placeholder='Password'></td>
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