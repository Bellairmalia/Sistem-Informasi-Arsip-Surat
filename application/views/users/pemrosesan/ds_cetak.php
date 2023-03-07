<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cetak Lembar Disposisi</title>
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

    <h5 align="center"><font size="2">Lembar Disposisi</h5>
    <p>
    <table rules="all" border="1" width="100%">

      <td height ="40" width="25%" colspan="4" align="left"><font size="4"> No. Urut : <b><?php echo $data->no_urut; ?></td>

      <tr>
        <td height ="20"><b> No Surat : </td>
        <td height ="20"><?php echo $data->no_surat; ?></td>
        <td height ="20"><b> No.Agenda : </td>
        <td height ="20"><?php echo $data->no_agenda; ?></td>
      </tr>

      <tr>
        <td height ="20"><b> Asal Surat : </td>
        <td height ="20"><?php echo $data->asal_surat; ?></td>
        <td height ="20"><b> Kepada : </td>
        <td height ="20"><?php echo $data->kepada; ?></td>
      </tr>

      <tr>
        <td height ="20"><b> Tanggal Masuk : </td>
        <td height ="20"><?php echo date('d-m-Y',strtotime($data->tgl_sm)); ?></td>
        <td height ="20"><b> Tanggal Surat : </td>
        <td height ="20"><?php echo date('d-m-Y',strtotime($data->tgl_surat)); ?></td>
      </tr>

      <tr>
        <td height ="50"><b> Perihal : </td>
        <td height ="50" colspan="3"><?php echo $data->perihal; ?></td>
      </tr>

      <tr>
        <td height ="20"><b> Diteruskan : </td>
        <td height ="20"><?php echo $data->nama_bagian; ?></td>
        <td height ="20"><b> Tanggal Disposisi : </td>
        <td height ="20"><?php echo date('d-m-Y',strtotime($data->tgl_disposisi)); ?></td>
      </tr>

      <tr>
        <td height ="50"><b> Isi Disposisi : </td>
        <td height ="50" colspan="3"><?php echo $data->catatan; ?></td>
      </tr>
     
    </table>

  </body>
</html>
