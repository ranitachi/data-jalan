@extends('backend.layouts.master')

@section('title')
    <title>Sistem Informasi Data Jalan - Admin Dashboard</title>
@endsection

@section('content-head')
    <div class="profile-edit-page-header">
        <h2>Dashboard</h2>
        <div class="breadcrumbs">
            <span>Home</span>
        </div>
    </div>
@endsection

@section('content')
    
    <div class="col-md-12">
        <div class="dashboard-list-box fl-wrap">
            <div class="dashboard-header fl-wrap">
                <h3>Grafik Kondisi Jalan - Kabupaten Tangerang</h3>
            </div>
            <div class="col-md-12">
                <canvas id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>

@endsection

@section('foot-script')
    <script src="{{ asset('/') }}/chart/chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Baik", "Sedang", "Rusak", "Rusak Berat"],
                datasets: [{
                    label: 'Seluruh Jalan Wilayah Kabupaten Tangerang',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        </script>
@endsection