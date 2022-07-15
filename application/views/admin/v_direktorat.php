  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Direktorat PT Prima Terminal Petikemas</h1>
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
            if($this->session->flashdata('tambah_direktorat') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('tambah_direktorat');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('edit_direktorat') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('edit_direktorat');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('hapus_direktorat') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('hapus_direktorat');
              echo '</div>';
            }
			?>
    <h3 class="card-title">Direktorat PT Prima Terminal Petikemas</h3>
  </div>
  <div class="card-body">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahdirektoratModal"> 
      <i class="fas fa-plus-circle"></i>Tambah Direktorat
      </button>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Kode Direktorat</th>
                  <th scope="col" style="text-align:center">Deskripsi</th>
                  <th scope="col" style="text-align:center">Waktu Update</th>
                  <th scope="col" style="text-align:center">Diupdate Oleh</th>
                  <th scope="col" style="text-align:center">Edit</th>
                  <th scope="col" style="text-align:center">Hapus</th>
              </tr>
          </thead>
          <tbody>
            <?php
                $i = 1;
                foreach($direktorat as $row):
            ?>
            <tr>
              <th scope="row" style="text-align:center"><?php echo $i ?></th>
              <td style="text-align:center"><?php echo $row->kd_direktorat ?></td>
              <td style="text-align:center"><?php echo $row->deskripsi_direktorat ?></td></td>
              <td style="text-align:center"><?php echo $row->waktu_update ?></td></td>
              <td style="text-align:center"><?php echo $row->updated_by ?></td></td>
              <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editDirektoratModal<?php echo $row->kd_direktorat ?>">
              <i class='fa fa-edit'></i></td>
              <td style="text-align:center" onclick="javascript: return confirm('Anda yakin ingin menghapus data ini?')"><a class="btn" href="<?php echo 'hapus_direktorat/'.$row->kd_direktorat ?>"><i class='fa fa-trash'></i></td>
            </tr>
            <?php
                $i++; endforeach;
            ?>
          </tbody>     
      </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Input Rencana Kerja Bulanan
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

  <!-- Modal Tambah Direktorat-->
  <div class="modal fade" id="tambahdirektoratModal" tabindex="-1" aria-labelledby="tambahdirektoratModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Input Direktorat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?php echo base_url(); ?>admin/input_direktorat" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Kode Direktorat</label>
                          <input type="text" class="form-control" name="kd_direktorat" placeholder="Kode Direktorat">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Deskripsi</label>
                              <input type="text" class="form-control" name="deskripsi" placeholder="Deskpripsi">
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
              </div>
          </div>
      </div>
  </div>

  <!-- Modal Edit Direktorat-->
  <?php
    foreach($direktorat as $row){
  ?>
  <div class="modal fade" id="editDirektoratModal<?php echo $row->kd_direktorat ?>" tabindex="-1" aria-labelledby="editdirektoratModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Direktorat</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?php echo base_url(); ?>admin/edit_direktorat" method="post" enctype="multipart/form-data">
                 
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label for="inputJenisUser">Kode Direktorat</label>
                          <input type="text" class="form-control" name="kd_direktorat" value="<?php echo $row->kd_direktorat ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Deskripsi</label>
                              <input type="text" class="form-control" name="deskripsi" value="<?php echo $row->deskripsi_direktorat ?>">
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
