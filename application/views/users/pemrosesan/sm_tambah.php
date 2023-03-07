<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/core/app.js"></script>

<link rel="stylesheet" type="text/css" href="assets/upload/dropzone.min.css">
<!-- <link rel="stylesheet" type="text/css" href="assets/upload/basic.min.css"> -->
<script type="text/javascript" src="assets/upload/dropzone.min.js"></script>

<style>
.dropzone {
  margin-top: 10px;
  border: 2px dashed #0087F7;
}
</style>


<?php
$ceknosm = $this->db->get_where('tbl_sm', array('no_surat' => $this->input->post('no_surat')));

    if ($ceknosm->num_rows() > 0) {
      $this->session->set_flashdata('gagal', "ID Outlet sudah digunakan");
      redirect('sm_tambah','refresh');
    }

$this->db->order_by('id_sm', 'DESC');
$this->db->limit(1);
$cek_agenda = $this->db->get('tbl_sm');
if ($cek_agenda->num_rows() == 0) {
  $no_agenda       = "NA/001";
}else{
  $noUrut         = substr($cek_agenda->row()->no_agenda, 4, 7);
  $noUrut++;
  $no_agenda       = "NA/".sprintf("%03s", $noUrut);
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
                <legend class="text-bold"><i class="icon-folder-download2"></i> Tambah Surat Masuk Baru</legend>
                
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
                <form class="form-horizontal" action="users/sm"  enctype="multipart/form-data" method="post">

                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Masukkan Nomor Surat">
    									</div>
                      </div>
                  
                      <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Surat</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="<?php echo date('Y-m-d'); ?>" required>  
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tanggal Masuk</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_sm" class="form-control" id="tgl_sm" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Asal Surat</label>
                      <div class="col-lg-9">
                            <input type="text" name="asal_surat" id="asal_surat" class="form-control" placeholder="Masukkan Asal Surat">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">No. Agenda</label>
                      <div class="col-lg-9">
                            <input type="text" name="no_agenda" id="no_agenda" class="form-control" placeholder="" value="<?php echo $no_agenda; ?>" required readonly>
                            <input type="hidden" name="no_agenda" id="no_agenda" class="form-control" placeholder="" value="<?php echo $no_agenda; ?>" required>
                      </div>
                      </div>

                      <div class="form-group">
                      <label class="control-label col-lg-3">Klasifikasi Surat</label>
                      <div class="col-lg-9">
                            <!-- <input type="text" name="pengirim" id="pengirim" class="form-control" placeholder=""> -->
                            <select class="form-control cari_klasifikasi" name="klasifikasi" id="klasifikasi" required>
                              <option value=""></option>
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
                            <!-- <input type="text" name="pengirim" id="pengirim" class="form-control" placeholder=""> -->
                            <select class="form-control cari_penerima" name="penerima" id="penerima" required>
                              <option value=""></option>
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
                            <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukkan Kepada">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Perihal</label>
                      <div class="col-lg-9">
                        <textarea id="perihal" name="perihal" required="required" class="form-control" rows="3" placeholder='Masukkan Perihal Surat'></textarea>
    									</div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3"><b>Lampiran</b></label>
                      <div class="col-lg-12">
                          <div class="dropzone" id="myDropzone">
                            <div class="dz-message">
                             <h3> Klik atau Drop Lampiran disini</h3>
                            </div>
                          </div>
                          <i style="color:red">*Lampiran wajib diisi</i>
    									</div>
                    </div>

                    <hr>
                    <a href="users/sm" class="btn btn-default"><< Kembali</a>
                    <button type="submit" id="submit-all" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>

                <script>
                    $(document).ready(function () {
                        $(".cari_klasifikasi").select2({
                            placeholder: "- Pilih Klasifikasi -"
                        });

                        $(".cari_penerima").select2({
                            placeholder: "- Pilih Nama Bagian -"
                        });
                    });
                </script>
              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

<script type="text/javascript">

$('.msg').html('');

Dropzone.options.myDropzone = {

  // Prevents Dropzone from uploading dropped files immediately
  url: "<?php echo base_url('users/sm') ?>",
  paramName:"userfile",
  // acceptedFiles:"'file/doc','file/xls','file/xlsx','file/docx','file/pdf','file/txt',image/jpg,image/jpeg,image/png,image/bmp",
  autoProcessQueue: false,
  maxFilesize: 10, //MB
  parallelUploads: 10,
  maxFiles: 10,
  addRemoveLinks:true,
  dictCancelUploadConfirmation: "Yakin ingin membatalkan upload ini?",
  dictInvalidFileType: "Type file ini tidak dizinkan",
  dictFileTooBig: "File yang Anda Upload terlalu besar {{filesize}} MB. Maksimal Upload {{maxFilesize}} MB",
  dictRemoveFile: "Hapus",

  init: function() {
    var submitButton = document.querySelector("#submit-all")
        myDropzone = this; // closure

    submitButton.addEventListener("click", function(e) {
      // if ($("#ns").val() == '' || $("#tgl_ns").val() == '' || $("#no_asal").val() == '' || ("#tgl_no_asal").val() == '') {
      //     alert('Nomor dan No. Surat wajib diisi!');
      // }
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue(); // Tell Dropzone to process all queued files.
    });

    // You might want to show the submit button only when

    this.on("error", function(file, message) {
                alert(message);
                this.removeFile(file);
                errors = true;
    });

    // files are dropped here:
    this.on("addedfile", function(file) {
      // Show submit button here and/or inform user to click it.
      //  alert("Apakah anda yakin");
    });

    this.on("sending", function(data, xhr, formData) {
            formData.append("no_surat", jQuery("#no_surat").val());
            formData.append("tgl_surat", jQuery("#tgl_surat").val());
            formData.append("tgl_sm", jQuery("#tgl_sm").val());
            formData.append("asal_surat", jQuery("#asal_surat").val());
            formData.append("no_agenda", jQuery("#no_agenda").val());
            formData.append("klasifikasi", jQuery("#klasifikasi").val());
            formData.append("penerima", jQuery("#penerima").val());
            formData.append("kepada", jQuery("#kepada").val());
            formData.append("perihal", jQuery("#perihal").val());
    });

    this.on("complete", function(file) {
      //Event ketika Memulai mengupload
      myDropzone.removeFile(file);
    });

    this.on("success", function (file, response) {
      //Event ketika Memulai mengupload
      // console.log(response);
      //           $(response).each(function (index, element) {
      //               if (element.status) {
      //               }
      //               else {


      

                            
                            window.location="<?php echo base_url(); ?>users/sm/t";
                //     }
                // });

      myDropzone.removeFile(file);
    });

  }
};

</script>
