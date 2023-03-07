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
                <legend class="text-bold"><i class="icon-folder-download2"></i> Edit Surat Masuk</legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <div class="msg"></div>
                <form class="form-horizontal" action="" method="post">

                    <div class="form-group">
                      <label class="control-label col-lg-3">No.Urut</label>
                      <div class="col-lg-9">
    												<input type="text" name="no_urut" id="no_urut" class="form-control" value="<?php echo $query->no_urut; ?>" placeholder="" required readonly>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">No.Surat</label>
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
                          <input type="text" name="tgl_sm" class="form-control daterange-single" id="tgl_Sm" value="<?php echo $query->tgl_sm; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
                          </div>
                          </table>
                        </div>
                      </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat</label>
                      <div class="col-lg-9">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="icon-calendar"></i></span>
                          <input type="text" name="tgl_surat" class="form-control daterange-single" id="tgl_surat" value="<?php echo $query->tgl_surat; ?>" maxlength="10" required placeholder="Masukkan Tanggal" required readonly>
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
                          <input type="date" name="tgl_disposisi" class="form-control daterange-single" id="tgl_disposisi" value="<?php echo $query->tgl_disposisi; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                      </div>
                    </div>

                   <div class="form-group">
                      <label class="control-label col-lg-3">Bagian diteruskan</label>
                      <div class="col-lg-9">
                            <!-- <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->pengirim; ?>" placeholder=""> -->
                            <select class="form-control cari_bag" name="nama_bagian" id="nama_bagian" required>
                              <option value="<?php echo $query->nama_bagian; ?>"><?php echo $query->nama_bagian; ?></option>
                              <?php
                              $this->db->order_by('nama_bagian', 'ASC');
                                    foreach ($this->db->get('tbl_bagian')->result() as $baris): ?>
                                        <option value="<?php echo $baris->nama_bagian; ?>"><?php echo $baris->nama_bagian; ?></option>
                              <?php endforeach; ?>
                            </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Catatan</label>
                      <div class="col-lg-9">
                            <input type="text" name="catatan" id="catatan" class="form-control" value="<?php echo $query->catatan; ?>" placeholder="">
                      </div>
                    </div>

                        </table>
    									
                    <script>
                        $(document).ready(function () {
                            $(".cari_bag").select2({
                                placeholder: "- Teruskan -"
                            });
                        });
                    </script>
                    <hr>
                    <a href="users/ds" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnupdate" id="submit-all" class="btn btn-primary" style="float:right;">Update</button>
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
