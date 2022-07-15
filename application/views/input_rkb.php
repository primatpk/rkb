
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rencana Kerja Bulanan (RKB)</h1>
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
            if($this->session->flashdata('error_input_rkb') !='')
            {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->flashdata('error_input_rkb');
              echo '</div>';
            }
			?>
        <?php 
            if($this->session->flashdata('success_tambah_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('success_tambah_rkb');
              echo '</div>';
            }
				?>
        <?php 
            if($this->session->flashdata('success_kirim_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('success_kirim_rkb');
              echo '</div>';
            }
          ?>
          <?php 
            if($this->session->flashdata('success_edit_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('success_edit_rkb');
              echo '</div>';
            }
          ?>
          
          <h3 class="card-title">Input Rencana Kerja Bulanan</h3>
         
        </div>
        
        <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-2">
                  <label for="inputJenisUser">Bulan : <?php echo date('F') ?></label><br/>
                  <label for="inputJenisUser">Tahun : <?php echo date('Y') ?></label><br/> <label for="inputJenisUser" class=></label>
              </div> 
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Rencana Kerja</th>
                        <th scope="col" style="text-align:center">Target</th>
                        <th scope="col" style="text-align:center">Bobot (%)</th>
                        <th scope="col" style="text-align:center">Edit</th>
                        <th scope="col" style="text-align:center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    $total = 0;
                    foreach($rkb->result() as $row):
                  ?>
                  <tr>
                    <th scope="row" style="text-align:center"><?php echo $i ?></th>
                    <td style="text-align:left"><?php echo $row->uraian ?></td>
                    <td style="text-align:center"><?php echo $row->target, " ", $row->satuan ?></td>
                    <td style="text-align:center"><?php echo $row->bobot ?></td>
                    <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editrkbModal<?php echo $row->id_rkb ?>">
                    <i class='fa fa-edit'></i></td>
                    <td style="text-align:center" onclick="javascript: return confirm('Anda yakin ingin menghapus data ini?')"><a class="btn" href="<?php echo 'hapus_rkb/'.$row->id_rkb ?>"><i class='fa fa-trash'></i></td>
                  <?php
                    $i++;
                    $total = $total+$row->bobot;
                  endforeach;
                  
                  ?>    
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align:center" colspan="3"><b>Total</b></td>
                    <td style="text-align:center"><b><?php echo $total ?></b></td>
                    <td style="text-align:center" colspan="2"></td>
                  </tr>
                </tfoot>
            </table>
            <?php $total2 = $total; ?>
            <form action="<?php echo base_url(); ?>user/kirim_rkb" method="post" enctype="multipart/form-data" onsubmit="return confirm('Anda yakin ingin mengirim data ini?');">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                    <input type="hidden" class="form-control" name="id_approval" value="<?php echo $this->session->userdata('nipp').date('Y').date('m') ?>" readonly>
                     <input type="hidden" class="form-control" name="nipp" value="<?php echo $this->session->userdata('nipp') ?>" readonly>
                     <?php foreach($pegawai as $row) { ?>
                      <input type="hidden" class="form-control" name="nama" value="<?php echo $row->nama ?>" readonly>
                     <input type="hidden" class="form-control" name="kd_jabatan" value="<?php echo $row->kd_jabatan ?>" readonly>
                     <input type="hidden" class="form-control" name="kd_atasan" value="<?php echo $row->kd_atasan ?>" readonly>
                     <?php } ?>
                      <input type="hidden" class="form-control" name="tahun" value="<?php echo date('Y') ?>" readonly>
                      <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m') ?>" readonly>
                      <input type="hidden" class="form-control" name="waktu_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      <input type="hidden" class="form-control" name="total_bobot" value="<?php echo $total ?>" readonly>
                      <?php
                        if($total >= 100)
                        {
                          echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#tambahkegiatanModal' disabled><i class='fas fa-plus-circle'></i>Tambah Kegiatan
                          </button>";
                          
                        }
                        else{
                          echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#tambahkegiatanModal'><i class='fas fa-plus-circle'></i>Tambah Kegiatan
                          </button>";
                        }
                      ?>          
                      <?php
                        if($total < 100 OR $total > 100)
                        {
                          echo "<button type='submit' class='btn btn-primary' disabled>Kirim RKB</button>";
                        }
                        else{
                          echo "<button type='submit' class='btn btn-primary'>Kirim RKB</button>";
                        }
                      ?>
                      </div>
                  </div>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Input Rencana Kerja Bulanan
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

        <!-- Modal Tambah Kegiatan-->
        <div class="modal fade" id="tambahkegiatanModal" tabindex="-1" aria-labelledby="tambahkegiatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>user/input_kegiatan" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Bulan</label>
                                <input type="text" class="form-control" name="bulan_panjang" value="<?php echo date('F') ?>" readonly>
                                <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m') ?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputJenisUser">Tahun</label>
                                <input type="text" class="form-control" name="tahun" value="<?php echo date('Y') ?>" readonly>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <input type="hidden" class="form-control" name="nipp" value="<?php echo $this->session->userdata('nipp') ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                    <input type="hidden" class="form-control" name="id_approval" value="<?php echo $this->session->userdata('nipp').date('Y').date('m') ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputJenisUser">Rencana Kerja</label>
                                <input type="text" class="form-control" name="uraian" placeholder="Rencana Kegiatan">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                    <label for="inputJenisUser">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" placeholder="Bobot">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Target</label>
                                <input type="number" class="form-control" name="target" placeholder="Target">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputJenisUser">Satuan</label>
                                <input type="text" class="form-control" name="satuan" placeholder="Satuan">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" name="waktu_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                            </div>
                        </div>
                        <?php
                        if($total < 100)
                        {
                          echo "<button type='submit' class='btn btn-primary'>Submit</button>";
                        }
                        else{
                          echo "<button type='submit' class='btn btn-primary' disabled>Submit</button>";
                        }
                      ?>
                        </form>    
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal Edit Kegiatan-->
         <?php 
          foreach($rkb->result() as $row2){
         ?>
         <div class="modal fade" id="editrkbModal<?php echo $row2->id_rkb ?>" tabindex="-1" aria-labelledby="tambahkegiatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>user/edit_input_rkb" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                    <input type="text" class="form-control" name="id_rkb" value="<?php echo $row2->id_rkb ?>" readonly>
                            </div>
                           
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputJenisUser">Rencana Kerja</label>
                                <input type="text" class="form-control" name="uraian" value="<?php echo $row2->uraian; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                    <label for="inputJenisUser">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" value="<?php echo $row2->bobot; ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Target</label>
                                <input type="number" class="form-control" name="target" value="<?php echo $row2->target; ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputJenisUser">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="<?php echo $row2->satuan; ?>">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" name="waktu_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                            </div>
                        </div>
                        <button type='submit' class='btn btn-primary'>Submit</button>
                       
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