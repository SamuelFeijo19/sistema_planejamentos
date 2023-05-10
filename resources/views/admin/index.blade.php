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

    </style>
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">

            <div class="sidebar-brand-text mx-3">RBPlans</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="">
                <i class="fa-solid fa-address-card"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Unidades Adiministrativas
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
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
                <i class="fas fa-fw fa-cog"></i>
                <span>Departamentos</span>
            </a>
            <div id="collapseTwo0" class="collapse" aria-labelledby="headingTwo0" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('secretarias.index')}}">0</a>
                    <a class="collapse-item" href="{{route('secretarias.create')}}">1</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Servidores</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">Item</a>
                    <a class="collapse-item" href="">Item</a>
                    <a class="collapse-item" href="">Item</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Quadros</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="">Item</a>
                    <a class="collapse-item" href="">Item</a>
                    <a class="collapse-item" href="">Item</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Tasks
        </div>

        <!-- Nav Item - Pages Collapse Menu -->


        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Tarefas</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Usuário</span>
                            <img class="img-profile rounded-circle"
                                 src="{{asset('./img/perfil.jpg')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
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
            <h3 style="padding-left: 20px;">Divisão XXXXX</h3>

            <div class="container-fluid mt-4 shadow-lg" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body shadow-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
            >
                <h3 class="text-light">Nome Servidor</h3>
                <div class="row">
                    <div class="col">
                        <div class="card-columns">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Backlog
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 1
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 2
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 3
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    Doing
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 4
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    Code Review
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-body">
                                            Task 5
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            Task 6
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content');

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
                <a class="btn btn-primary" href="">Sair</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('./js/dashboard/jquery.min.js')}}"></script>
<script src="{{asset('./js/dashboard/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
