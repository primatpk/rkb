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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Jabatan PT Prima Terminal Petikemas</h1>
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
			?>
      <?php   
            if($this->session->flashdata('tambah_jabatan') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('tambah_jabatan');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('edit_jabatan') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('edit_jabatan');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('hapus_jabatan') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('hapus_jabatan');
              echo '</div>';
            }
            ?>
    <h3 class="card-title">Jabatan PT Prima Terminal Petikemas</h3>
  </div>
  <div class="card-body">
      <table id="table" class="display" cellspacing="0" width="100%">
          <thead>
              <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Tahun</th>
                  <th scope="col" style="text-align:center">Bulan</th>
                  <th scope="col" style="text-align:center">Nama</th>
                  <th scope="col" style="text-align:center">Divisi</th>
                  <th scope="col" style="text-align:center">Jabatan</th>
                  <th scope="col" style="text-align:center">Status Kirim</th>
                  <th scope="col" style="text-align:center">Status RKB</th>
              </tr>
          </thead>
          <tbody style="text-align:center"> </tbody>
          <tfoot>
              <tr>
              <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Tahun</th>
                  <th scope="col" style="text-align:center">Bulan</th>
                  <th scope="col" style="text-align:center">Nama</th>
                  <th scope="col" style="text-align:center">Divisi</th>
                  <th scope="col" style="text-align:center">Jabatan</th>
                  <th scope="col" style="text-align:center">Status Kirim</th>
                  <th scope="col" style="text-align:center">Status Realisasi</th>
              </tr>
          </tfoot>     
      </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Input Jabatan
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

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
            "url": "<?php echo base_url().'admin/list_realisasi'?>",
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