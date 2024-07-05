<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?php include ('logo.php');?>

    <!-- Sidebar -->
    <?php include('sidebar.php');?>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                   Pemasukan Lapangan Futsal
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#weekly-chart" data-toggle="tab">Mingguan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#daily-chart" data-toggle="tab">Harian</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Weekly chart -->
                                    <div class="chart tab-pane active" id="weekly-chart"
                                        style="position: relative; height: 300px;">
                                        <canvas id="weekly-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                    <!-- Daily chart -->
                                    <div class="chart tab-pane" id="daily-chart" style="position: relative; height: 300px;">
                                        <canvas id="daily-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">
                        <!-- Your additional content goes here -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2024 <a href="/">System Solver</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- Script to Fetch Data and Create Chart -->
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'getWeeklyData.php',
                method: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    var weeklyData = data.weekly;
                    var dailyData = data.daily;

                    // Weekly Data
                    var weeklyLabels = [];
                    var weeklyValues = [];

                    weeklyData.forEach(function(item) {
                        var weekNumber = item.week % 4 || 4; // Menghitung minggu dalam satu bulan
                        weeklyLabels.push(`Minggu ${weekNumber}, ${item.year}`);
                        weeklyValues.push(item.total_harga);
                    });

                    var ctxWeekly = document.getElementById('weekly-chart-canvas').getContext('2d');
                    var weeklyChart = new Chart(ctxWeekly, {
                        type: 'line',
                        data: {
                            labels: weeklyLabels,
                            datasets: [{
                                label: 'Total Pemasukan Pemesanan per Minggu',
                                data: weeklyValues,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    // Daily Data
                    var dailyLabels = [];
                    var dailyValues = [];

                    // Fungsi untuk mengubah tanggal menjadi nama hari
                    function getDayName(dateStr) {
                        var date = new Date(dateStr);
                        return date.toLocaleDateString('id-ID', { weekday: 'long' });
                    }

                    dailyData.forEach(function(item) {
                        dailyLabels.push(getDayName(`${item.year}-${item.month}-${item.day}`));
                        dailyValues.push(item.total_harga);
                    });

                    var ctxDaily = document.getElementById('daily-chart-canvas').getContext('2d');
                    var dailyChart = new Chart(ctxDaily, {
                        type: 'line',
                        data: {
                            labels: dailyLabels,
                            datasets: [{
                                label: 'Total Pemasukan Pemesanan per Hari',
                                data: dailyValues,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
</body>
</html>
