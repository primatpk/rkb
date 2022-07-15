  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Divisi PT Prima Terminal Petikemas</h1>
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
            if($this->session->flashdata('tambah_divisi') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('tambah_divisi');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('edit_divisi') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('edit_divisi');
              echo '</div>';
            }
			?>
      <?php   
            if($this->session->flashdata('hapus_divisi') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('hapus_divisi');
              echo '</div>';
            }
			?>
    <h3 class="card-title">Divisi PT Prima Terminal Petikemas</h3>
  </div>
  <div class="card-body">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahDivisiModal"> 
      <i class="fas fa-plus-circle"></i>Tambah Divisi
      </button>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">Kode Divisi</th>
                  <th scope="col" style="text-align:center">Direktorat</th>
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
                foreach($divisi as $row):
            ?>
            <tr>
              <th scope="row" style="text-align:center"><?php echo $i ?></th>
              <td style="text-align:center"><?php echo $row->kd_divisi ?></td>
              <td style="text-align:center"><?php echo $row->kd_direktorat ?></td>
              <td style="text-align:center"><?php echo $row->deskripsi_divisi ?></td></td>
              <td style="text-align:center"><?php echo $row->waktu_update ?></td></td>
              <td style="text-align:center"><?php echo $row->updated_by ?></td></td>
              <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editDivisiModal<?php echo $row->kd_divisi ?>">
              <i class='fa fa-edit'></i></td>
              <td style="text-align:center" onclick="javascript: return confirm('Anda yakin ingin menghapus data ini?')"><a class="btn" href="<?php echo 'hapus_divisi/'.$row->kd_divisi ?>"><i class='fa fa-trash'></i></td>
            </tr>
            <?php
                $i++; endforeach;
            ?>
          </tbody>     
      </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  Divisi PT Prima Terminal Petikemas
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

  <!-- Modal Tambah Kegiatan-->
  <div class="modal fade" id="tambahDivisiModal" tabindex="-1" aria-labelledby="tambahDivisiModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Input Divisi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?php echo base_url(); ?>admin/input_divisi" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-7">
                          <label for="inputJenisUser">Direktorat</label>
                          <select name="kd_direktorat" class="form-control">
                              <option selectrd>Pilih Direktorat</option>
                              <?php foreach($direktorat as $row): ?>
                              <option value="<?php echo $row->kd_direktorat ?>"><?php echo $row->deskripsi_direktorat ?></option>
                              <?php endforeach;?>
                          </select>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Kode Divisi</label>
                              <input type="text" class="form-control" name="kd_divisi" placeholder="Divisi">
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
  
   <!-- Modal Edit Divisi-->
   <?php
    foreach($divisi as $row){
  ?>
   <div class="modal fade" id="editDivisiModal<?php echo $row->kd_divisi ?>" tabindex="-1" aria-labelledby="editDivisiModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Divisi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form action="<?php echo base_url(); ?>admin/edit_divisi" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Kode Divisi</label>
                              <input type="text" class="form-control" name="kd_divisi" value="<?php echo $row->kd_divisi ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-7">
                          <label for="inputJenisUser">Direktorat</label>
                          <input type="text" class="form-control" name="kd_direktorat" value="<?php echo $row->kd_direktorat ?>" readonly>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                              <label for="inputJenisUser">Deskripsi</label>
                              <input type="text" class="form-control" name="deskripsi" value="<?php echo $row->deskripsi_divisi ?>">
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
