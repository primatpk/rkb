
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
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('error');
              echo '</div>';
            }
				?>
        <?php 
            if($this->session->flashdata('setuju_rkb') !='')
            {
              echo '<div class="alert alert-info" role="alert">';
              echo $this->session->flashdata('setuju_rkb');
              echo '</div>';
            }
				?>
        <?php 
            if($this->session->flashdata('tolak_rkb') !='')
            {
              echo '<div class="alert alert-danger" role="alert">';
              echo $this->session->flashdata('tolak_rkb');
              echo '</div>';
            }
				?>
          <h3 class="card-title">Approval Rencana Kerja Bulanan <?php echo date('Y'); ?></h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Nama</th>
                        <th scope="col" style="text-align:center">Bulan</th>
                        <th scope="col" style="text-align:center">Status</th>
                        <th scope="col" style="text-align:center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach($approval->result() as $row):
                ?>
                  <tr>
                    <th scope="row" style="text-align:center"><?php echo $i ?></th>
                    <td style="text-align:left"><?php echo $row->nama?></td>
                    <td style="text-align:center"><?php 
                    if($row->bulan==1){
                      echo "Januari ".$row->tahun;
                    }
                    elseif($row->bulan==2){
                      echo "Februari ".$row->tahun;
                    }
                    elseif($row->bulan==3){
                      echo "Maret ".$row->tahun;
                    }
                    elseif($row->bulan==4){
                      echo "April ".$row->tahun;
                    }
                    elseif($row->bulan==5){
                      echo "Mei ".$row->tahun;
                    }
                    elseif($row->bulan==6){
                      echo "Juni ".$row->tahun;
                    }
                    elseif($row->bulan==7){
                      echo "Juli ".$row->tahun;
                    }
                    elseif($row->bulan==8){
                      echo "Agustus ".$row->tahun;
                    }
                    elseif($row->bulan==9){
                      echo "September ".$row->tahun;
                    }
                    elseif($row->bulan==10){
                      echo "Oktober ".$row->tahun;
                    }
                    elseif($row->bulan==11){
                      echo "November ".$row->tahun;
                    }
                    elseif($row->bulan==12){
                      echo "Desember ".$row->tahun;
                    }
                    else{
                      echo "";
                    } ?></td>
                    <td style="text-align:center"><?php 
                    if($row->status_rkb == "0")
                    {
                        echo "Belum Disetujui";
                    }
                    else{
                    echo "Disetujui"; }
                    ?>
                    </td>
                    <td style="text-align:center"><a href="<?php echo base_url() ?>user/detail_rkb/<?php echo $row->id_approval ?>">Detail</a></td>
                    <?php
                     $i++;
                   endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Approval Rencana Kerja Bulanan
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->