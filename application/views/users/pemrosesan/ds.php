<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <?php
    echo $this->session->flashdata('msg');
    ?>
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="icon-folder2"></i> Data Disposisi Surat</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>

                <?php
                if ($user->row()->level == 'admin') { ?>
                    <br>
                    <a href="users/ds/t" class="btn btn-primary">+ <i class="icon-folder2"></i> Disposisi Baru</a>
                <?php
                } ?>
        </div>

        <table class="table datatable-basic" width="100%">
          <thead>
            <tr>
              <th width="30px;">No.</th>
              <th>No urut</th>
              <th>No Surat</th>
              <th>Nama Bagian</th>
              <th>Catatan</th>
              <th>Tanggal Disposisi</th>
              <th class="text-center" width="170"></th>
            </tr>
          </thead>
          <tbody>
              <?php
              $no = 1;
              foreach ($ds->result() as $baris) {
              ?>
                <tr>
                  <td><?php echo $no.'.'; ?></td>
                  <td><?php echo $baris->no_urut; ?></td>
                  <td><?php echo $baris->no_surat; ?></td>
                  <td><?php echo $baris->nama_bagian; ?></td>
                  <td><?php echo $baris->catatan; ?></td>
                  <td><?php echo date('d-m-Y',strtotime($baris->tgl_disposisi));; ?></td>
                  
                  <td>
                    <a href="users/ds/d/<?php echo $baris->id_disposisi; ?>" class="btn btn-default btn-xs"><i class="icon-eye"></i></a>
                   <a href="users/ds_cetak/<?php echo $baris->id_disposisi; ?>" target="_blank" class="btn btn-primary btn-xs"><i class="icon-printer"></i></a>
                    
                    <?php
                    if ($user->row()->level == 'admin') { ?>
                    <a href="users/ds/e/<?php echo $baris->id_disposisi; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a>
                    <a href="users/ds/h/<?php echo $baris->id_disposisi; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
					 
                    <?php
                    } ?>
                  </td>
                </tr>
              <?php
              $no++;
              } ?>
          </tbody>
        </table>
      </div>
      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
