<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Surat Masuk</title>
    <base href="<?php echo base_url();?>"/>
  </head>
  <body onload="window.print()">

    <table border="0" width="100%">
      <tr>
        <td width="50">
          <img src="foto/pusri.png" alt="logo1" width="50">
        </td>
        <td align="center">
          <h5><font size="3">PT.PUPUK SRIWIJAYA (PERSERO) TBK
            <p>Jl.May Zen, Kalidoni, Kec.Kalidoni, Kota Palembang, Sumatera Selatan 30118.</p></font></h5>
        </td>
        
      </tr>
    </table>

    <hr>

    <h5 align="center"><font size="2">Laporan Surat Masuk</h5>
    <p>
    <table rules="all" border="1" width="100%">
      <tr>
        <th width="1%">No</th>
          <th width="10%">Tgl Surat</th>
          <th width="15%">No Surat</th>
          <th width="13%">Tgl Surat Masuk</th>
          <th width="15%">Asal Surat</th>
          <th width="14%">Kepada</th>
          <th width="10%">Klasifikasi</th>
          <th width="20%">Perihal</th>
      </tr>
      <?php
      $no=1;
      foreach ($sql->result() as $baris) {?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo date('d-m-Y',strtotime($baris->tgl_surat)); ?></td>
          <td><?php echo $baris->no_surat; ?></td>
          <td><?php echo date('d-m-Y',strtotime($baris->tgl_sm)); ?></td>
          <td><?php echo $baris->asal_surat; ?></td>
          <td><?php echo $baris->kepada; ?></td>
          <td><?php echo $baris->klasifikasi; ?></td>
          <td><?php echo $baris->perihal; ?></td>
        </tr>
      <?php
      $no++;
      } ?>
    </table>

  </body>
</html>
