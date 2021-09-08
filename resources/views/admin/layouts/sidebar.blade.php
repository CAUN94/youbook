<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home')}}" >
           {{--      <div class="sidebar-brand-icon">
                    <i class="fas fa-laptop-medical"></i>
                </div> --}}
                <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            @if (Auth::user()->youApp())
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/youapp') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>YouApp</span></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Paneles
            </div>
            @if(Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-users"></i>
                        <span>Profesionales</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                             <a href="{{url('professionals')}}" class="collapse-item"><span><i class="fas fa-users"></i> Lista</span></a>
                            <a href="{{url('professionals/create')}}" class="collapse-item"><span><i class="fas fa-users"></i> Crear</span></a>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth::user()->isProfessional())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-users"></i>
                        <span>Mi Horario</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                             <a href="{{url('appointments')}}" class="collapse-item"><span><i class="fas fa-users"></i> Lista</span></a>
                            <a href="{{url('appointments/create')}}" class="collapse-item"><span><i class="fas fa-users"></i> Crear mi horario</span></a>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth::user()->isProfessional())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-users"></i>
                        <span>Citas Pacientes</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                             <a href="{{route('patient')}}" class="collapse-item"><span><i class="fas fa-users"></i> Pacientes (Hoy)</span></a>
                            <a href="{{route('record.index')}}" class="collapse-item"><span><i class="fas fa-users"></i> Evolucionar Fichas</span></a>
                            <a href="{{route('record.index')}}" class="collapse-item"><span><i class="fas fa-users"></i> Pacientes (Historico)</span></a>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth::user()->isTrainer() || Auth::user()->isAdmin())
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                        <i class="fas fa-users"></i>
                        <span>Entrenamiento</span>
                    </a>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a href="{{route('admin.training.students')}}" class="collapse-item"><span>Alumnos</span></a>
                            <hr>
                            @foreach(App\Models\TrainAppointments::where('date',date('Y-m-d'))->get() as $class)
                             <a href="{{route('admin.training.today',['id' => $class->id])}}" class="collapse-item"><span>{{$class->name}} {{$class->time}}</span></a>
                            @endforeach
                        </div>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                        aria-expanded="true" aria-controls="collapseFive">
                        <i class="fas fa-users"></i>
                        <span>Planes y Calendario</span>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a href="{{route('admin.training.students')}}" class="collapse-item"><span></span>Planes</a>
                            <hr>
                            @foreach(App\Models\TrainAppointments::where('date',date('Y-m-d'))->get() as $class)
                             <a href="{{route('admin.training.today',['id' => $class->id])}}" class="collapse-item"><span>{{$class->name}} {{$class->time}}</span></a>
                            @endforeach
                        </div>
                    </div>
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
                                <a class="dropdown-item" href="{{ url('/') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Inicio') }}
                                </a>
                                @if(Auth::user()->isAdmin())
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




                <!-- /.container-fluid -->


            <!-- End of Main Content -->
