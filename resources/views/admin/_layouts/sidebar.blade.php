

<div class="page-wrap">
<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <span class="text">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Administración</div>
                <div class="nav-item">
                    <a href="#"><i class="ik ik-bar-chart-2"></i><span>Panel</span></a>
                </div>
                {{-- <div class="nav-item">
                    <a href="pages/navbar.html"><i class="ik ik-menu"></i><span>Navigation</span> <span class="badge badge-success">New</span></a>
                </div> --}}
                @if(Auth::user()->isAdmin())
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Profesionales</span></a>
                        <div class="submenu-content">
                            <a href="{{url('professionals')}}" class="menu-item">Lista</a>
                            <a href="{{url('professionals/create')}}" class="menu-item">Crear</a>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->isProfessional())
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Mi Horario</span></a>
                        <div class="submenu-content">
                            <a href="{{url('appointments')}}" class="menu-item">Lista</a>
                            <a href="{{url('appointments/create')}}" class="menu-item">Crear mi horario</a>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->isProfessional())
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Citas Pacientes</span></a>
                        <div class="submenu-content">
                            <a href="{{route('patient')}}" class="menu-item">Pacientes (Hoy)</a>
                            <a href="{{route('record.index')}}" class="menu-item">Evolucionar Fichas</a>
                            <a href="{{route('all.appointments')}}" class="menu-item">Pacientes (Historico)</a>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->isTrainer() || Auth::user()->isAdmin())
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Entrenamiento</span></a>
                        <div class="submenu-content">
                            <a href="{{route('admin.training.students')}}" class="menu-item">Alumnos</a>
                            <hr>
                            <a href="#" class="menu-item"><strong>Clases de Hoy:</strong></a>
                            @foreach(App\Models\TrainAppointments::where('date',date('Y-m-d'))->get() as $class)
                                <a href="{{route('admin.training.today',['id' => $class->id])}}" class="menu-item">{{$class->name}} {{$class->time}}</a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </nav>
        </div>
    </div>
</div>
