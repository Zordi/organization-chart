<?php
session_start();
include "config/db.php";
if (!isset($_SESSION["email"])) {
  header("Location:login.php");
}
$usrid=$_SESSION["usrid"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];
if ($_GET['id']) {
  $idchart = $_GET['id'];
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
    <link href="lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="assets/css/dashforge.css">
    <link rel="stylesheet" href="assets/css/dashforge.dashboard.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php
    include "config/db.php";
                      $sql = "select isi.* from chart,isi where chart.chartid=isi.chartid and chart.chartid = ".$idchart;
                      $hasil = mysqli_query ($kon,$sql);
                      $jumlah = mysqli_num_rows($hasil);
                      

                      ?>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows([
        <?php
        while ($row = mysqli_fetch_array($hasil)) {
        ?>
          [{'v':'<?php echo $row['nama'] ?>', 'f':'<?php echo $row['nama'] ?><div style="color:red; font-style:italic"><?php echo $row['posisi'] ?></div>'},
           '<?php echo $row['parent'] ?>', '<?php echo $row['posisi'] ?>'],
        <?php } ?>
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.

        chart.draw(data, {'allowHtml':true});
      }
   </script>
  </head>
  <body>

    <aside class="aside aside-fixed">
      <div class="aside-header">
        <a href="" class="aside-logo">Struk<span>tur</span></a>
        <a href="" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
        </a>
      </div>
      <div class="aside-body">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <a href="" class="avatar"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></a>
            
          </div>
          <div class="aside-loggedin-user">
            <a href="" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
              <h6 class="tx-semibold mg-b-0"><?php echo $nama; ?></h6>
              
            </a>
            
          </div>
          
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
          
          <li class="nav-item active"><a href="logout.php" class="nav-link"><i data-feather="log-out"></i> <span>Keluar</span></a></li>
          
        </ul>
      </div>
    </aside>

    <div class="content ht-100v pd-0">
      <div class="content-header">
        <nav class="nav">
          
          <a href="index.php" class="nav-link"><i data-feather="home"></i></a>
          <a href="logout.php" class="nav-link"><i data-feather="log-out"></i></a>
        </nav>
      </div><!-- content-header -->

      <div class="content-body">
        <div class="container pd-x-0">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">Preview Struktur</h4>
            </div>
            <div class="d-none d-md-block">
              
              
            </div>
          </div>

          <div class="row row-xs">
            
            <div class="col-lg-12 col-xl-12 mg-t-10">
              <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                  <h6 class="mg-b-0">Preview </h6>
                  
                </div><!-- card-header -->
                <div class="card-body pos-relative pd-0">
                  

                  <div id="chart_div"></div>
                </div><!-- card-body -->
              </div><!-- card -->
            </div>
            
          </div><!-- row -->
        </div><!-- container -->
      </div>
    </div>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="lib/jquery.flot/jquery.flot.js"></script>
    <script src="lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="lib/chart.js/Chart.bundle.min.js"></script>
    <script src="lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="assets/js/dashforge.js"></script>
    <script src="assets/js/dashforge.aside.js"></script>
    <script src="assets/js/dashforge.sampledata.js"></script>
    <script src="assets/js/dashboard-one.js"></script>

    <!-- append theme customizer -->
    <script src="lib/js-cookie/js.cookie.js"></script>
    <script src="assets/js/dashforge.settings.js"></script>
  </body>
</html>
