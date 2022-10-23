@extends('layouts.auth-mini-disp-with-title')
@section('disp-title')
    Registration
@endsection
@section('disp-main')
    <form class='form-auth' action='/register' method='post'>
        @csrf
        <input type='hidden' name='role' value='customer'>
        <table class='table-auth'>
            <tr>
                <td><i class="fa-solid fa-user"></i></td>
                <td><input class='input-auth' name='name' placeholder='Username'></td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-envelope"></i></td>
                <td><input class='input-auth' name='email' placeholder='Email'></td>
            </tr>
            <tr>
                <td><i class="fa-solid fa-lock"></i></td>
                <td><input class='input-auth' name='password' type='password' placeholder='Password'></td>
            </tr>
            <tr>
                <td></td>
                <td class='td-right'>
                    <button class='btn-main' submit>登録</button>
                </td>
            </tr>
        </table>
    </form>
@endsection