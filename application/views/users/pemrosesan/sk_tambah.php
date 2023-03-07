<script src="assets/js/select2.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script>
</script>
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
$this->db->order_by('id_sk', 'DESC');
$this->db->limit(1);
$cek_ns = $this->db->get('tbl_sk');
if ($cek_ns->num_rows() == 0) {
  $no_surat       = "SKM/001";
}else{
  $noUrut 	 			= substr($cek_ns->row()->no_surat, 4, 7);
  $noUrut++;
  $no_surat				= "SKM/".sprintf("%03s", $noUrut);
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
                <legend class="text-bold"><i class="icon-folder-download2"></i> Tambah Surat Keluar Baru</legend>
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
                      <label class="control-label col-lg-3">Tanggal Keluar</label>
                      <div class="col-lg-9">
                          <input type="date" name="tgl_sk" class="form-control daterange-single" id="tgl_sk" value="<?php echo date('Y-m-d'); ?>" maxlength="10" required placeholder="Masukkan Tanggal">
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Kepada</label>
                      <div class="col-lg-9">
                            <input type="text" name="kepada" id="kepada" class="form-control" placeholder="Masukkan Kepada">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Dari</label>
                      <div class="col-lg-9">
                            <input type="text" name="dari" id="dari" class="form-control" placeholder="Masukkan Dari">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Tembusan</label>
                      <div class="col-lg-9">
                            <input type="text" name="tembusan" id="tembusan" class="form-control" placeholder="Masukkan Tembusan">
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
  url: "<?php echo base_url('users/sk') ?>",
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
            formData.append("tgl_sk", jQuery("#tgl_sk").val());
            formData.append("kepada", jQuery("#kepada").val());
            formData.append("dari", jQuery("#dari").val());
            formData.append("tembusan", jQuery("#tembusan").val());
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

      
                            window.location="<?php echo base_url(); ?>users/sk/t";
                //     }
                // });

      myDropzone.removeFile(file);
    });

  }
};

</script>
