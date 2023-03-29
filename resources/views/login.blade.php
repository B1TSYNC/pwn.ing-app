@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="alert alert-danger margin">
                    @foreach($errors->all() as $error)
                        <div class="margin-2">{{ $error }}.</div>
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="wrapper" style="position: relative; top: 100px;">
            <form action="{{ route('login.post') }}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px;">

                @csrf

                <div class="register-text move" style="font-size: 30px; display:flex; justify-content: center; align-items: center;">
                    Login
                </div>

                <div class="mb-3">
                    <label class="form-label text-clr">Username</label>
                    <input type="username" class="form-control blue-bottom radius" style="outline: 0; box-shadow: none;" name="username">
                    <div class="form-text"></div>
                </div>

                <div class="mb-3">
                  <label class="form-label text-clr">Password</label>
                  <input type="password" class="form-control spacing blue-bottom radius" style="outline: 0; box-shadow: none;" name="password">
                </div>

                <p><a href="/register" class="mv" style="color: #c8c8c8; font-size: 14px; margin: 8px;">- don't have an account? register</a></p>
                <button type="submit" class="btn btn-primary radius" style="width: 115px; outline: 0; box-shadow: none;">Login</button>

            </form>
        </div>
    </div>
@endsection
