<?php include '../classes/Adminlogin.php'; ?>
<?php 
   $al = new Adminlogin();
   if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
       $adminUser = $_POST['adminUser'];
       $adminPass = md5($_POST['adminPass']) ;
       
       $loginchk = $al->adminLogin($adminUser,$adminPass);
   }


   ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | LogIn</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

</head>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="login.php"><b>Admin</b>Login</a>

        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <span style="color: red;font-size: 20px;">
      <?php 
          if(isset($loginchk) ){
            echo $loginchk;
          }

       ?>
    </span>
            <form action="login.php" method="POST">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="adminUser">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="adminPass">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
        </form>

            <div class="social-auth-links text-center">
                <p>---</p>
                <a href="impijush.com">Pijush Karmakar</a>
            </div>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
