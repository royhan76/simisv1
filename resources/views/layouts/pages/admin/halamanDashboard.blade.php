@extends('master')

@section('body')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                <h5 class="text-white op-7 mb-2">Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie</h5>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card full-height">
                <div class="card-body">
                    <div class="row">

                        <!-- Tarbiyah -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Tarbiyah</p>
                                            <h4 class="card-title">120</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengurus -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Pengurus</p>
                                            <h4 class="card-title">45</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ndalem -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Ndalem</p>
                                            <h4 class="card-title">30</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Alumni -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-graduate"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Alumni</p>
                                            <h4 class="card-title">500</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Santri Baru -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-user-plus"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Santri Baru</p>
                                            <h4 class="card-title">200</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Santri Keluar -->
                        <div class="col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                                <i class="fas fa-user-minus"></i>
                                            </div>
                                        </div>
                                        <div class="col ml-3">
                                            <p class="card-category">Santri Keluar</p>
                                            <h4 class="card-title">80</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- LINE CHART -->
                        <div class="col-md-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Statistik Santri Pertahun</div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

<script>
var ctx = document.getElementById('lineChart').getContext('2d');

var lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["2019", "2020", "2021", "2022", "2023", "2024", "2025"],
        datasets: [{
            label: "Jumlah Santri",
            borderColor: "#1d7af3",
            pointBackgroundColor: "#1d7af3",
            backgroundColor: "rgba(29,122,243,0.2)",
            fill: true,
            data: [300, 350, 400, 480, 550, 620, 700]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom'
        }
    }
});
</script>

@endsection
