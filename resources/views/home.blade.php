@extends('layouts.app')

@section('titulo', 'Missão Evidente - Dashboard')

@section('content')
<?php 
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terca-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sábado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    $anoInputValue = isset($_GET['ano']) ? $_GET['ano'] : $ano;
    
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>-->

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="me-4 mb-3 mb-sm-0">
            <h1 class="mb-0">Dashboard</h1>
            <div class="small">
                <span class="fw-500 text-primary">{{$semana["$data"]}}</span>
                · {{$dia}} de {{$mes_extenso["$mes"]}}, {{$ano}} <!-- · 12:16 PM-->
            </div>
        </div>
        <div style="display:flex;">
            <form method="get" action="{{ route('home') }}" enctype="multipart/form-data" style="display:flex;">
                @csrf
                <select name="mes" class="form-control">
                    <option value="1" @if(isset($_GET['mes']) && $_GET['mes'] == "1"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Janeiro" ? 'selected' : '' }}@endif> Janeiro </option>
                    <option value="2" @if(isset($_GET['mes']) && $_GET['mes'] == "2"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Fevereiro" ? 'selected' : '' }}@endif>Fevereiro</option>
                    <option value="3" @if(isset($_GET['mes']) && $_GET['mes'] == "3"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Março" ? 'selected' : '' }}@endif> Março </option>
                    <option value="4" @if(isset($_GET['mes']) && $_GET['mes'] == "4"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Abril" ? 'selected' : '' }}@endif> Abril </option>
                    <option value="5" @if(isset($_GET['mes']) && $_GET['mes'] == "5"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Maio" ? 'selected' : '' }}@endif> Maio </option>
                    <option value="6" @if(isset($_GET['mes']) && $_GET['mes'] == "6"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Junho" ? 'selected' : '' }}@endif> Junho </option>
                    <option value="7" @if(isset($_GET['mes']) && $_GET['mes'] == "7"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Julho" ? 'selected' : '' }}@endif> Julho </option>
                    <option value="8" @if(isset($_GET['mes']) && $_GET['mes'] == "8"){{"selected"}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Agosto" ? 'selected' : '' }}@endif> Agosto </option>
                    <option value="9" @if(isset($_GET['mes']) && $_GET['mes'] == "9"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Setembro" ? 'selected' : '' }}@endif> Setembro </option>
                    <option value="10" @if(isset($_GET['mes']) && $_GET['mes'] == "10"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Outubro" ? 'selected' : '' }}@endif> Outubro </option>
                    <option value="11" @if(isset($_GET['mes']) && $_GET['mes'] == "11"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Novembro" ? 'selected' : '' }}@endif> Novembro </option>
                    <option value="12" @if(isset($_GET['mes']) && $_GET['mes'] == "12"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Dezembro" ? 'selected' : '' }}@endif> Dezembro </option>
                </select>
                {{ $errors->has('mes') ? $errors->first('mes') : '' }}
                <input class="form-control" id="ano" name="ano" type="number" placeholder="" value="{{$anoInputValue}}">
                <button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;">Filtrar</button>
                <a href="{{route('home')}}" class="btn btn-primary" type="submit">limpar</a>
            </form>
        </div>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Gerar Relatório</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card  border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Crentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($crentes) ? $crentes : '0'}} {{$crentes == 0 || $crentes > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-cross fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #4e73df !important">
                                Não Crentes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($incredulos) ? $incredulos : '0'}} {{$incredulos == 0 || $incredulos > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-heart-crack fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #d55b2a!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #d55b2a !important">
                                Presídios</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($presidios) ? $presidios : '0'}} {{$presidios == 0 || $presidios > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-person-shelter fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid #99443b!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #99443b !important">
                                Enfermos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($enfermos) ? $enfermos : '0'}} {{$enfermos == 0 || $enfermos > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-syringe fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" style="border-left: 0.25rem solid #f6c23e !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #f6c23e !important">
                                Hospitais</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($hospitais) ? $hospitais : '0'}} {{$hospitais == 0 || $hospitais > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-hospital fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #85102f!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #85102f !important">
                                Escolas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($escolas) ? $escolas : '0'}} {{$escolas == 0 || $escolas > 1 ? 'visitas' : 'visita'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-4 col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Membresia aos Domingos</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body card-dashboard">
                    @if(count($membresias))
                        @foreach ($membresias as $membresia)
                            <div class="card-item-dashboard" style="padding: 15px 10px;">
                                <a href="{{route('membresia.edit', ['id' => $membresia->id])}}" class="text-indigo-700 font-semibold"><strong>{{$membresia->nome}}:</strong></a> {{$membresia->quantidade}} pessoas. <br>(Registro criado em {{$membresia->created_at->format('d/m/Y')}}) 
                            </div>
                        @endforeach
                    @else
                        <h5 style="text-align:center;margin-top:130px;">Nenhum resultado encontrado!</h5>    
                    @endif
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #4e73df !important;">Atos Pastorais</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body card-dashboard">
                    @if(count($atos))
                        @foreach($atos as $ato)
                            <div class="card-item-dashboard" style="padding: 15px 10px;">
                                <a href="{{route('atos-pastorais.edit', ['id' => $ato->id])}}" class="text-indigo-700 font-semibold"><strong style="color: #4e73df;">{{$ato->nome}}:</strong></a> {{$ato->quantidade}} pessoas. <br>(Registro criado em {{$ato->created_at->format('d/m/Y')}}) 
                            </div>
                        @endforeach
                    @else
                        <h5 style="text-align:center;margin-top:130px;">Nenhum resultado encontrado!</h5>    
                    @endif
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #85102f !important;">Pregações</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body card-dashboard">
                    @if(count($pregacoes))
                        @foreach($pregacoes as $pregacao)
                            <div class="card-item-dashboard" style="padding: 15px 10px;">
                                <a href="{{route('pregacao.edit', ['id' => $ato->id])}}" class="text-indigo-700 font-semibold"><strong style="color: #85102f;">{{$pregacao->nome}}:</strong></a> {{$pregacao->quantidade}} pessoas. <br>(Registro criado em {{$pregacao->created_at->format('d/m/Y')}})
                            </div>
                        @endforeach
                    @else
                        <h5 style="text-align:center;margin-top:130px;">Nenhum resultado encontrado!</h5>    
                    @endif
                </div>
            </div>
        </div>
            <!-- Content Row -->
    </div>
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
                </div>
                <div class="card-body">
                    <p>Nesta área estão expostos todos os dados relacionados aos seu registros mês à mês. Sendo todas as Visitações, Membros, Atos Pastorais e Pregações. </p>
                    <p class="mb-0">Você pode realizar filtros de acordo com seu interesse.  </p>
                </div>
            </div>

        </div>
    </div>
    

    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
