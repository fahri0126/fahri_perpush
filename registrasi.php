<?php
require_once "controller/auth.php";

$auth = new Auth();

if(isset($_POST['submit'])){
  $_POST['Level'] = 'peminjam';
  $success = $auth->do_register($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Digital | Registrasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page bg-secondary">
<div class="register-box">
  <div class="register-logo">
    <b>Registrasi</b>
  </div>

  <div class="card">
    <div class="card-body register-card-body bg-dark">
      <p class="login-box-msg">Buat akun baru</p>

      <form method="post">
        <div class="mb-3">
          <input type="text" class="form-control bg-dark" name="user" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control bg-dark" name="nama" placeholder="Nama Lengkap" required>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control bg-dark" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control bg-dark" name="alamat" placeholder="Alamat" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control bg-dark" name="pass" id="pass" placeholder="Password" required>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="showPass" onclick="showPassword()">
              <label for="showPass">
                Show Password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12 my-2">
            <button type="submit" name="submit" class="btn btn-info btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="text-center">Sudah punya akun? <a href="login.php" class="text-info">Login</a></p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>


<script>
  function showPassword(){
    var x = document.getElementById('pass');
    
    if(x.type == 'password'){
      x.type = 'text';
    }else{
      x.type = 'password'
    }
  }
</script>

</body>
</html>
