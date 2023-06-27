<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/icon.png')}}" type="image/x-icon"/>
    <title>RBPlanejamento</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('css/dashboard/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login/login.css')}}">
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100" style="padding-left: 50px">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('img/icon.png')}}" alt="IMG">
            </div>
            <div>
                <form class="login100-form validate-form" method="post" action="{{route('login')}}">
                    @csrf
                    <span class="login100-form-title">
						Acesso ao Sistema
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                    </div>
                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Entrar
                        </button>
                    </div>


                    <div class="text-center p-t-12">
                        <a class="login100-form-btn bg-info text-light" href="{{route('registro.create')}}">
                            Criar uma conta </i>
                        </a>
                    </div>
                    <div class="text-center p-t-12">
						<span class="txt1">
							Esqueceu
						</span>
                        <a class="txt2" href="{{route('recuperar-senha')}}">
                            Usuário / Senha?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="{{asset('js/dashboard/jquery.min.js')}}"></script>

