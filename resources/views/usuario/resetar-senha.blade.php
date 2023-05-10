<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RBEventos</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('css/login/login.css')}}">
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100" style="padding-top: 50px">
            <div class="login100-pic js-tilt" style="margin-top: 15%" data-tilt>
                <img src="{{asset('img/login/img-03.png')}}" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="post" action="{{route('resetar-senha')}}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <span class="login100-form-title">Nova Senha</span>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email" value="{{$errors->first('email') == "" ? old('email') : null}}" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100"><i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Senha" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Senha" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="container-login100-form-btn">
                    <input type="submit" class="login100-form-btn" value="Cadastrar" />
                </div>

                <div class="text-center p-t-12">
                    <a class="login100-form-btn bg-info" href="{{route('login')}}">
                        Login
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
</body>
</html>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
