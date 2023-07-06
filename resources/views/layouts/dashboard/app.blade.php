<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{asset('./css/dashboard/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('./css/dashboard/sb-admin-2.min.css')}}">

    <meta name="author" content="">

    <title>RBPlanejamento - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{asset('./css/dashboard/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{asset('./css/dashboard/sb-admin-2.min.css')}}">
    <style>
        .card-columns {
            column-count: 4;
        }

        .card {
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) and (max-width: 1023px) {
            .card-columns {
                column-count: 3;
            }
        }
        @media(max-width: 767px) {
            .card-columns {
                column-count: 1;
            }
        }
        .ajuste{
            padding-left: 0 !important;
        }

        h3{
            font-weight: bold;
            color: #2d91cb;
        }

        .list-group-item{
            border-radius: 5px;
        }

    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar"
        style="background: rgb(26,122,178);
background: linear-gradient(187deg, rgba(26,122,178,1) 15%, rgba(26,122,178,1) 76%, rgba(54,151,212,1) 92%, rgba(90,188,255,1) 100%);
"
    >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard.content')}}">
            <div class="sidebar-brand-icon">
                <img src="{{asset('img/icon2.png')}}" alt="" width="30" height="30">
            </div>
            <div class="sidebar-brand-text mx-1"><strong>RBP</strong>lanejamento</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('dashboard.content')}}">
            <span class="material-symbols-outlined">
                home
            </span>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        @if(auth()->user()->is_admin == 1)
        <!-- Heading -->
        <div class="sidebar-heading">
            Unidades Adiministrativas
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
               aria-expanded="true" aria-controls="collapseTwo">
            <span class="material-symbols-outlined">
                apartment
            </span>
                <span>Secretarias</span>
            </a>
            <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('secretarias.index')}}">Secretarias</a>
                    <a class="collapse-item" href="{{route('secretarias.create')}}">Nova Secretaria</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo0"
               aria-expanded="true" aria-controls="collapseTwo0">
                <span class="material-symbols-outlined">
                    meeting_room
                </span>
                <span>Departamentos</span>
            </a>
            <div id="collapseTwo0" class="collapse" aria-labelledby="headingTwo0" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded ">
                    <div style="">
                        <a class="collapse-item ajuste" href="{{route('departamento.index')}}">Departamentos Cadastrados</a>
                        <a class="collapse-item ajuste" href="{{route('departamento.create', $secretaria_id=0)}}">Novo Departamento</a>
                    </div>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <span class="material-symbols-outlined">
                    groups
                </span>
                <span>Divisões</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('divisao.index')}}">Divisões Cadastradas</a>
                    <a class="collapse-item" href="{{route('divisao.create', $departamento_id=0)}}">Nova Divisão</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            usuários
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo2"
               aria-expanded="true" aria-controls="collapseTwo">
                <span class="material-symbols-outlined">
                    person
                </span>
                <span>Servidores</span>
            </a>
            <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('servidores.index')}}">Servidores Cadastrados</a>
                    <a class="collapse-item" href="{{route('servidores.create')}}">Novo Servidor</a>
                </div>
            </div>
        </li>
        @endif

        @if(auth()->user()->is_admin == 0)
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('departamento.index')}}">
                <span class="material-symbols-outlined">
                    meeting_room
                </span>
                    <span>Meus Departamentos</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('divisao.index')}}">
                <span class="material-symbols-outlined">
                    groups
                </span>
                    <span>Minhas Divisões</span>
                </a>
            </li>
        @endif
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="{{asset('./img/user.png')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item text-dark" href="{{ route('perfil.show', auth()->user()->id) }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Sair
                            </a>
                        </div>
                    </li>

                </ul>
            </nav>
            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    &copy; Direito Autoral <strong><span>Prefeitura de Rio Branco</span></strong>. Todos os Direitos Reservados.
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deseja Sair?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Ao sair do sistema, será necessário autenticar-se novamente.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="{{route('sair')}}">Sair</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('./js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('./js/sweetalert.js') }}" type="text/javascript"></script>
<script src="{{asset('./js/dashboard/jquery.min.js')}}"></script>
<script src="{{asset('./js/dashboard/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
<script type="text/javascript">
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            console.log($(this).attr("href"));
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Tem certeza?',
                text: "A alteração não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Sim, excluir evento!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        // Não me recordo bem mas acho que a função "route" recebe um segundo parâmetro que é um array com os parâmetros da sua rota, você pode confirmar isso na documentação.
                        url: link,
                        type: 'get',
                        success: function (response) {
                            Swal.fire({
                                type: 'success',
                                title: 'Exclusão Concluída!',
                                text: 'O evento foi excluído com sucesso.',
                                icon: 'success',
                            }).then((result) => {

                                location.reload()
                            })
                        }
                    });
                }
            })
        });

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
</body>

</html>
