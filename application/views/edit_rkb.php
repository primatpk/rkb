
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
            if($this->session->flashdata('edit_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('edit_rkb');
              echo '</div>';
            }
			  ?>
        <?php 
            if($this->session->flashdata('sukses_tambah_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('sukses_tambah_rkb');
              echo '</div>';
            }
				?>
          <h3 class="card-title">Input Rencana Kerja Bulanan</h3>
        </div>
        <div class="card-body">
           
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Rencana Kerja</th>
                        <th scope="col" style="text-align:center">Target</th>
                        <th scope="col" style="text-align:center">Satuan</th>
                        <th scope="col" style="text-align:center">Bobot (%)</th>
                        <th scope="col" style="text-align:center">Edit</th>
                        <th scope="col" style="text-align:center">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                 <?php
                    $i = 1;
                    $total = 0;
                    foreach($edit->result() as $row):
                 ?>
                  <tr>
                    <th scope="row" style="text-align:center"><?php echo $i ?></th>
                    <td style="text-align:left"><?php echo $row->uraian ?></td>
                    <td style="text-align:center"><?php echo $row->target ?></td>
                    <td style="text-align:center"><?php echo $row->satuan ?></td>
                    <td style="text-align:center"><?php echo $row->bobot ?></td>
                    <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editrkbModal<?php echo $row->id_rkb ?>">
                    <i class='fa fa-edit'></i></td>
                    <td style="text-align:center" onclick="javascript: return confirm('Anda yakin ingin menghapus data ini?')"><a class="btn" href="<?php echo base_url().'user/hapus_rkb2/'.$row->id_rkb ?>"><i class='fa fa-trash'></i></td>
                    </tr>
                  <?php $total = $total + $row->bobot; $i++; endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align:center" colspan="4"><b>Total</b></td>
                    <td style="text-align:center" ><b><?php echo $total ?></b></td>
                    <td style="text-align:center" colspan="2"></td>
                  </tr>
                 
                </tfoot>
            </table>
            <label>Keterangan: <?php 
            foreach($keterangan->result() as $row5){ 
              echo $row5->keterangan; 
              } ?></label>
            <form action="<?php echo base_url(); ?>user/kirim_rkb2" method="post" enctype="multipart/form-data" onsubmit="return confirm('Anda yakin ingin mengirim data ini?');">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                    <input type="hidden" class="form-control" name="id_approval" value="<?php echo $this->session->userdata('nipp').date('Y').date('m') ?>" readonly>
                     
                      <input type="hidden" class="form-control" name="waktu_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      <input type="hidden" class="form-control" name="total_bobot" value="" readonly>
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
                          echo "<button type='submit' class='btn btn-primary' disabled>Kirim</button>";
                        }
                        else{
                          echo "<button type='submit' class='btn btn-primary'>Kirim</button>";
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
                        <form action="<?php echo base_url(); ?>user/tambah_kegiatan" method="post" enctype="multipart/form-data">
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
                        if($total < 100 OR $total > 100)
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
            foreach($edit->result() as $row2){
        ?>
        <div class="modal fade" id="editrkbModal<?php echo $row2->id_rkb ?>" tabindex="-1" arias-labelledby="tambahkegiatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>user/edit_kegiatan" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Bulan</label>
                                <input type="text" class="form-control" name="bulan_panjang" value="<?php echo date('F') ?>" readonly>
                                <input type="hidden" class="form-control" name="bulan" value="<?php echo date('m') ?>" readonly>
                                <input type="hidden" class="form-control" name="id_rkb" value="<?php echo $row2->id_rkb ?>" readonly>
                                <input type="hidden" class="form-control" name="id_approval" value="<?php echo $row2->id_approval ?>" readonly>
                                
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputJenisUser">Tahun</label>
                                <input type="text" class="form-control" name="tahun" value="<?php echo date('Y') ?>" readonly>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputJenisUser">Rencana Kerja</label>
                                <input type="text" class="form-control" name="uraian" value="<?php echo $row2->uraian ?>">
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-3">
                                <label for="inputJenisUser">Target</label>
                                <input type="number" class="form-control" name="target" value="<?php echo $row2->target ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="inputJenisUser">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="<?php echo $row2->satuan ?>">
                            </div>
                            <div class="form-group col-md-3">
                                    <label for="inputJenisUser">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" value="<?php echo $row2->bobot ?>">
                            </div>
                            
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <input type="hidden" class="form-control" name="waktu_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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