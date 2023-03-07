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
    												<input type="text" name="no_surat" id="no_surat" class="form-control" value="<?php echo $query->no_surat; ?>" placeholder="">
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="<?php echo $query->tgl_surat; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Masuk</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_sm" class="form-control" id="tgl_sm" value="<?php echo $query->tgl_sm; ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Asal Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="asal_surat" id="asal_surat" class="form-control" value="<?php echo $query->asal_surat; ?>" placeholder="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Agenda</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_agenda" id="no_agenda" class="form-control" value="<?php echo $query->no_agenda; ?>" placeholder="" required readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Klasifikasi Surat</label>
                      <div class="col-lg-9">
                            <!-- <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->pengirim; ?>" placeholder=""> -->
                            <select class="form-control cari_klasifikasi" name="klasifikasi" id="klasifikasi" required>
                              <option value="<?php echo $query->klasifikasi; ?>"><?php echo $query->klasifikasi; ?></option>
                              <?php
                              $this->db->order_by('nama_klasifikasi', 'ASC');
                                    foreach ($this->db->get('tbl_klasifikasi')->result() as $baris): ?>
                                        <option value="<?php echo $baris->nama_klasifikasi; ?>"><?php echo $baris->nama_klasifikasi; ?></option>
                              <?php endforeach; ?>
                            </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Penerima</label>
                      <div class="col-lg-9">
    												<!-- <input type="text" name="pengirim" id="pengirim" class="form-control" value="<?php echo $query->pengirim; ?>" placeholder=""> -->
                            <select class="form-control cari_penerima" name="penerima" id="penerima" required>
                              <option value="<?php echo $query->penerima; ?>"><?php echo $query->penerima; ?></option>
                              <?php
                              $this->db->order_by('nama_bagian', 'ASC');
                                    foreach ($this->db->get('tbl_bagian')->result() as $baris): ?>
                                        <option value="<?php echo $baris->nama_bagian; ?>"><?php echo $baris->nama_bagian; ?></option>
                              <?php endforeach; ?>
                            </select>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
                            <input type="text" name="kepada" id="kepada" class="form-control" value="<?php echo $query->kepada; ?>" placeholder="">
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-lg-3">Penerima</label>
                      <div class="col-lg-9">
    												<input type="text" name="penerima" id="penerima" class="form-control" value="<?php echo $query->penerima; ?>" placeholder="">
    									</div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
    												<input type="text" name="perihal" id="perihal" class="form-control" value="<?php echo $query->perihal; ?>" placeholder="">
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
                    <script>
                        $(document).ready(function () {
                            $(".cari_penerima").select2({
                                placeholder: "- Pilih Bagian Penerima -"
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function () {
                            $(".cari_klasifikasi").select2({
                                placeholder: "- Pilih Klasifikasi Surat -"
                            });
                        });
                    </script>

                    <hr>
                    <a href="users/sm" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Update</button>
                </form>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->


