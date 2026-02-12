@extends('dashboard')
@section('title_dashboard','Reporte Etapa VS Registrados')
@section('breadcrumbs')
    {{ Breadcrumbs::render('convocatorias.reporte',$convocatoria) }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">            
        </div>
        <div class="card-body">
            <canvas id="myChart" width="450" height="450"></canvas>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            var datos = <?= $datos ?>;
            console.log(datos);

            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: datos.labels,
                    datasets: [{
                        data: datos.datos
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: "top"
                    },
                    title: {
                        display: true,
                        text: "Chart.js Bar Chart"
                    },
                    scales: {
                        yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                        }]
                    }
                }
            });
        });
    </script>
@stop