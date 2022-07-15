  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-10">
            <h1>Aplikasi Rencana Kerja Bulanan (RKB) PT Prima Terminal Petikemas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-10">
          <?php
            foreach($login as $row4)
        ?>
          <form autocomplete="off" action="<?php echo base_url(); ?>admin/edit_login" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-2">
                          <label for="inputJenisUser">Username</label>
                          <input type="text" class="form-control" name="username" value="<?php echo $row4->username; ?>" readonly>
                      </div>
                      <div class="form-group col-md-2">
                          <label for="inputJenisUser">NIPP</label>
                          <input type="text" class="form-control" name="nipp" value="<?php echo $row4->nipp; ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                              <label for="inputJenisUser">Nama</label>
                              <input type="text" class="form-control" name="nama" value="<?php echo $row4->nama ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                              <label for="inputJenisUser">Password Default</label>
                              <input type="text" class="form-control" name="password" value="Primatpk" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-2">
                         
                          <input type="hidden" class="form-control" name="waktu_update" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      </div>
                      <div class="form-group col-md-2">
                         
                          <input type="hidden" class="form-control" name="updated_by" value="<?php  
                                echo $this->session->userdata('username'); ?>" readonly>
                      </div>
                  </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
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
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 