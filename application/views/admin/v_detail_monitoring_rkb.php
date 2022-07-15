  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1>Monitoring Rencana Kerja Bulanan (RKB) PT Prima Terminal Petikemas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Monitoring RKB PT Prima Terminal Petikemas</h3>
  </div>
  <div class="card-body">
  <table class="table">
          <thead>
              <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center">NIPP</th>
                  <th scope="col" style="text-align:center">Nama</th>
                  <th scope="col" style="text-align:center">Jabatan</th>
                  <th scope="col" style="text-align:center">Status Kirim</th>
                  <th scope="col" style="text-align:center">Status Approval</th>
              </tr>
          </thead>
          <tbody>
          <?php 
            $i = 1;
            foreach($divisi as $row){
          ?>
          <tr>        
                    <th sstyle="text-align:center"><?php echo $i; ?></th>
                    <td style="text-align:center"><?php echo $row->nipp; ?></td>
                    <td style="text-align:center"><?php echo $row->nama; ?></td>
                    <td style="text-align:center"><?php echo $row->kd_jabatan; ?></td>
                    <td style="text-align:center"><?php echo $row->status_rkb; ?></td>
                    <td style="text-align:center"><?php echo $row->waktu_rkb; ?></td>
                  </tr>
                  <?php
                    $i++;
            }
                  ?>  
          </tbody>     
      </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
  Monitoring RKB PT Prima Terminal Petikemas
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->
 
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<!-- ./wrapper -->
