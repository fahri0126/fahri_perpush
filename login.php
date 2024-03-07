<?php
require_once "controller/auth.php";

// session_destroy();

isset($_SESSION['login']) ? exit(header("location:dashboard/index.php")) : '';

$auth = new Auth();

if(isset($_POST["submit"])){
  $success = $auth->do_login($_POST);

  if($success){
    exit(header("location:dashboard"));
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Digital | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-secondary">
<div class="login-box">
  <div class="login-logo">
    <p><b>Log&nbsp;</b>in</p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body bg-dark">
      <p class="login-box-msg">Silahkan login</p>

      <form action="" method="post">
        <div class="mb-3">
          <input type="text" name="user" class="form-control bg-dark" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="password" name="pass" id="pass" class="form-control bg-dark" placeholder="Password" required>
        </div>
        <div class="row">
          <div class="col-8 mb-3">
            <div class="icheck-primary">
              <input type="checkbox" id="showPass" onclick="showPassword()">
              <label for="showPass">
                Show Password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-info btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="text-center mt-3">Belum punya akun? <a class="text-center text-info" href="registrasi.php">Registrasi</a></p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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
