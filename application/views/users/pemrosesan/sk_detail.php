<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
$( function() {
  $( "#tgl_ns" ).datepicker();
} );
</script>
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
                <legend class="text-bold"><i class="icon-folder-upload2"></i> Detail Surat Keluar</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Keluar</label>
                      <div class="col-lg-9">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_sk" class="form-control daterange-single" id="tgl_sk" value="<?php echo date('d-m-Y',strtotime($query->tgl_sk)); ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
                            <input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Dari</label>
                      <div class="col-lg-9">
                            <input type="text" name="dari" id="dari" class="form-control" value="<?php echo $query->dari; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tembusan</label>
                      <div class="col-lg-9">
                            <input type="text" name="tembusan" id="tembusan" class="form-control" value="<?php echo $query->tembusan; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
                            <input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required readonly>
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
                    <?php if ($user->row()->level == 'admin'): ?>

                        <?php if ($query->peringatan == 0){ ?>
                                  <button type="submit" name="btnperingatan" class="btn btn-warning" style="float:right;margin-right:10px;" onclick="return confirm('Anda yakin?')">Peringatan</button>
                        <?php }else{ ?>
                                  <button type="submit" name="btnperingatan0" class="btn btn-warning" style="float:right;margin-right:10px;" onclick="return confirm('Anda yakin?')">Batal Peringatan</button>
                        <?php } ?>
                    <?php endif; ?>
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

  <!-- Modal -->
  <div class="modal fade" id="disposisi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Disposisi ke bagian</h4>
        </div>
        <form class="" action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="col-lg-12">
                  <!-- <input type="text" name="penerima" id="penerima" class="form-control" placeholder=""> -->
                  <select class="form-control cari_bag" name="bagian" style="width:100%" required>
                    <option value="">- Pilih Bagian -</option>
                    <?php
                    $this->db->order_by('nama_bagian', 'ASC');
                    $bagian = $this->db->get('tbl_bagian')->result();
                    foreach ($bagian as $baris) {?>
                      <option value="<?php echo $baris->nama_bagian; ?>"><?php echo $baris->nama_bagian; ?></option>
                    <?php
                    } ?>
                  </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" name="btndisposisi" class="btn btn-primary" onclick="return confirm('Anda yakin?')">Kirim</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <script>
      $(document).ready(function () {
          $(".cari_bag").select2({
              placeholder: "- Pilih Bagian -"
          });
      });
  </script>
