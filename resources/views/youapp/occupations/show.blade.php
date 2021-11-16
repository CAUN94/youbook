@extends('youapp.layouts.layout')
@section('container')
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
        @if(Auth::user()->isAdmin() and $type != Null)
        <a href="{{ route('excel-download', ['type' => $type]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Descargar Reporte</a>
        @endif
    </div>

    <div class="row">

        @if(Auth::user()->isAdmin() and (Route::is('occupation') or Route::is('form-occupation')))
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Prestaciones</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $summary['Prestación'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Abono</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$summary['Abono']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @elseif(Auth::user()->isProfessional() and (Route::is('occupation-professional')) or Route::is('form-occupation-professional'))
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Remuneración Total</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$summary['Prestación']}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Meta de atenciones: <b>{{ $goal }}</b>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $percentage }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Atenciones</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $summary['Atenciones'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->medilink())
        @if(Auth::user()->medilink()->kams()->count()>0)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Kams</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ array_sum(array_column(Auth::user()->medilink()->kamsCalculate($type),1)) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endif
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Resumen</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="occupationTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    @if(Auth::user()->isAdmin() and (Route::is('occupation') or Route::is('form-occupation')))
                                        <th>Profesional</th>
                                        <th>Atenciones Totales</th>
                                        <th>Con Convenio</th>
                                        <th>Sin Convenio</th>
                                        <th>Embajador</th>
                                        <th>Prestación</th>
                                        <th>Abono</th>
                                    @elseif(Auth::user()->isProfessional() and (Route::is('occupation-professional')) or Route::is('form-occupation-professional'))
                                        <th>Fecha Cita</th>
                                        <th>Paciente</th>
                                        <th>Con Convenio</th>
                                        <th>Sin Convenio</th>
                                        <th>Embajador</th>
                                        <th>Remuneración</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#collapseCita" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCita">
                    <h6 class="m-0 font-weight-bold text-primary">Tipo de Atenciones</h6>
                </a>

                <!-- Card Body -->
                <div class="collapse show" id="collapseCita">
                    <div class="card-body">

                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4">
                            <span class="my-2 d-block text-gray">
                                <i class="fas fa-circle "></i> Con Convenio
                            </span>
                            <span class="my-2 d-block text-orange">
                                <i class="fas fa-circle "></i> Sin Convenio
                            </span>
                            <span class="my-2 d-block text-dark-orange">
                                <i class="fas fa-circle "></i> Embajadores
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#collapseCategoria" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCategoria">
                    <h6 class="m-0 font-weight-bold text-primary">Categorias</h6>
                </a>
                <!-- Card Body -->

                <div class="collapse show" id="collapseCategoria">
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="Categorias"></canvas>
                        </div>
                        <div class="mt-4">
                            <?php $r = 243?>
                            @foreach($categories as $category)
                                <span class="my-2 d-block text-gray" style="color: rgb({{$r}}, 112, 89) !important">
                                    <i class="fas fa-circle "></i> {{$category->Categoria}}
                                </span>
                            <?php $r = $r - 30 ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->medilink())
            @if(Auth::user()->medilink()->kams()->count()>0)
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#collapseKams" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseKams">
                    <h6 class="m-0 font-weight-bold text-primary">Kams</h6>
                </a>
                <!-- Card Body -->

                <div class="collapse show" id="collapseKams">
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="Kams"></canvas>
                        </div>
                        <div class="mt-4">
                            <?php $r = 243?>
                            @foreach(Auth::user()->medilink()->kamsCalculate($type) as $info)
                                <span class="my-2 d-block text-gray" style="color: rgb({{$r}}, 112, 89) !important">
                                    <i class="fas fa-circle "></i> {{$info[0]}}
                                </span>
                            <?php $r = $r - 30 ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endif


        </div>
    </div>

</div>

@stop

@section('scripts')
<script type="text/javascript">
    actions = {!! json_encode($actions, JSON_HEX_TAG) !!}
</script>
<script type="text/javascript">
    summary = {!! json_encode($summary, JSON_HEX_TAG) !!}
</script>
<script type="text/javascript">
    categories = {!! json_encode($categories, JSON_HEX_TAG) !!}
</script>
@if(Auth::user()->medilink())
@if(Auth::user()->medilink()->kams()->count()>0)
<script type="text/javascript">
    kams = {!! json_encode(Auth::user()->medilink()->kamsCalculate($type), JSON_HEX_TAG) !!}
</script>
@endif
@endif
@if(Auth::user()->isAdmin() and (Route::is('occupation') or Route::is('form-occupation')))
<script type="text/javascript" src="{{ asset('js/ocuppation/occupations.js')}}"></script>
@elseif(Auth::user()->isProfessional() and (Route::is('occupation-professional')) or Route::is('form-occupation-professional'))
<script type="text/javascript" src="{{ asset('js/ocuppation/ocuppation_professional.js')}}"></script>
@endif

<script type="text/javascript" src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/charts/pie.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/charts/pie-categories.js')}}"></script>
@stop
