    <?php
    
    require_once "../controller/connection.php";
    require_once "../controller/graph.php";
    $tgl1 = date("Y-m-d 00:00:00");
    $tgl2 = date("Y-m-d 23:59:59");
    $tgl3 = date("Y-m-d");
    $conn = new Connection();
    
    $login = 0;
    try{
      $query = mysqli_query($conn->index(), "SELECT UserID, COUNT(*) AS TotalLogin FROM log_login WHERE LoginDate BETWEEN '$tgl1' AND '$tgl2' AND LogoutDate IS NULL GROUP BY UserID");
    }catch(Exception $e){
      $e->getMessage();
    }

    try{
      $query2 = mysqli_query($conn->index(), "SELECT * FROM peminjaman WHERE TanggalPeminjaman = '$tgl3'");
    }catch(Exception $e){
      $e->getMessage();
    }

    $login = mysqli_num_rows($query);

    $peminjaman = mysqli_num_rows($query2);

    $graph = new Graph();
    $data = $graph->getPeminjam();
    
    $page = "Dashboard";

    // Header
    include "layout/header.php";
    //Header
    
    // Navbar
    include "layout/navbar.php";
    // Navbar
    
    // Sidebar
    include "layout/sidebar.php";
    // Sidebar 
  ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Peminjaman</span>
                <span class="info-box-number"><?= $peminjaman ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">User Login</span>
                <span class="info-box-number"><?= $login ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Peminjaman (1 Minggu)</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <!-- <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                    </p>

                    <div class="chart col-md-w-50">
                      <!-- Sales Chart Canvas -->
                      <canvas id="myChart"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- Footer -->
<?php include "layout/footer.php" ?>

<script>
    const ctx = document.getElementById('myChart');
    const data = <?php echo json_encode(array_values($data)); ?>;

// Chart
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: '# Jumlah Peminjam',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132,0.7)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                beginAtZero: true,
                }
            },
        }
    });

</script>
<!-- /.Footer -->