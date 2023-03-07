<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
        <div class="panel panel-flat">
        <div class="panel-heading">
          <h5 class="panel-title"><i class="icon-folder-download2"></i> Data Surat Masuk</h5>
          <hr style="margin:0px;">
          <div class="heading-elements">
            <ul class="icons-list">
              <li><a data-action="collapse"></a></li>
            </ul>
          </div>
        </div>

        <table class="table datatable-basic" width="100%">
          <thead>
            <tr>
              <th width="30px;">No.</th>
              <th>No surat</th>
              <th>Tgl Surat</th>
              <th>Perihal</th>
              
              <th>disposisi</th>
              <th class="text-center" width="170"></th>
            </tr>
          </thead>
         <tbody>
              <?php
              $no = 1;
              foreach ($sm->result() as $baris) {
              ?>
                <tr>
                  <td><?php echo $no.'.'; ?></td>
                  <!-- <td><?php echo $baris->no_surat; ?></td>
                  <td><?php echo $baris->tgl_ns; ?></td> -->
                  <td><?php echo $baris->no_surat; ?></td>
                  <td><?php echo $baris->tgl_surat; ?></td>
                  <!-- <td><?php echo $baris->pengirim; ?></td> -->
                  <td><?php echo $baris->perihal; ?></td>
                  
                  <td><?php
                        if ($baris->disposisi == 1) {?>
                            <button type="button" class="btn btn-success"><i class="icon-checkmark4"></i></button>
                      <?php
                        }?>
                  </td>
                  <td>
                    <a href="users/sm/d/<?php echo $baris->id_sm; ?>" class="btn btn-default btn-xs"><i class="icon-eye"></i></a>
                    
                    <?php
                    if ($user->row()->level == 'admin') { ?>
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
    </div>
    

