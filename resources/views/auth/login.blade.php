<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name') }} | Log in</title>
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <h1><b>Admin</b>LTE</h1>
            </div>

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input
                                id="email"
                                type="text"
                                class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                name="email"
                                placeholder="Email"
                                value="kimheang135@gmail.com"
                            />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="error invalid-feedback d-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input
                                id="password"
                                type="password"
                                class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                name="password"
                                placeholder="Password"
                                value="12345678"
                            />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if ($errors->has('password'))
                                <span class="error invalid-feedback d-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" />
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
