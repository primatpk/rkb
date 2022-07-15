
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
          <h3 class="card-title">Realisasi Rencana Kerja Bulanan</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center">No</th>
                        <th scope="col" style="text-align:center">Bulan</th>
                        <th scope="col" style="text-align:center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                    foreach($real as $row):
                ?>
                  <tr>
                    <th scope="row" style="text-align:center"><?php echo $i ?></th>
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
                    }
                    ?></td>
                    
                    <td style="text-align:center">
                    <?php echo "<a href='".base_url()."user/input_realisasi/".$row->id_approval."'>Input Realisasi</a>"; 
                       
                    ?>
                    
                    </td>
                    <?php
                     $i++;
                   endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        Realisasi Rencana Kerja Bulanan
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->