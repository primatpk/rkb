
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Rencana Kerja Bulanan (RKB)</h1>
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
            elseif($this->session->flashdata('edit_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('edit_rkb');
              echo '</div>';
            }
				?>
          <h3 class="card-title">Detail Rencana Kerja Bulanan</h3>
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
                    </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1;
                  $total = 0;
                  foreach($detail as $row):
                ?>
                  <tr>
                    <th scope="row" style="text-align:center"><?php echo $i ?></th>
                    <td style="text-align:left"><?php echo $row->uraian ?></td>
                    <td style="text-align:center"><?php echo $row->target ?></td>
                    <td style="text-align:center"><?php echo $row->satuan ?></td>
                    <td style="text-align:center"><?php echo $row->bobot ?></td>
                    <td style="text-align:center"><a class="btn" data-toggle="modal" data-target="#editrkbModal<?php echo $row->id_rkb ?>">
                    <i class='fa fa-edit'></i></td>
                  
                  </tr>
                  <?php
                    $i++;
                    $total = $total+$row->bobot;
                  endforeach;
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align:center" colspan="4"><b>Total</b></td>
                    <td style="text-align:center"><b><?php echo $total ?></b></td>
                    <td style="text-align:center"></td>
                  </tr>
                </tfoot>
            </table>
            <form action="<?php echo base_url(); ?>user/approve_rkb" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <input type="hidden" class="form-control" name="id_approval" value="<?php
                    $id_approval = "";
                    foreach($detail as $row2){
                      $id_approval = $row2->id_approval;

                    } 
                       echo $id_approval;
                    ?>" readonly>
                      <input type="hidden" class="form-control" name="waktu_approve_rkb" value="<?php  
                                date_default_timezone_set('Asia/Jakarta');
                                echo date("Y-m-d H:i:s") ?>" readonly>
                      <label for="inputJenisUser">Keterangan (Wajib)</label>
                      <textarea class="form-control" name="keterangan"></textarea><br/>
                      <script src="<?php echo base_url(); ?>assets/jquery/jquery-2.2.3.min.js"></script>
                      <script type="text/javascript">
                          $(function () {
                              $("#btnTolak").click(function () {
                                  var result = confirm("Anda yakin mengirim kembali RKB ini ?");

                                  if (result == true) {
                                      return true;
                                  }

                                  else {
                                      return false;
                                  }
                              });
                          });

                          $(function () {
                              $("#btnSetuju").click(function () {
                                  var result = confirm("Anda yakin menyetujui RKB ini ?");

                                  if (result == true) {
                                      return true;
                                  }

                                  else {
                                      return false;
                                  }
                              });
                          });
                      </script>
                      <?php 
                        if($total == 100){
                      ?>  
                      <button type="submit" name="setuju" class="btn btn-primary" id="btnSetuju">Setuju</button>                      
                      <button type="submit" name="tolak" class="btn btn-secondary" id="btnTolak">Revisi</button>
                      <?php 
                        }else{
                      ?>
                      <button type="submit" name="setuju" class="btn btn-primary" id="btnSetuju" disabled>Setuju</button>                      
                      <button type="submit" name="tolak" class="btn btn-secondary" id="btnTolak" disabled>Revisi</button>
                      <?php } ?>
                      </div>
                  </div>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Detail Rencana Kerja Bulanan
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <!-- Modal Edit Kegiatan-->
      <?php
            foreach($detail as $row2){
        ?>
        <div class="modal fade" id="editrkbModal<?php echo $row2->id_rkb ?>" tabindex="-1" arias-labelledby="tambahkegiatanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url(); ?>user/edit_kegiatan2" method="post" enctype="multipart/form-data">
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