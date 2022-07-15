
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
            if($this->session->flashdata('error_upload') !='')
            {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->flashdata('error_upload');
              echo '</div>';
            }
          ?>
           <?php 
            if($this->session->flashdata('sukses_input_realisasi') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('sukses_input_realisasi');
              echo '</div>';
            }
          ?>
           
          <h3 class="card-title">Edit Realisasi Rencana Kerja Bulanan</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Rencana Kerja</th>
                        <th scope="col" style="text-align:center">Bobot (%)</th>
                        <th scope="col" style="text-align:center">Target</th>
                        <th scope="col" style="text-align:center">Realisasi</th>
                        <th scope="col" style="text-align:center">Skor (%)</th>
                        <th scope="col" style="text-align:center">Nilai</th>
                        <th scope="col" style="text-align:center">Nilai RKB (%)</th>
                        <th scope="col" style="text-align:center">File</th>
                        <th scope="col" style="text-align:center">Edit</th>
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
                    <td style="text-align:center"><?php echo $row->bobot ?></td>
                    <td style="text-align:center"><?php echo $row->target ?></td>
                    <td style="text-align:center"><?php echo $row->realisasi ?></td>
                    <td style="text-align:center"><?php echo $row->skor ?></td>
                    <td style="text-align:center"><?php echo $row->nilai ?></td>
                    <td style="text-align:center"><?php echo $row->nilai_rkb ?></td>
                    <td style="text-align:center"><a target="_blank" href="<?php echo base_url()."assets/bukti_realisasi/".$row->bukti_realisasi ?>">Bukti Realisasi</a></td>
                    <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editrealisasiModal<?php echo $row->id_rkb ?>">
                    <i class='fa fa-edit'></i></td>
                    </tr>
                  <?php $total = $total + $row->nilai_rkb; $i++; endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align:center" colspan="7"><b>Total</b></td>
                    <td style="text-align:center"><b><?php echo $total ?></b></td>
                    <td style="text-align:center" colspan="2"></td>
                  </tr>
                  <tr>
                    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; background: #D9D9D9" colspan="7"><b>Kategori</b></td>
                    <td style="border: 1px solid #dddddd; text-align: left; padding: 10px; background: #D9D9D9" colspan="3"><b><?php 
                      if($total > 360){
                        echo "ISTIMEWA (A)";
                      }
                      elseif($total>330 AND $total <=360){
                        echo "SANGAT BAIK (B)";
                      }
                      elseif($total>280 AND $total <=330){
                        echo "BAIK (C)";
                      }
                      elseif($total>250 AND $total <=280){
                        echo "PENGEMBANGAN (D)";
                      }
                      else{
                        echo "KURANG (E)";
                      }
                    ?></b></td>
                  </tr>
                </tfoot>
            </table>
            <label>Keterangan: <?php 
            foreach($keterangan->result() as $row5){ 
              echo $row5->keterangan_realisasi; 
              } ?></label>
            <form action="<?php echo base_url(); ?>user/kirim_realisasi2" method="post" enctype="multipart/form-data" onsubmit="return confirm('Anda yakin ingin mengirim data ini?');">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                    <input type="hidden" class="form-control" name="id_approval" value="<?php
                        $id_approval = "";
                        foreach($edit->result() as $row2){
                        $id_approval = $row2->id_approval;

                        } 
                        echo $id_approval;
                        ?>" readonly>
                     <input type="hidden" class="form-control" name="nilai_rkb" value="<?php echo $total; ?>" readonly>
                      <input type="hidden" class="form-control" name="waktu_realisasi" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                        <?php
                        if($total <= 0)
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

        <!-- Modal Edit Kegiatan-->
        <?php
            foreach($edit->result() as $row2){
        ?>
        <div class="modal fade" id="editrealisasiModal<?php echo $row2->id_rkb ?>" tabindex="-1" arias-labelledby="tambahkegiatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <?php echo form_open_multipart('user/update_realisasi2'); ?>
                        
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
                                <input type="text" class="form-control" name="uraian" value="<?php echo $row2->uraian ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                    <label for="inputJenisUser">Bobot</label>
                                    <input type="text" class="form-control" name="bobot" value="<?php echo $row2->bobot ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Target</label>
                                <input type="text" class="form-control" name="target" value="<?php echo $row2->target ?>" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputJenisUser">Satuan</label>
                                <input type="text" class="form-control" name="satuan" value="<?php echo $row2->satuan ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                    <label for="inputJenisUser">Realisasi</label>
                                    <input type="text" class="form-control" name="realisasi" value="<?php echo $row2->realisasi ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label for="inputJenisUser">Upload Bukti (PDF, JPG, PNG, DOC, XLS, PPT). Maksimum 2MB</label>
                                    <input type="file" class="form-control" name="bukti_realisasi">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                
                                <input type="hidden" class="form-control" name="waktu_realisasi" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d h:i:s") ?>" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <?php echo form_close(); ?>     
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->