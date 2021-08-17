<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('/img/you_ y naranja.png')}}" sizes="64x64">


    <title>YouApp</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->


    <!-- Custom styles for this page -->

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    @if(auth::user()->isAdmin())
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home')}}" >
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-laptop-medical"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Inicio</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Paneles
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fab fa-whatsapp"></i>
                        <span>Mensajeria</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('you-wsp') }}">
                                <i class="fab fa-whatsapp"></i>
                                <span>Pacientes</span>
                            </a>
                            <a class="collapse-item" href="{{ route('today') }}">
                                <i class="fas fa-calendar-day"></i>
                                <span>Agenda de Hoy</span>
                            </a>
                            <a class="collapse-item" href="{{ route('tomorrow') }}">
                                <i class="fas fa-calendar-day"></i>
                                <span>Agenda de Mañana</span>
                            </a>
                            <a class="collapse-item" href="{{ route('training') }}">
                                <i class="fas fa-running"></i>
                                <span>Entrenamiento</span>
                            </a>
                            <a class="collapse-item" href="{{ route('canceled') }}">
                                <i class="fas fa-window-close"></i>
                                <span>Fugados</span>
                            </a>
                            <hr>
                            <h6 class="collapse-header">Confirmación Día:</h6>
                            <form class="side" method="POST" action="{{ route('tomorrow.form')}}">
                                @csrf
                                <input class="form-control" name="day" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                </li>

                <div class="sidebar-heading">
                    Reportes
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('general') }}">
                        <i class="fas fa-file-contract"></i>
                        <span>Reportes Anual</span>
                    </a>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenine"
                        aria-expanded="true" aria-controls="collapsenine">
                        <i class="fas fa-file-contract"></i>
                        <span>Reportes Semanales</span>
                    </a>
                    <div id="collapsenine" class="collapse" aria-labelledby="headingnine" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('week.index')}}">
                                <i class="fas fa-table"></i>
                                Medios de Pago
                            </a>
                            <hr>
                            <h6 class="collapse-header">Personalizado</h6>
                            <form class="side" method="POST" action="{{ route('form-week')}}">
                                @csrf
                                <input class="form-control" name="firstday" type="date">
                                <input class="form-control" name="lastday" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-file-contract"></i>
                        <span>Ocupación</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('occupation', ['type' => 'actual-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Actual
                            </a>
                            <a class="collapse-item" href="{{ route('occupation', ['type' => 'last-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Vencido
                            </a>
                            <a class="collapse-item" href="{{ route('occupation', ['type' => 'last-week']) }}">
                                <i class="fas fa-table"></i>
                                Semana Vencida
                            </a>
                            <a class="collapse-item" href="{{ route('occupation', ['type' => 'month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Calendario Actual
                            </a>
                            <hr>
                            <h6 class="collapse-header">Personalizado</h6>
                            <form class="side" method="POST" action="{{ route('form-occupation')}}">
                                @csrf
                                <input class="form-control" name="firstday" type="date">
                                <input class="form-control" name="lastday" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                </li>

                @if(auth::user()->isProfessional())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesix"
                        aria-expanded="true" aria-controls="collapsesix">
                        <i class="fas fa-file-contract"></i>
                        <span>Atenciones</span>
                    </a>
                    <div id="collapsesix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'actual-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Actual
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'last-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Vencido
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'last-week']) }}">
                                <i class="fas fa-table"></i>
                                Semana Vencida
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Calendario Actual
                            </a>
                            <hr>
                            <h6 class="collapse-header">Personalizado</h6>
                            <form class="side" method="POST" action="{{ route('form-occupation-professional')}}">
                                @csrf
                                <input class="form-control" name="firstday" type="date">
                                <input class="form-control" name="lastday" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                        <i class="fas fa-file-contract"></i>
                        <span>Profesionales</span>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('team.index')}}">
                                <i class="fas fa-users"></i> Resumen Equipo
                            </a>
                            <a class="collapse-item" href="{{ route('professional.index')}}">
                                <i class="fas fa-users"></i> Equipo Completo
                            </a>
                            <?php $professionals = App\Models\UserApp::whereNotNull('medilinkname')->orderby('name')->get(); ?>
                            @foreach ($professionals as $professional)
                            <a class="collapse-item" href="{{ route('professional.show', ['name' => $professional->medilinkname]) }}">
                                @if($professional->email == 'daniella.vivallo@gmail.com')
                                    <i class="fas fa-crown"></i> {{$professional->name}}
                                @else
                                    <i class="fas fa-notes-medical"></i> {{$professional->name}}
                                @endif

                            </a>
                            @endforeach
                        </div>
                    </div>
                </li>



                <div class="sidebar-heading">
                    Plataformas
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                        aria-expanded="true" aria-controls="collapseFive">
                        <i class="fas fa-file-contract"></i>
                        <span>Otros Sitios de You</span>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" target="_blank" href="https://youjustbetter.softwaremedilink.com/sessions/login">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Medilink</span>
                            </a>
                            <a class="collapse-item" target="_blank" href="https://youjustbetter.cl/">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Teachable</span>
                            </a>
                            <a class="collapse-item" target="_blank" href="https://blog.justbetter.cl/">
                                <i class="fas fa-book"></i>
                                <span>Blog</span>
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('/img/you_ y naranja.png')}}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    @if(auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Registrar') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->


                    @yield('container')


                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>©You JustBetter</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
    <!-- @elseif(auth::user()->hasrole('reception')) -->
        @elseif(auth::user()->isAdmin())
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home')}}" >
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-laptop-medical"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Inicio</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Paneles
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fab fa-whatsapp"></i>
                        <span>Mensajeria</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('you-wsp') }}">
                                <i class="fab fa-whatsapp"></i>
                                <span>Pacientes</span>
                            </a>
                            <a class="collapse-item" href="{{ route('today') }}">
                                <i class="fas fa-calendar-day"></i>
                                <span>Agenda de Hoy</span>
                            </a>
                            <a class="collapse-item" href="{{ route('tomorrow') }}">
                                <i class="fas fa-calendar-day"></i>
                                <span>Agenda de Mañana</span>
                            </a>
                            <a class="collapse-item" href="{{ route('training') }}">
                                <i class="fas fa-running"></i>
                                <span>Entrenamiento</span>
                            </a>
                            <a class="collapse-item" href="{{ route('canceled') }}">
                                <i class="fas fa-window-close"></i>
                                <span>Fugados</span>
                            </a>
                            <hr>
                            <h6 class="collapse-header">Confirmación Día:</h6>
                            <form class="side" method="POST" action="{{ route('tomorrow.form')}}">
                                @csrf
                                <input class="form-control" name="day" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                </li>
        </div>
    @elseif(auth::user()->hasrole('professional'))
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home')}}" >
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-laptop-medical"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Inicio</span></a>
                </li>

                <!-- Heading -->

                <div class="sidebar-heading">
                    Reportes
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-file-contract"></i>
                        <span>Atenciones</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'actual-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Actual
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'last-month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Vencido
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'last-week']) }}">
                                <i class="fas fa-table"></i>
                                Semana Vencida
                            </a>
                            <a class="collapse-item" href="{{ route('occupation-professional', ['type' => 'month']) }}">
                                <i class="fas fa-table"></i>
                                Mes Calendario Actual
                            </a>
                            <hr>
                            <h6 class="collapse-header">Personalizado</h6>
                            <form class="side" method="POST" action="{{ route('form-occupation-professional')}}">
                                @csrf
                                <input class="form-control" name="firstday" type="date">
                                <input class="form-control" name="lastday" type="date">
                                <input class="form-control" type="submit">
                            </form>
                        </div>
                    </div>
                </li>

                <div class="sidebar-heading">
                    Plataformas
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                        aria-expanded="true" aria-controls="collapseFive">
                        <i class="fas fa-file-contract"></i>
                        <span>Otros Sitios de You</span>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" target="_blank" href="https://youjustbetter.softwaremedilink.com/sessions/login">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Medilink</span>
                            </a>
                            <a class="collapse-item" target="_blank" href="https://youjustbetter.cl/">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Teachable</span>
                            </a>
                            <a class="collapse-item" target="_blank" href="https://blog.justbetter.cl/">
                                <i class="fas fa-book"></i>
                                <span>Blog</span>
                            </a>
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <form class="form-inline">
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>
                        </form>
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="{{ asset('/img/you_ y naranja.png')}}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    @if(auth::user()->hasrole('adminstrador'))
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Registrar') }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->


                    @yield('container')


                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>©You JustBetter</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
    @endif
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/bootstrap/sb-admin-2.min.js')}}"></script>

    <!-- Excel -->
    @yield('scripts')


    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->


</body>

</html>
