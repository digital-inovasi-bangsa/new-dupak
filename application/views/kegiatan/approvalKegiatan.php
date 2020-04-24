<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Approval Kegiatan
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row" style="width:100%">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title" style="margin-left: 12px">List Kegiatan</h3>
          </div><!-- /.box-header -->
          <div class="card">
            <div class="box-body table-responsive no-padding">
              <div class="card-body" style="padding: 20px;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Pangkat</th>
                      <th>Jabatan</th>
                      <th>Unsur</th>
                      <th>Subunsur</th>
                      <th>Butir</th>
                      <th>Tanggal Mulai-Selesai</th>
                      <th>Surat Tugas</th>
                      <th>Dokumentasi</th>
                      <th>Laporan Kegiatan</th>
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
                      <th><?php echo $record->namaUnsur ?></th>
                      <th><?php echo $record->namaSubunsur ?></th>
                      <th><?php echo $record->namaButir ?></th>
                      <td><?php echo $record->tanggalMulai ?> - <?php echo $record->tanggalSelesai ?></td>
                      <td><a href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_surat_kegiatan ?>"
                          download><?php echo $record->path_surat_kegiatan ?></td>
                      <td><a href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_dokumentasi ?>"
                          download><?php echo $record->path_dokumentasi ?></td>
                      <td><a
                          href="<?php echo base_url()?>upload/dokumentasi/<?php echo $record->path_laporan_kegiatan ?>"
                          download><?php echo $record->path_laporan_kegiatan ?></td>
                      <td>
                        <a><i class="edit fa fa-pencil" id="edit" name="edit" data-toggle="modal" href="#"
                            data-id="<?php echo $record->idKegiatanHarian; ?>"
                            data-target="#modal-default"></i>&nbsp;&nbsp;&nbsp;</a>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Approve Kegiatan</h4>
      </div>
      <div class="modal-body">
        <div class="form-group" id="surat_kegiatan">
        </div>
        <div class="form-group">
          <label id="label_surat">Surat Kegiatan</label>
          <div class="overlay" id="loading_surat_kegiatan">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
          <label id="label_laporan_kegiatan">Laporan Kegiatan</label>
          <div class="overlay" id="loading_laporan_kegiatan">
            <i class="fa fa-refresh fa-spin"></i>
          </div>
          <label id="label_dokumentasi">Dokumentasi</label>
          <div class="overlay" id="loading_dokumentasi">
            <i class="fa fa-refresh fa-spin"></i>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" id="btnSubmit" class="btn btn-primary">Save changes</button>
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
          $("#loading_surat_kegiatan").hide();
          $("#loading_laporan_kegiatan").hide();
          $("#loading_dokumentasi").hide();
          $("#loading_select").hide();
          $("#label_surat").hide();
          $("#label_laporan_kegiatan").hide();
          $("#label_dokumentasi").hide();
          $('<label>Surat Kegiatan</label>').appendTo('#surat_kegiatan');
          $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
            .path_surat_kegiatan + '" width="100%" height="100%"></iframe>').appendTo(
            '#surat_kegiatan');
          $('<label>Laporan Kegiatan</label>').appendTo('#surat_kegiatan');
          $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
            .path_laporan_kegiatan + '" width="100%" height="100%"></iframe>').appendTo(
            '#surat_kegiatan');
          $('<label>Dokumentasi</label>').appendTo('#surat_kegiatan');
          $('<iframe src="<?php echo base_url() ?>upload/dokumentasi/' + JSON.parse(response)
            .path_dokumentasi + '" width="100%" height="100%"></iframe>').appendTo('#surat_kegiatan');
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    }); $("#btnSubmit").button().click(function () {
      var value = $("#status").val();
      $.ajax({
          url: "<?php echo base_url()?>kegiatan/updateStatusKegiatan",
          type: "post",
          data: {
            status: value,
            id: id,
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