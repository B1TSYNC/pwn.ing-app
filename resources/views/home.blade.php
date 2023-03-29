@extends('layout')
@section('title', "Home Page")
@section('content')
    @if(auth()->user())
        {{ auth()->user()->name}}
        <?php echo "hello, ". auth()->user()->name?>
        <html>
            <body>
                <div class="wrapper" style="position: relative; top: -40px;">
                    <div class="center" style="position: absolute; top: 17rem;">
                        <div class="footer"></div>
                        <h1 class="header">'; <a class="null">pwn.ing</a> --</h1>
                        <div class="hero-text">
                            <p class="hero-text-description" style="border-radius: 7.4px;"></p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                       @csrf
                       <button type="submit" class="btn btn-primary radius abzal" style=" outline: 0; box-shadow: none; width: 6rem; border-radius: 4px; top: 21rem;">Logout</button>
                    </form>
                </div>
            </body>
            <body>
                <div class="wrapper">
                    <form>
                        <div class="wrapper-moveable">
                          <input type="text" id="url" name="url" class="form-control blue-bottom bottom border-control width" v-model="searchQuery" placeholder="https://example.com" style="outline: 0; box-shadow: none; border-radius: 2px; font-family: 'Arial'; font-weight: 100; font-size: 17px;">
                          <button type="button" class="form-control bottom border-control width" style="outline: 0; box-shadow: none; border-radius: 2px; font-family: 'Arial'; font-weight: 100; font-size: 17px;">View anonymously</button>
                        </div>
                    </form>
                </div>
            </body>
        </html>
    @else
        <div class="wrapper" style="position: relative; top: 100px;">
            <div class="center" style="position: absolute; top: 17rem;">
                <div class="footer"><a class="positioning" href="/register">click here to start</a></div>
                <h1 class="header">'; <a class="null">pwn.ıng</a> --</h1>
                <div class="hero-text">
                    <p class="hero-text-description" style="border-radius: 7.4px;"></p>
                </div>
            </div>

            <a href="/register"><button class="btn btn-primary radius abzal" style=" outline: 0; box-shadow: none; width: 6rem; border-radius: 4px;">Register</button></a>

            <a href="/login"><button class="btn btn-primary radius abzal" style=" outline: 0; box-shadow: none; width: 6rem; border-radius: 4px;">Login</button></a>
        </div>
    @endif
@endsection

