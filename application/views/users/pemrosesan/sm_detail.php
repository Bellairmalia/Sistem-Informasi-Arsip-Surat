<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
$( function() {
  $( "#tgl_disposisi" ).datepicker();
} );

</script>
<script type="text/javascript" src="assets/js/core/app.js"></script>

<style>
.dropzone {
  margin-top: 10px;
  border: 2px dashed #0087F7;
}
</style>

<?php
$this->db->order_by('no_urut', 'DESC');
$this->db->limit(1);
$cek_ns = $this->db->get('tbl_disposisi');
if ($cek_ns->num_rows() == 0) {
  $no_urut       = "D/001";
}else{
  $noUrut         = substr($cek_ns->row()->no_urut, 4, 7);
  $noUrut++;
  $no_urut      = "D/".sprintf("%03s", $noUrut);
}
?>

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
                <legend class="text-bold"><i class="icon-folder-download2"></i> Detail Surat Masuk</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action=""  enctype="multipart/form-data" method="post">
                    <!-- <div class="form-group">
                      <label class="control-label col-lg-3">Nomor</label>
                      <div class="col-lg-5">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-database"></i></span>
                          <select class="form-control cari_ns" name="ns" id="ns" required disabled>
                            <option value="<?php echo $query->no_surat; ?>"><?php echo $query->no_surat; ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_ns" class="form-control daterange-single" id="tgl_ns" value="<?php echo $query->tgl_ns; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                        </div>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Surat</label>
                      <div class="col-lg-9">
    												<input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required readonly>
    									</div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_surat" class="form-control daterange-single" id="tgl_surat" value="<?php echo $query->tgl_surat; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat Masuk</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_sm" class="form-control daterange-single" id="tgl_sm" value="<?php echo $query->tgl_sm; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="control-label col-lg-3">Asal Surat</label>
                      <div class="col-lg-9">
    												<input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?php echo $query->asal_surat; ?>" placeholder="" required readonly>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
    												<input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="" required readonly>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Klasifikasi</label>
                      <div class="col-lg-9">
                            <input type="text" name="klasifikasi" id="klasifikasi" class="form-control" value="<?php echo $query->klasifikasi; ?>" placeholder="" required readonly>
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

                    <a href="users/sm" class="btn btn-default"><< Kembali</a>

                    <?php if ($user->row()->level == 'admin'): ?>
                        <?php if ($query->disposisi == 0){ ?>
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#disposisi" style="float:right;">Disposisi</button>
                        <?php }else{ ?>
                                  <button type="submit" name="btndisposisi0" class="btn btn-primary" style="float:right;" onclick="return confirm('Anda yakin?')">Batal Disposisi</button>
                        <?php } ?>
                    <?php endif; ?>
                    
                </form>

              </fieldset>

            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
    <div class="modal fade" id="disposisi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Disposisi</h4>
        </div>

    <form class="form-horizontal" action="users/sm/d" enctype="multipart/form-data" method="post">
        <div class="modal-body">

          <div class="form-group">
            <div class="col-lg-12">
            No Urut :<input type="text" name="no_urut" id="no_urut" class="form-control" value="<?php echo $no_urut; ?>" placeholder="" required readonly>
          </div>
        </div>

           <div class="form-group">
              <div class="col-lg-12">
              Tgl Disposisi :<input type="date" name="tgl_disposisi" class="form-control daterange-single" id="tgl_disposisi" value="<?php echo date('Y-m-d'); ?>" required placeholder="Masukkan Tanggal">
            </div>
          </div>




          <div class="form-group">
            <div class="col-lg-12">
                  <!-- <input type="text" name="penerima" id="penerima" class="form-control" placeholder=""> -->
                Penerima :<select class="form-control cari_bag" name="nama_bagian" style="width:100%" required>
                    <option value="">- Teruskan -</option>
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


          <div class="form-group">
            <div class="col-lg-12">
                  Catatan :<textarea id="catatan" name="catatan" required="required" class="form-control" rows="3" placeholder='Masukkan Catatan'></textarea>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             <font color ="blue">No Surat :<input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             Asal Surat :<input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?php echo $query->asal_surat; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             Tanggal Surat :<input type="date" name="tgl_surat" id="tgl_surat" class="form-control" value="<?php echo $query->tgl_surat; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             Tanggal Masuk :<input type="date" name="tgl_sm" id="tgl_sm" class="form-control" value="<?php echo $query->tgl_sm; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             No Agenda :<input type="text" name="no_agenda" id="no_agenda" class="form-control" value="<?php echo $query->no_agenda; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
             Kepada :<input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="" required readonly>
          </div>
        </div>


          <div class="form-group">
            <div class="col-lg-12">
            Perihal :<input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required readonly>
          </div>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" name="btndisposisi" class="btn btn-primary" onclick="return confirm('Anda yakin?')">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <script>
      $(document).ready(function () {
          $(".cari_bag").select2({
              placeholder: "- Teruskan -"
          });
      });
  </script>
