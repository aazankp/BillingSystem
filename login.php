<?php
include "connection.php";
if(isset($_REQUEST['sub'])){
    $username=$_REQUEST['uname'];
    $pass=$_REQUEST['pass'];
    $password = md5($pass);
    // die($password);
    
    $query=mysqli_query($conn,"SELECT * FROM login WHERE username='$username' AND password='$password'");
    $count=mysqli_num_rows($query);
    if ($count>0) {
        # code...
        session_start();
        $_SESSION['username'] = $username;
        header("location: home.php");
    }else{
        echo "<div class='alert alert-danger text-center mt-5'>Please Enter a valid username and password</div>";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
 <!-- iCheck -->
 <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body rounded">
      <p class="login-box-msg">Login to Move on Your Webpage</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="uname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="sub">login In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <button class='form control btn btn-block btn-success' data-bs-toggle='modal' data-bs-target='#mymodal'>Create New Account</button>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- modal div -->
<div class="modal fade" id="mymodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <span class="h1 fw-bold">Register</span>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3 mt-3">
              <input type="email" placeholder="Full Name" class="form-control">
          </div>
          <div class="mb-3">
              <input type="email" placeholder="Email Address" class="form-control">
          </div>
          <div class="mb-3">
              <input type="password" placeholder="Password" class="form-control">
          </div>
          <div class="mb-3">
              <input type="password" placeholder="Confirm Password" class="form-control">
          </div>
          <div class="mb-3">
              <input type="text" placeholder="CNIC No" class="form-control">
          </div>
          <div class="mb-3">
              <input type="checkbox" class="mt-2 mb-3"> Remember me
          </div>
            <button type="submit" class="btn btn-dark form-control fw-bold" id="inemail">Register</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- /.modal -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
</body>
</html>