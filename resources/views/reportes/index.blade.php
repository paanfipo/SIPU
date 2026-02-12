@extends('dashboard')
@section('title_dashboard','Reporte Emprendimiento')
@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection
@section('content')
    @include('fragmento.error')
    @include('fragmento.msj')
    <div class="card shadow mb-4">
        <div class="card-header py-3">            
        </div>
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            var datos = <?= $datos ?>;

            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: datos.labels,
                    datasets: [
                        {
                            label: "Registrados",
                            backgroundColor: "lightgreen",
                            borderColor: "green",
                            borderWidth: 1,
                            data: datos.registrados
                        },
                        {
                            label: "Finalizados",
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: datos.finalizados
                        },
                    ]
                },
                options: {
                    responsive: true,
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