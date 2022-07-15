<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cetak RKB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/login/images/icons/logo-ptp.png"/>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 10px;
  background: #0070C0;
  color: white;
}
</style>
<style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 297mm;
        min-height: 210mm;
        padding: 3mm;
        margin: 2mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: landscape;
        margin: 0;
    }
    @media print {
        html, body {
            width: 297mm;
            height: 210mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
</head>
<body>
<div class="book">
<div class="page">
<h3 align="center">Rencana Kerja Bulanan</h3>
<h3 align="center">PT Prima Terminal Petikemas</h3>
<h3 align="center">Bulan <?php
//perubahan bulan masih bingung
foreach($bulan as $roww)
  if($roww->bulan==1){
    echo "Januari ".$roww->tahun;
  }
  elseif($roww->bulan==2){
    echo "Februari ".$roww->tahun;
  }
  elseif($roww->bulan==3){
    echo "Maret ".$roww->tahun;
  }
  elseif($roww->bulan==4){
    echo "April ".$roww->tahun;
  }
  elseif($roww->bulan==5){
    echo "Mei ".$roww->tahun;
  }
  elseif($roww->bulan==6){
    echo "Juni ".$roww->tahun;
  }
  elseif($roww->bulan==7){
    echo "Juli ".$roww->tahun;
  }
  elseif($roww->bulan==8){
    echo "Agustus ".$roww->tahun;
  }
  elseif($roww->bulan==9){
    echo "September ".$roww->tahun;
  }
  elseif($roww->bulan==10){
    echo "Oktober ".$roww->tahun;
  }
  elseif($roww->bulan==11){
    echo "November ".$roww->tahun;
  }
  elseif($roww->bulan==22){
    echo "Desember ".$roww->tahun;
  }
  else{
    echo "";
  }
;

?>
</h3>
<table>
<thead>
  <tr>
    <th>No</th>
    <th>Rencana Kerja</th>
    <th>Bobot (%)</th>
    <th>Target (T)</th>
    <th>Realisasi (R)</th>
    <th>Skor (R/T)</th>
    <th>Nilai</th>
    <th>Nilai RKB</th>
  </tr>
</thead>
<tbody>

  <tr>
  <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 5%">1</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 35%">2</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">3</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">4</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">5</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">6</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">7</td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 2px; background: #FFE699; width: 10%">8</td>
  </tr>
  <?php
    $i = 1;
    foreach($detail as $row):
?>
  <tr>
  <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 5%"><?php echo $i; ?></td>
    <td style="border: 1px solid #dddddd; text-align: left; padding: 10px; width: 35%"><?php echo $row->uraian; ?></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"><?php echo $row->bobot; ?></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"><?php echo $row->target.' '.$row->satuan; ?></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; width: 10%"></td>
  </tr>
  <?php $i++;
    endforeach;
  ?>
  <tr>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; background: #D9D9D9" colspan="7"><b>Total</b></td>
    <td style="border: 1px solid #dddddd; text-align: center; padding: 10px; background: #D9D9D9"></td>
  </tr>
 
</tbody>
<tfoot>
<tr><td></td>
</tr>
<tr>
<td style="solid #dddddd; text-align: right; padding: 10px;" colspan="7">Medan, &nbsp;&nbsp;<?php echo date('d F Y') ?></td>
</tr>
<tr>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="1"></td>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="4">Dibuat Oleh</td>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="2">Disetujui Oleh</td>
</tr>
<tr>
<td style="solid #dddddd; text-align: right; padding: 10px;"></td>
</tr>
<tr>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="1"></td>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="4">Ttd</td>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="2">Ttd</td>
</tr>
<tr>
<td style="solid #dddddd; text-align: right; padding: 10px;"></td>
</tr>
<tr>
<?php
    foreach($pegawai as $row2){
?>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="1"></td>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="4"><b><?php echo $row2->nama ?></b></td><?php }?>
<?php
    foreach($nama_atasan as $row4){
?>
<td style="solid #dddddd; text-align: Left; padding: 10px; " colspan="2"><b><?php echo $row4->nama ?></b></td><?php }?>
</tr>
<tr>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="1"></td>
<?php foreach($jabatan as $row3){ ?>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="4"><?php echo $row3->deskripsi ?></td><?php } 
foreach($atasan as $row4){
?>
<td style="solid #dddddd; text-align: Left; padding: 10px;" colspan="3"><?php echo $row4->deskripsi ?></td><?php } ?>
</tr>

</tfoot>
</table>
</div>
</div>
</body>
</html>
<script type="text/javascript">window.print();</script>