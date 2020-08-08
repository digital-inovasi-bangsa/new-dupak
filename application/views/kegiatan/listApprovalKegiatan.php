<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $pageTitle; ?>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"><?= $pageTitle; ?></h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="box-body table-responsive no-padding">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Pangkat</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($kegiatan))
                    {
                        $no = 1;
                        foreach($kegiatan as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $record->nip ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo $record->namaJabatan ?></td>
                      <td><?php echo $record->namaPangkat ?></td>
                      <td><a href="<?php echo base_url().'kegiatan/approvalKegiatan/'.$record->userId; ?>"><i
                            class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div><!-- /.box-body -->
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= $pageTitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="form-group" id="surat_kegiatan">
        </div>
        <label id="label_laporan_kegiatan">Laporan Kegiatan</label>
        <div class="overlay" id="loading_laporan_kegiatan">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <label id="label_dokumentasi">Dokumentasi</label>
        <div class="overlay" id="loading_dokumentasi">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <label id="label_daftar_hadir">Daftar Hadir</label>
        <div class="overlay" id="loading_hadir">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <label id="label_jurnal">Jurnal</label>
        <div class="overlay" id="loading_jurnal">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <label id="label_sprint">Sprint Siaga</label>
        <div class="overlay" id="loading_sprint">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <label id="label_checklist">Checklist Peralatan</label>
        <div class="overlay" id="loading_checklist">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="form-group">
          <label for="catatan">Catatan</label>
          <input type="text" class="form-control required" id="catatan" name="catatan" maxlength="128">
        </div>
        <label>Ubah status</label>
        <select class="form-control" id="status" name="status">
          <option value="0">-Pilih Status-</option>
          <option value="Diterima">Diterima</option>
          <option value="Ditolak">Ditolak</option>
        </select>
        <div class="overlay" id="loading_select">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" id="btnSubmit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "columns": [{
          "width": "3%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        },
        {
          "width": "10%"
        }
      ],
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "pageLength": 5
    });
  });
</script>

<script>
  jQuery(document).ready(function () {
    jQuery(document).on("click", ".edit", function () {
      var id = $(this).data("id");
      $("#status").hide();
      $("#catatan").hide();
      $.ajax({
        url: "<?php echo base_url()?>kegiatan/getDokumenKegiatan",
        type: "post",
        data: {
          idDokumenKegiatan: id,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success: function (response) {
          if (response) {
            $("#status").show();
            $("#catatan").show();
            $("#loading_surat_kegiatan").hide();
            $("#loading_laporan_kegiatan").hide();
            $("#loading_dokumentasi").hide();
            $("#loading_select").hide();
            $("#loading_hadir").hide();
            $("#loading_jurnal").hide();
            $("#loading_sprint").hide();
            $("#loading_checklist").hide();
            $("#label_surat").hide();
            $("#label_daftar_hadir").hide();
            $("#label_laporan_kegiatan").hide();
            $("#label_dokumentasi").hide();
            $("#label_sprint").hide();
            $("#label_checklist").hide();
            $("#label_jurnal").hide();
            // $('<label>Surat Kegiatan</label>').appendTo('#surat_kegiatan');
            // $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
            //   .path_surat_kegiatan + '" width="100%" height="100%"></iframe>').appendTo(
            //   '#surat_kegiatan');;
            $('<label>Laporan Kegiatan</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_laporan_kegiatan + '" width="100%" height="100%"></iframe>').appendTo(
              '#surat_kegiatan');;
            $('<label>Dokumentasi</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_dokumentasi + '" width="100%" height="100%"></iframe>').appendTo('#surat_kegiatan');
            $('<label>Daftar Hadir</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_daftar_hadir + '" width="100%" height="100%"></iframe>').appendTo('#surat_kegiatan');
            $('<label>Jurnal</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_jurnal + '" width="100%" height="100%"></iframe>').appendTo('#surat_kegiatan');
            $('<label>Sprint Siaga</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_sprint_siaga + '" width="100%" height="100%"></iframe>').appendTo('#surat_kegiatan');
            $('<label>Checklist Peralatan</label>').appendTo('#surat_kegiatan');
            $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
              .path_check_peralatan + '" width="100%" height="100%"></iframe>').appendTo(
              '#surat_kegiatan');
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
      $("#btnSubmit").button().click(function () {
        var value = $("#status").val();
        var catatan = $("#catatan").val();
        $.ajax({
          url: "<?php echo base_url()?>kegiatan/updateStatusKegiatan",
          type: "post",
          data: {
            status: value,
            id: id,
            catatan: catatan,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
          },
          success: function (response) {
            if (response === "true") {
              $('.edit').modal('hide'); //or  $('#IDModal').modal('hide');
              swal("Sukses!", "Data Berhasil diUpdate!", "success").then(function () {
                location.reload();
              })
            } else {
              swal("Gagal!", "Data Gagal diUpdate!", "danger").then(function () {
                location.reload();
              })
            }
            //location.reload();
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
        });
      });

    });
  });
</script>