
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aplikasi Rencana Kerja Bulanan (RKB)</h1>
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
            elseif($this->session->flashdata('pass_beda') !='')
            {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->flashdata('pass_beda');
              echo '</div>';
            }
            elseif($this->session->flashdata('sukses') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('sukses');
              echo '</div>';
            }
            elseif($this->session->flashdata('gagal') !='')
            {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->flashdata('gagal');
              echo '</div>';
            }
          ?>
          <h3 class="card-title">Ganti Password</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url(); ?>user/proses_ganti_password" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $this->session->userdata('username') ?>" readonly>
                  </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Password Lama</label>
                        <input type="password" class="form-control" name="password_lama">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="password_baru">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Ulangi Password Baru</label>
                        <input type="password" class="form-control" name="ulang_pass_baru">
                    </div>
                  </div>
                  <button type="submit" name="tolak" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        Ganti Password
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->