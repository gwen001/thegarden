<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Garden</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/main.css">
        @yield('css')
    </head>
    <body>
        <div class="container">
            @if (Route::has('login'))
                <div id="header" class="row">
                    <div class="col col-4">
                        <form action="{{ route('home') }}" method="GET" class="form-inline">
                            <div class="input-group mb-3">
                                <input type="text" name="q" value="{{ Request::input('q') }}" class="form-control" placeholder="search...">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col col-8 text-end">
                        <ul class="list-group list-group-horizontal d-inline-flex">
                            <li class="list-group-item border-0 ps-0"><a href="{{ url('/') }}">Home</a></li>
                            <li class="list-group-item border-0"><a href="{{ route('cart.show') }}">Cart</a></li>
                            @auth
                                <li class="list-group-item border-0"><a href="{{ url('/dashboard') }}">My account</a></li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <li class="list-group-item border-0"><a href="javascript:;" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                                </form>
                            @else
                                <li class="list-group-item border-0"><a href="{{ route('login') }}">@lang('Log in')</a></li>
                                @if (Route::has('register'))
                                    <li class="list-group-item border-0"><a href="{{ route('register') }}">@lang('Register')</a></li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
            @endif
            <div id="flashmessage">@include('components/flash-message')</div>
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            @yield('main')
        </div>
        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        @yield('js')
        <script type="text/javascript">
            function setFlashMessage( data ) {
                $('#flashmessage').html(data);
                // $("#flashmessage").show();
            }
            setInterval(function () {$("#flashmessage").html('');}, 2000);
        </script>
    </body>
</html>
