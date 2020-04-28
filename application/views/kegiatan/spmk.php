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
                        <div class="row">
                            <form role="form" id="cariSpmk" action="<?php echo base_url() ?>kegiatan/cariSpmk" method="post" role="form">
                                <!-- CSRF Token -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tahun</label>
                                        <select class="form-control" id="tahun" name="tahun">
                                            <option value="0">Pilih Tahun</option>
                                            <?php
                                            for ($i = date('Y') - 5; $i < date('Y') + 1; $i++) {
                                                if ($i == $tahun) {
                                                    $result = "selected";
                                                };
                                                echo "<option " . $result . " value='$i'>$i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Periode</label>
                                        <select class="form-control" id="bulan" name="bulan">
                                            <?php if ($bulan >= 01 && $bulan <= 06) { ?>
                                                <option value="0">Pilih Periode</option>
                                                <option selected value="01">Jan-Jun</option>
                                                <option value="07">Jul-Des</option>
                                            <?php } else { ?>
                                                <option value="0">Pilih Periode</option>
                                                <option value="01">Jan-Jun</option>
                                                <option selected value="07">Jul-Des</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <input type="submit" class="btn btn-primary btn-block" value="Cari Data"> </input>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <th>Nama Unsur</th>
                                            <th>Angka Kredit</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($spmk)) {
                                            $no = 1;
                                            foreach ($spmk as $record) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $record->namaUnsur ?></td>
                                                    <td><?php echo $record->point ?></td>
                                                    <td><?php echo $record->tanggalMulai ?></td>
                                                    <td><?php echo $record->tanggalSelesai ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'kegiatan/detailSpmk/' . $record->idKegiatanHarian . '/' . $tahun . '/' . $bulan . '/' . $record->idUnsur ?>"><i class="fa fa-search"> Lihat Data</i></a>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deleteDivisi.js" charset="utf-8"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "columns": [{
                    "width": "5%"
                },
                {
                    "width": "30%"
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