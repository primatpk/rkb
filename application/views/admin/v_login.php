<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online RKB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="<?php echo base_url().'assets/datatables/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="nav-link" data-slide="true" href="<?php echo base_url().'welcome/logout' ?>" role="button">Logout
          <i class="fa fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
    <img src="<?php echo base_url(); ?>assets/dist/img/logo-ptp.png"
           class="brand-image img-circle"
          >
      <span class="brand-text font-weight-light">RKB Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Ridho</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/direktorat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Direktorat</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/divisi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Divisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/jabatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Database Pegawai
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>admin/data_login" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Login</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>admin/monitoring_rkb" class="nav-link">
              <i class="nav-icon fas fa-desktop"></i>
              <p>Monitoring</p>
            </a>
      <!--      <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php //echo base_url(); ?>admin/monitoring_rkb" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RKB</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="<?php //echo base_url(); ?>admin/monitoring_realisasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realisasi RKB</p>
                </a>
              </li>
            </ul> -->
          </li>
   <!--       <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Ganti Password
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Database Pengguna Aplikasi RKB PT Prima Terminal Petikemas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
  <?php   
      if($this->session->flashdata('error') !='')
      {
        echo '<div class="alert alert-danger" role="alert">';
        echo $this->session->flashdata('error');
        echo '</div>';
        }
            elseif($this->session->flashdata('error_input') !='')
          {
            echo '<div class="alert alert-danger" role="alert">';
            echo $this->session->flashdata('error_input');
            echo '</div>';
            }
            elseif($this->session->flashdata('sukses_input') !='')
          {
            echo '<div class="alert alert-info" role="alert">';
            echo $this->session->flashdata('sukses_input');
            echo '</div>';
            }
            elseif($this->session->flashdata('sukses_edit') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('sukses_edit');
              echo '</div>';
              }
	?>
    <h3 class="card-title">Database Pengguna Aplikasi RKB PT Prima Terminal Petikemas</h3>
  </div>
  <div class="card-body">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahuserModal"> 
      <i class="fas fa-plus-circle"></i>Tambah Pengguna
      </button></br></br>
      <table id="table" class="display" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Username</th>
                  <th scope="col" style="text-align:center">Nama</th>
                  <th scope="col" style="text-align:center">NIPP</th>
                  <th scope="col" style="text-align:center">Level Akses</th>
                  <th scope="col" style="text-align:center">Waktu Update</th>
                  <th scope="col" style="text-align:center">Diupdate Oleh</th>
                  <th scope="col" style="text-align:center">Edit</th>
                  <th scope="col" style="text-align:center">Hapus</th>
              </tr>
          </thead>
          <tbody style="text-align:center"> </tbody>
          <tfoot>
          <tr>
                    <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Username</th>
                  <th scope="col" style="text-align:center">Nama</th>
                  <th scope="col" style="text-align:center">NIPP</th>
                  <th scope="col" style="text-align:center">Level Akses</th>
                  <th scope="col" style="text-align:center">Waktu Update</th>
                  <th scope="col" style="text-align:center">Diupdate Oleh</th>
                  <th scope="col" style="text-align:center">Edit</th>
                  <th scope="col" style="text-align:center">Hapus</th>
              </tr>
          </tfoot>     
      </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  Database Pengguna Aplikasi RKB PT Prima Terminal Petikemas
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

  <!-- Modal Tambah Pengguna-->
  <div class="modal fade" id="tambahuserModal" tabindex="-1" aria-labelledby="tambahuserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Input Data Pengguna</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form autocomplete="off" action="<?php echo base_url(); ?>admin/input_user" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Username</label>
                          <input type="text" class="form-control" name="username" placeholder="Username">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">NIPP</label>
                          <input list="data_nipp" type="text" class="form-control" name="nipp" id="nipp" onchange="return autofill();">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Level Akses</label>
                          <input list="data_akses" type="text" class="form-control" name="level">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-7">
                              <label for="inputJenisUser">Nama</label>
                              <input type="text" class="form-control" name="nama" id="nama" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-7">
                              <label for="inputJenisUser">Password</label>
                              <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Waktu Input</label>
                          <input type="text" class="form-control" name="waktu_update" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                  </form>
                 <datalist id="data_nipp">
                    <?php
                    foreach($pegawai as $row)
                    {
                        echo "<option value='$row->nipp'>$row->nipp</option>";
                    }
                    ?>
                 </datalist>
                 <datalist id="data_akses">
                    <?php
                    foreach($akses as $row)
                    {
                        echo "<option value='$row->id'>$row->deskripsi</option>";
                    }
                    ?>
                 </datalist>
                 <script>
                 function autofill(){
                      var nipp =document.getElementById('nipp').value;
                      $.ajax({
                                    url:"<?php echo base_url();?>admin/cari_pegawai",
                                    data:'&nipp='+nipp,
                                    success:function(data){
                                        var hasil = JSON.parse(data);  
                    
                      $.each(hasil, function(key,val){ 
                        document.getElementById('nama').value=val.nama;
                        });
                      }
                                  });
                            
              }
              </script>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal Edit Jabatan-->
  <?php
    foreach($login as $row4){
  ?>
  <div class="modal fade" id="edituserModal<?php echo $row4->username ?>" tabindex="-1" aria-labelledby="editJabatanModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Data Login</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <form autocomplete="off" action="<?php echo base_url(); ?>admin/edit_login" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Username</label>
                          <input type="text" class="form-control" name="username" value="<?php echo $row4->username; ?>" readonly>
                      </div>
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">NIPP</label>
                          <input type="text" class="form-control" name="nipp" value="<?php echo $row4->nipp; ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Nama</label>
                              <input type="text" class="form-control" name="nama" value="<?php echo $row4->nama ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Level Akses</label>
                          <input list="data_akses" type="text" class="form-control" name="level">
                      </div>
                  </div>
                 
                  <div class="form-row">
                      <div class="form-group col-md-5">
                         
                          <input type="hidden" class="form-control" name="waktu_update" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                  </form>
                 <datalist id="data_akses">
                    <?php
                    foreach($akses as $row)
                    {
                        echo "<option value='$row->id'>$row->deskripsi</option>";
                    }
                    ?>
                 </datalist>
                
              </div>
          </div>
      </div>
  </div>
  <?php } ?>    
</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- ./wrapper -->
 
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/ajax.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
</body>
</html>

<script src="<?php echo base_url().'assets/jquery/jquery-2.2.3.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/jquery/jquery-2.2.3.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js'?>"></script>

<script type="text/javascript">

var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo base_url().'admin/list_pengguna'?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

});

</script>