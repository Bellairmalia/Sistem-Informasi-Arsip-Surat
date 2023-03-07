<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/core/app.js"></script>


<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-folder-upload2"></i> Edit Surat Keluar</legend>

                <?php if($this->session->flashdata('gagal')){ ?>  
          <div class="alert alert-danger alert-dismissible " role="alert" style="margin-top: 10px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Gagal !</strong> <?php echo $this->session->flashdata('gagal'); ?>
          </div>
        <?php } ?>

        <?php if($this->session->flashdata('sukses')){ ?>  
          <div class="alert alert-success alert-dismissible " role="alert" style="margin-top: 10px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>Sukses !</strong> <?php echo $this->session->flashdata('sukses'); ?>
          </div>
        <?php } ?>
        
                <div class="msg"></div>
                <form class="form-horizontal" action="" method="post">
                   <input type="hidden" name="id_sk" class="form-control" value="<?php echo $query->id_sk; ?>" placeholder="" required>
                  <div class="form-group">
                      <label class="control-label col-lg-3">No. Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Keluar</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_sk" class="form-control daterange-single" id="tgl_sk" value="<?php echo $query->tgl_sk; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
                            <input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Dari</label>
                      <div class="col-lg-9">
                            <input type="text" name="dari" id="dari" class="form-control" value="<?php echo $query->dari; ?>" placeholder="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tembusan</label>
                      <div class="col-lg-9">
                            <input type="text" name="tembusan" id="tembusan" class="form-control" value="<?php echo $query->tembusan; ?>" placeholder="" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
                            <input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3"><b>Lampiran</b></label>
                      <div class="col-lg-12">
                        <table class="table table-bordered" width="100%">
                          <tr style="background:#222;color:#f1f1f1;">
                            <th width='10%'><b>NO.</b></th>
                            <th><b>Berkas</b></th>
                            <th width='10%'><b>Aksi</b></th>
                          </tr>
                          <?php
                          $lampiran = $this->db->get_where('tbl_lampiran', "token_lampiran='$query->token_lampiran'");
                          $no = 1;
                          foreach ($lampiran->result() as $baris) {?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><a href="lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB"><?php echo $baris->nama_berkas; ?></a></td>
                              <td><a href="lampiran/<?php echo $baris->nama_berkas; ?>" target="_blank" title="<?php echo substr($baris->ukuran / 1024, 0, 5); ?> MB" class="btn btn-default xs"><i class="icon-download"></i></a></td>
                            </tr>
                          <?php
                            $no++;
                          }?>
                        </table>
    									</div>
                    </div>

                    <hr>
                    <a href="users/sk" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnupdate" id="submit-all" class="btn btn-primary" style="float:right;">Update</button>
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
