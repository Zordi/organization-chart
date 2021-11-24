<?php
session_start();
include "config/db.php";
if (!isset($_SESSION["email"])) {
  header("Location:login.php");
}
$usrid=$_SESSION["usrid"];
$nama=$_SESSION["nama"];
$email=$_SESSION["email"];
if (isset($_POST["save"])) {
            $kat = $_POST["nama"];

            mysqli_query($kon,"insert into kategori (ktgid, usrid, nama, status) values (NULL,$usrid,'$kat','Y')");
            
          }
if (isset($_POST["edit"])) {
            $kat = $_POST["nama"];
            $ktgid = $_POST["id"];
            mysqli_query($kon,"update kategori set usrid=$usrid, nama='$kat', status='Y' where ktgid=$ktgid");
            
          }
if (isset($_POST["delete"])) {
            
            $ktgid = $_POST["id"];
            mysqli_query($kon,"delete from kategori where ktgid=$ktgid");
            
          }
if (isset($_POST["savechart"])) {
            $ichart = $_POST["ichart"];
            $chartn = $_POST["nchart"];
            $kat = $_POST["kat"];
            mysqli_query($kon,"insert into chart (chartid, ktgid, nama, status) values ($ichart,$kat,'$chartn','Y')");
            $inama = $_POST["inama"];
            $iposisi = $_POST["iposisi"];
            $iparent = $_POST["iparent"];
            $index = 0; 
            foreach($inama as $namai){
              $in = $inama[$index];
              $ip = $iposisi[$index];
              $ipa = $iparent[$index];
              mysqli_query($kon,"insert into isi (isiid, chartid, nama,posisi, parent) values (NULL,$ichart,'$in','$ip','$ipa')");
              $index++;
            }
          }
if (isset($_POST["editchart"])) {
  $ichart = $_POST["ichart"];
            $chartn = $_POST["nchart"];
            $kat = $_POST["kat"];
            mysqli_query($kon,"update chart set ktgid=$kat, nama='$chartn', status = 'Y' where chartid=$ichart");
            $isiid = $_POST["isiid"];
            $inama = $_POST["inama"];
            $iposisi = $_POST["iposisi"];
            $iparent = $_POST["iparent"];
            $index = 0; 
            foreach($inama as $namai){
              $id = $isiid[$index];
              $in = $inama[$index];
              $ip = $iposisi[$index];
              $ipa = $iparent[$index];
              mysqli_query($kon,"update isi set nama='$in',posisi='$ip', parent='$ipa' where isiid=$id and chartid=$ichart");
              $index++;
            }
}
if (isset($_POST["deletechart"])) {
            
            $chartid = $_POST["id"];
            mysqli_query($kon,"delete from chart where chartid=".$chartid);
            mysqli_query($kon,"delete from isi where chartid=".$chartid);
            
          }
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="stylesheet" href="assets/css/dashforge.dashboard.css">
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
          
          <a href="" class="nav-link"><i data-feather="home"></i></a>
          <a href="logout.php" class="nav-link"><i data-feather="log-out"></i></a>
        </nav>
      </div><!-- content-header -->

      <div class="content-body">
        <div class="container pd-x-0">
          <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                  
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
            </div>
            
          </div>

          <div class="row row-xs">
            
            
            
            <div class="col-lg-12 col-xl-8 mg-t-10">
              <div class="card mg-b-10">
                <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                  <div>
                    <h6 class="mg-b-5">List Struktur Organisasi</h6>
                    
                  </div>
                  <h6 class="text-right"><a href="#inputchart" data-toggle="modal">Tambah</a></h6>
                  
                </div><!-- card-header -->
              
                <div class="table-responsive">
                  <table class="table table-dashboard mg-b-0">
                    <thead>
                      <tr>
                        <th>ID Chart</th>
                        <th class="text-right">Nama</th>
                        <th class="text-right">Kategori</th>
                        <th class="text-right">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sqll = "select chart.*,kategori.nama as 'kat' from chart,kategori where chart.ktgid=kategori.ktgid and kategori.usrid=".$usrid;
                      $hasill = mysqli_query ($kon,$sqll);
                      $jumlahh = mysqli_num_rows($hasill);
                      
                      if ($jumlahh > 0) {
                        $no = 1;
                       while ($row = mysqli_fetch_array($hasill)) {
                          $chartid = $row['chartid'];
                        
                      ?>
                      <tr>
                        <td class="tx-color-03 tx-normal"><?php echo $row["chartid"] ?></td>
                        <td class="tx-medium text-right"><?php echo $row["nama"] ?></td>
                        <td class="text-right "><?php echo $row["kat"] ?></td>
                        <td class="text-right tx-pink"><a href="#editchart<?php echo $row["chartid"] ?>" data-toggle="modal">Edit</a><a href="#deletechart<?php echo $row["chartid"] ?>" data-toggle="modal"> Delete</a><a href="preview.php?id=<?php echo $row["chartid"] ?>"> Preview</a></td>
                        
                      </tr>
                      <div class="modal fade" id="editchart<?php echo $row["chartid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Input Chart</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <form method="post" action="">
              <div class="row row-sm">
                
                <input type="hidden" class="form-control" name="ichart" value="<?php echo $row["chartid"] ?>" placeholder="ID Chart">
              
              <div class="col-sm">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Edit Chart</label>
                <input type="text" class="form-control" name="nchart" value="<?php echo $row["nama"] ?>" placeholder="Nama Chart">
              </div><!-- col -->
              <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Kategori</label>
                <select name="kat" class="form-control">
                  <?php
                      $sq = "select * from kategori where usrid='".$usrid."' ";
                      $hasi = mysqli_query ($kon,$sq);
                      $jumla = mysqli_num_rows($hasi);
                      
                      if ($jumla > 0) {
                        $no = 1;
                       while ($row = mysqli_fetch_array($hasi)) {
                          
                        
                      ?>
                  <option value="<?php echo $row['ktgid'] ?>"><?php echo $row['nama'] ?></option>
                <?php } } ?>
                </select>
              </div><!-- col -->
            </div>
            <?php
                      $sqlll = "select isi.* from chart,isi where chart.chartid=isi.chartid and isi.chartid = ".$chartid;
                      $hasilll = mysqli_query ($kon,$sqlll);
                      $jumlahhh = mysqli_num_rows($hasilll);
                      
                      if ($jumlahhh > 0) {
                        $no = 1;
                       while ($row = mysqli_fetch_array($hasilll)) {
                          
                        
                      ?>
            <div class="row row-sm">
              <div class="col-sm">
                <input type="hidden" class="form-control" name="isiid[]" value="<?php echo $row['isiid'] ?>" placeholder="id">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text" class="form-control" name="inama[]" value="<?php echo $row['nama'] ?>" placeholder="Nama">
              </div><!-- col -->
              <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text" class="form-control" name="iposisi[]" value="<?php echo $row['posisi'] ?>" placeholder="Posisi/Jabatan">
              </div><!-- col -->
              <div class="col-sm-3 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text"  class="form-control" name="iparent[]" value="<?php echo $row['parent'] ?>" placeholder="Parent">
              </div><!-- col -->
            </div>
          <?php } } ?>
            <div id="row"></div>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-primary" id="btn-tambah-form">Tambah Form</button>
            <button type="button" class="btn btn-warning" id="btn-reset-form">Reset</button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="editchart" value="Save" class="btn btn-primary">
          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="modal fade" id="deletechart<?php echo $chartid; ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Hapus Chart ?</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $chartid;?>">
          
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="deletechart" value="Delete" class="btn btn-danger">

          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
                      <?php } }else{
                        ?>
                        <td class="tx-color-03 tx-normal" colspan="4" align="center">No Data</td>
                        <?php

                      } ?>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->  
            </div><!-- col -->
            <div class="col-lg-12 col-xl-4 mg-t-10">
              <div class="card mg-b-10">
                <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                  <div>
                    <h6 class="mg-b-5">Kategori</h6>
                    
                  </div>
                  <h6 class="text-right"><a href="#inputkategori" data-toggle="modal">Tambah</a></h6>
                  
                </div><!-- card-header -->
              
                <div class="table-responsive">
                  <table class="table table-dashboard mg-b-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        
                        <th class="text-right">Kategori</th>
                        <th class="text-right">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "select * from kategori where usrid='".$usrid."' ";
                      $hasil = mysqli_query ($kon,$sql);
                      $jumlah = mysqli_num_rows($hasil);
                      
                      if ($jumlah > 0) {
                        $no = 1;
                       while ($row = mysqli_fetch_array($hasil)) {
                          
                        
                      ?>
                      <tr>
                        <td class="tx-color-03 tx-normal"><?php echo $no++ ?></td>
                        <td class="tx-medium text-right"><?php echo $row["nama"] ?></td>
                        <td class="text-right tx-teal"><a href="#editkategori<?php echo $row["ktgid"] ?>" data-toggle="modal">Edit</a><a href="#deletekategori<?php echo $row["ktgid"] ?>" data-toggle="modal"> Delete</a></td>
                        
                      </tr>
                      <div class="modal fade" id="editkategori<?php echo $row["ktgid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Edit Kategori</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <form method="post" action="">
            <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $row["ktgid"] ?>">
              <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Nama Kategori</label>
              <input type="text" class="form-control" name="nama" placeholder="Enter name" value="<?php echo $row["nama"] ?>">
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="edit" value="Save" class="btn btn-primary">
          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="modal fade" id="deletekategori<?php echo $row["ktgid"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Hapus Kategori ?</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['ktgid'] ?>">
          
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">

          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
                      <?php } }else{
                        ?>
                        <td class="tx-color-03 tx-normal" colspan="3" align="center">No Data</td>
                        <?php

                      } ?>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->  
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- container -->
      </div>
    </div>
<div class="modal fade" id="inputkategori" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Input Kategori</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <form method="post" action="">
            <div class="form-group">
              <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Nama Kategori</label>
              <input type="text" class="form-control" name="nama" placeholder="Enter name">
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="save" value="Save" class="btn btn-primary">
          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="modal fade" id="inputchart" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg wd-sm-650" role="document">
        <div class="modal-content">
          <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
            <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </a>
            <div class="media align-items-center">
              <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
              <div class="media-body mg-sm-l-20">
                <h4 class="tx-18 tx-sm-20 mg-b-2">Input Chart</h4>
                
              </div>
            </div><!-- media -->
          </div><!-- modal-header -->
          <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
            <form method="post" action="">
              <div class="row row-sm">
                <div class="col-sm">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">ID Chart</label>
                <input type="text" class="form-control" name="ichart" placeholder="ID Chart">
              </div><!-- col -->
              <div class="col-sm">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Nama Chart</label>
                <input type="text" class="form-control" name="nchart" placeholder="Nama Chart">
              </div><!-- col -->
              <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Kategori</label>
                <select name="kat" class="form-control">
                  <?php
                      $sq = "select * from kategori where usrid='".$usrid."' ";
                      $hasi = mysqli_query ($kon,$sq);
                      $jumla = mysqli_num_rows($hasi);
                      
                      if ($jumla > 0) {
                        $no = 1;
                       while ($row = mysqli_fetch_array($hasi)) {
                          
                        
                      ?>
                  <option value="<?php echo $row['ktgid'] ?>"><?php echo $row['nama'] ?></option>
                <?php } } ?>
                </select>
              </div><!-- col -->
            </div>
            <div class="row row-sm">
              <div class="col-sm">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text" class="form-control" name="inama[]" placeholder="Nama">
              </div><!-- col -->
              <div class="col-sm-4 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text" class="form-control" name="iposisi[]" placeholder="Posisi/Jabatan">
              </div><!-- col -->
              <div class="col-sm-3 mg-t-20 mg-sm-t-0">
                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03"></label>
                <input type="text"  class="form-control" name="iparent[]" placeholder="Parent">
              </div><!-- col -->
            </div>
            <div id="row"></div>
          </div><!-- modal-body -->
          <div class="modal-footer pd-x-20 pd-y-15">
            <button type="button" class="btn btn-primary" id="btn-tambah-form">Tambah Form</button>
            <button type="button" class="btn btn-warning" id="btn-reset-form">Reset</button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <input type="submit" name="savechart" value="Save" class="btn btn-primary">
          </div>
          </form>
          
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
<input type="hidden" id="jumlah-form" value="1">
  <script src="lib/jquery/jquery.min.js"></script>
  <script>
  $(document).ready(function(){ // Ketika halaman sudah diload dan siap
    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya       
      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      $("#row").append("<div class='row row-sm'>" + "<div class='col-sm'>" +
        "<label class='tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03'></label>" +
        "<input type='text' class='form-control' name='inama[]' placeholder='Nama'>" +
        "</div>" +
        "<div class='col-sm-4 mg-t-20 mg-sm-t-0'>" +
        "<label class='tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03'></label>" +
        "<input type='text' class='form-control' name='iposisi[]' placeholder='Posisi/Jabatan'>" +
        "</div>" +
        "<div class='col-sm-3 mg-t-20 mg-sm-t-0'>" +
        "<label class='tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03'></label>" +
        "<input type='text'  class='form-control' name='iparent[]' placeholder='Parent'>" +
        "</div>" +
        "</div>");
      
      $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });
    
    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function(){
      $("#row").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
    });
  });
  </script>
    
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/feather-icons/feather.min.js"></script>
    <script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="lib/chart.js/Chart.bundle.min.js"></script>
    <script src="assets/js/dashforge.js"></script>
    <script src="assets/js/dashforge.aside.js"></script>
    <script src="assets/js/dashforge.sampledata.js"></script>
    <script src="assets/js/dashboard-one.js"></script>

    <!-- append theme customizer -->
    <script src="lib/js-cookie/js.cookie.js"></script>
    <script src="assets/js/dashforge.settings.js"></script>
  </body>
</html>
