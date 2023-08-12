@extends('layouts.app')

@section('titulo', 'Missão Evidente - Relatórios Gerais')

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page Heading 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>-->

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="me-4 mb-3 mb-sm-0">
            <h1 class="mb-0">Relatórios Gerais</h1>
            <div class="small">
                <span class="fw-500 text-primary">{{$semana["$data"]}}</span>
                · {{$dia}} de {{$mes_extenso["$mes"]}}, {{$ano}} <!-- · 12:16 PM-->
            </div>
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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid #ab8513!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #ab8513 !important">
                                Média de Membros aos Domingos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($mediaMembresias) ? intval($mediaMembresias) : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2" style="border-left: 0.25rem solid #490b6f !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #490b6f !important">
                                Média de Atos Pastorais (Batismos, Bençãos Nupciais, Santa Ceia e Profissões de Fé)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($mediaAtos) ? intval($mediaAtos) : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #084713!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #084713 !important">
                                Média de Pregações (Estudos, Sermões, Estudos Bíblicos e Discipulados)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($mediaPregacoes) ? intval($mediaPregacoes) : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-book-bible fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Média de membros aos Domingos/mês</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div><br>
                </div>
            </div>

        </div>

        <!-- Visitação -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Visitação</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
                </div>
                <div class="card-body">
                    <p>Nesta área estão expostos todos os dados relacionados aos seu registros. Sendo todas as Visitações e a média de Membros, Atos Pastorais e Pregações. </p>
                    <p class="mb-0">A média se dá pela soma das quantidade dividido pelo número de registros. Exemplo: Em um determinado mês se teve 5 registros(domingos) e com soma de membros em 150. Dividindo pelos 5 registros temos uma média de 30 membros.  </p>
                </div>
            </div>

        </div>
    </div>

    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
