<?php

require('config/db.php');

session_start();
 
$error = '';
$validate = '';
$pesan = '';
if( isset($_POST['submit']) ){
        
        $name     = stripslashes($_POST['fullname']);
        $name     = mysqli_real_escape_string($kon, $name);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($kon, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($kon, $password);
        
        if(!empty(trim($name))  && !empty(trim($email)) && !empty(trim($password)) ){
            
            
                
                if( cek_nama($email,$kon) == 0 ){
                    
                    
                    $query = "INSERT INTO user (usrid,nama,email, password,status ) VALUES (NULL,'$name','$email','$password','Y')";
                    $result   = mysqli_query($kon, $query);
                    
                    if ($result) {                  
                        
                        $pesan =  'Registrasi berhasil, silahkan login !!';
                    //jika gagal maka akan menampilkan pesan error
                    } else {
                        $error =  'Register User Gagal !!';
                    }
                }else{
                        $error =  'Email sudah terdaftar !!';
                }
            
             
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 
    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($email,$kon){
        $nama = mysqli_real_escape_string($kon, $email);
        $query = "SELECT * FROM user WHERE email = '$email'";
        if( $result = mysqli_query($kon, $query) ) return mysqli_num_rows($result);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <title>Struktur</title>

    <!-- vendor css -->
    <link href="lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="assets/css/dashforge.css">
    <link rel="stylesheet" href="assets/css/dashforge.auth.css">
  </head>
  <body>

    <header class="navbar navbar-header navbar-header-fixed">
      <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <a href="index.php" class="df-logo">Struk<span>tur</span></a>
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="index.php" class="df-logo">Struk<span>tur</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        
        </ul>
      </div><!-- navbar-menu-wrapper -->
      
    </header><!-- navbar -->

    <div class="content content-fixed content-auth">
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p">
              <h4 class="tx-color-01 mg-b-5">Create New Account</h4>
              <p class="tx-color-03 tx-16 mg-b-40"><?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php }elseif ($pesan != '') {
                      ?>
                      <div class="alert alert-success" role="alert"><?= $pesan; ?></div>
                      <?php
                    }  ?></p>
              <form method="post" action="">
              <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email address">
              </div>
              <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">Password</label>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Enter your password">
              </div>
              <div class="form-group">
                <label>Fullname</label>
                <input type="text" name="fullname" class="form-control" placeholder="Enter your firstname">
              </div>
              
              

              <input type="submit" name="submit" value="Register" class="btn btn-brand-02 btn-block">
              </form>
              <div class="tx-13 mg-t-20 tx-center">Already have an account? <a href="login.php">Log In</a></div>
            </div>
          </div><!-- sign-wrapper -->
          <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
              <img src="assets/img/bg.png" class="img-fluid" alt="">
            </div>
            
          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; 2021 Struktur </span>
        
      </div>
      <div>
        
      </div>
    </footer>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="assets/js/dashforge.js"></script>

    <!-- append theme customizer -->
    <script src="lib/js-cookie/js.cookie.js"></script>
    <script src="assets/js/dashforge.settings.js"></script>
    <script>
      $(function(){
        'use script'

        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }
      })
    </script>
  </body>
</html>
