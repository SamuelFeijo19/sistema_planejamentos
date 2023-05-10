<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/icon.png')}}" type="image/x-icon"/>
    <title>RBPlans</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="{{asset('css/login/login.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100" style="padding-top: 50px; padding-left: 45px;">
            <div class="login100-pic js-tilt" style="margin-top: 15%" data-tilt>
                <img src="{{asset('img/icon.png')}}" alt="IMG">
            </div>

            <form class="login100-form validate-form" method="post" action="{{route('registro.store')}}">
                @csrf
                <span class="login100-form-title">Nova Conta</span>
                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="name" placeholder="Nome" value="{{$errors->first('name') == "" ? old('name') : null}}" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="material-symbols-outlined">badge</span>
                    </span>
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="cpf" id="cpf" placeholder="CPF" value="{{$errors->first('cpf') == "" ? old('cpf') : null}}" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="material-symbols-outlined">branding_watermark</span>
                    </span>
                </div>
                @error('cpf')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="matricula" id="matricula" placeholder="Matrícula (Se houver)" value="{{$errors->first('matricula') == "" ? old('matricula') : null}}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="material-symbols-outlined">pin</span>
                    </span>
                </div>
                @error('matricula')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="date" name="dataNascimento" value="{{$errors->first('dataNascimento') == "" ? old('dataNascimento') : null}}" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="material-symbols-outlined">celebration</span>
                    </span>
                </div>
                @error('dataNascimento')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

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
                    <input class="input100" type="password" name="password" placeholder="Nova Senha" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Confirmar Nova Senha" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" class="login100-form-btn" value="Cadastrar" />
                </div>

                <div class="text-center p-t-12">
				   <a class="login100-form-btn bg-info text-light" href="{{route('login')}}">
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
<script src="{{asset('js/dashboard/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00', {reverse: true});
        @if(session()->get('type'))
        Swal.fire({
            type: '{{ session()->get('type') }}',
            title: '{{ session()->get('title') }}',
            text: '{{ session()->get('message') }}',
            icon: '{{ session()->get('type') }}',
        })
        @endif
    });
</script>
