<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>

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
  $no_urut       = "D001";
}else{
  $noUrut         = substr($cek_ns->row()->no_urut, 4, 7);
  $noUrut++;
  $no_urut      = "D".sprintf("%03s", $noUrut);
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
                <legend class="text-bold"><i class="icon-folder2"></i> Detail Disposisi</legend>
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
                      <label class="control-label col-lg-3">No.Urut</label>
                      <div class="col-lg-9">
    												<input type="text" name="no_urut" id="no_urut" class="form-control" value="<?php echo $query->no_urut; ?>" placeholder="" required readonly>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">No Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Asal Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?php echo $query->asal_surat; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Masuk</label>
                      <div class="col-lg-9">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_sm" class="form-control daterange-single" id="tgl_Sm" value="<?php echo date('d-m-Y',strtotime($query->tgl_sm)); ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                          </div>
                          </table>
                        </div>
                      </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat</label>
                      <div class="col-lg-9">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_surat" class="form-control daterange-single" id="tgl_surat" value="<?php echo date('d-m-Y',strtotime($query->tgl_surat)); ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                          </div>
                          </table>
                        </div>
                      </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">No.Agenda</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_agenda" id="no_agenda" class="form-control" value="<?php echo $query->no_agenda; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
                            <input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
                            <input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Disposisi</label>
                      <div class="col-lg-9">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_disposisi" class="form-control daterange-single" id="tgl_disposisi" value="<?php echo $query->tgl_disposisi; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                          </div>
                          </table>
                        </div>
                      </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Bagian diteruskan</label>
                      <div class="col-lg-9">
                            <input type="text" name="nama_bagian" id="nama_bagian" class="form-control" value="<?php echo $query->nama_bagian; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Catatan</label>
                      <div class="col-lg-9">
                            <input type="text" name="catatan" id="catatan" class="form-control" value="<?php echo $query->catatan; ?>" placeholder="" required readonly>
                      </div>
                    </div>
            
                    <hr>

                    <a href="users/ds" class="btn btn-default"><< Kembali</a>
                                       
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
    
  <script>
      $(document).ready(function () {
          $(".cari_bag").select2({
              placeholder: "- Teruskan -"
          });
      });
  </script>
