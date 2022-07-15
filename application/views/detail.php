
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
          <h3 class="card-title">Detail Rencana Kerja Bulanan</h3>
        </div>
        <div class="card-body">
        <a class="btn btn-primary" href="<?php echo base_url().'user/riwayat_rkb' ?>">Kembali</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Rencana Kerja</th>
                        <th scope="col" style="text-align:center">Target</th>
                        <th scope="col" style="text-align:center">Bobot (%)</th>
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
                    <td style="text-align:center"><?php echo $row->target." ".$row->satuan ?></td>
                    <td style="text-align:center"><?php echo $row->bobot ?></td>
                    <td style="text-align:center" ></td>
                  
                  </tr>
                  <?php
                    $i++;
                    $total = $total+$row->bobot;
                  endforeach;
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td style="text-align:center" colspan="3"><b>Total</b></td>
                    <td style="text-align:center"><b><?php echo $total ?></b></td>
                    <td style="text-align:center"></td>
                  </tr>
                </tfoot>
            </table>
            <a target="_blank" href="<?php echo base_url(); ?>user/print_rkb/<?php
                    $id_approval = "";
                    foreach($detail  as $row2){
                      $id_approval = $row2->id_approval;

                    } 
                       echo $id_approval;
                    ?>" class="btn btn-primary">Cetak</a>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Detail Rencana Kerja Bulanan
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->