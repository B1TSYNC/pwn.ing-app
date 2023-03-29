@extends('layout')
@section('title', 'Register')
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
            <form action="{{ route('register.post') }}" method="POST" class="ms-auto me-auto mt-3 captcha_code width" style="width: 520px;">

                @csrf

                <div class="register-text move" style="font-size: 30px; display:flex; justify-content: center; align-items: center;">
                    Register
                </div>

                <div class="mb-3">
                    <label class="form-label text-clr shadow-md-2">Username</label>
                    <input type="text" class="form-control blue-bottom radius" style="outline: 0; box-shadow: none;" name="username">
                    <div class="form-text"></div>
                </div>

                <div class="mb-3">
                <label class="form-label text-clr shadow-md-2">Email address</label>
                <input type="email" class="form-control blue-bottom radius" style="outline: 0; box-shadow: none;" name="email">
                <div id="emailHelp" class="form-text privacy-text" style="font-size: 11px;">We store your email and password securely with strong encryption and comply with Luxembourg's data protection laws to protect your privacy. We never share your information with third parties without your consent <a style="color: #c8c8c8" href="/privacy-policy">privacy policy</a></div>
                </div>

                <div class="mb-3">
                <label class="form-label text-clr shadow-md-2">Password</label>
                <input type="password" class="form-control blue-bottom radius" style="outline: 0; box-shadow: none;" name="password">
                </div>

                <p><a href="/login" class="mv" style="color: #c8c8c8; font-size: 14px; margin: 8px;">- have an account? login</a></p>
                <button type="submit" class="btn btn-primary mv top-center radius" style="width: 115px; outline: 0; box-shadow: none;">Register</button>

            </form>
        </div>
    </div>
@endsection
