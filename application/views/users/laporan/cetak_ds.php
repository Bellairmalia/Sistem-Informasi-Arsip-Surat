<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Disposisi</title>
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

    <h5 align="center"><font size="2">Laporan Disposisi</h5>
    <p>
    <table rules="all" border="1"width="100%">
      <tr>
        <th width="1%">No</th>
        <th width="20%">No.Urut</th>
        <th width="10%">Tgl.Disposisi</th>
        <th width="19%">Nomor Surat</th>
        <th width="10%">Nama Bagian</th>
        <th width="20%">Catatan</th>
      </tr>
      <?php
      $no=1;
      foreach ($sql->result() as $baris) {?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $baris->no_urut; ?></td>
          <td><?php echo date('d-m-Y',strtotime($baris->tgl_disposisi)); ?></td>
          <td><?php echo $baris->no_surat; ?></td>
          <td><?php echo $baris->nama_bagian; ?></td>
          <td><?php echo $baris->catatan; ?></td>
        </tr>
      <?php
      $no++;
      } ?>
    </table>

  </body>
</html>
