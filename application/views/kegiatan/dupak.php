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
                            <form role="form" id="cariDupak" action="<?php echo base_url() ?>kegiatan/cariDupak"
                                method="post" role="form">
                                <!-- CSRF Token -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                    value="<?= $this->security->get_csrf_hash(); ?>" />
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
                                        <input type="submit" class="btn btn-primary btn-block" value="Cari Data" />
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
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-3">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <h4 class="text-center"><strong>DAFTAR USUL PENETAPAN ANGKA KREDIT<br>JABATAN FUNGSIONAL
                                        <br><br><br><br></strong></h4>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row invoice-info">
                            <div class="col-sm-5">
                                <p>Instansi : KANTOR PENCARIAN DAN PERTOLONGAN YOGYAKARTA</p>
                                <p>Nama</p>
                                <p>Nomer Seri Kartu Pegawai</p>
                                <p>Tempat, Tanggal Lahir</p>
                                <p>Jenis Kelamin</p>
                                <p>Pendidikan yang dihitung angka kreditnya</p>
                                <p>Jabatan Rescuer</p>
                                <p>Lama Kerja</p>
                                <p>Unit Kerja</p>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-7">
                                <p>Periode : <?php echo $periode ?> </p>
                                <p>: <?php echo $user->name ?></p>
                                <p>: <?php echo $user->nomorSeriKartuPegawai ?></p>
                                <p>: <?php echo $user->tempatLahir ?>, <?php echo $user->tanggalLahir ?></p>
                                <p>: <?php echo $user->jenisKelamin ?></p>
                                <p>: <?php echo $user->pendidikan ?></p>
                                <p>: <?php echo $user->namaPangkat ?></p>
                                <p>: <?php echo $lamaKerja ?></p>
                                <p>: KANTOR PENCARIAN DAN PERTOLONGAN YOGYAKARTA</p>
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table id='table-dupak' class="table table-bordered" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan='4'>NO</th>
                                            <th class="col" colspan='11' style='text-align:center'>UNSUR YANG DINILAI
                                            </th>

                                        </tr>
                                        <tr>
                                            <th class="col" rowspan='3' colspan='5' style='text-align:center'>UNSUR, SUB
                                                UNSUR DAN BUTIR KEGIATAN</th>
                                            <th colspan='6' class="text-center">ANGKA KREDIT MENURUT</th>
                                        </tr>
                                        <tr>
                                            <th colspan='3' class="text-center">INSTANSI PENGUSUL</th>
                                            <th colspan='3' class="text-center">TIM PENILAI</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">LAMA</th>
                                            <th class="text-center">BARU</th>
                                            <th class="text-center">JUMLAH</th>
                                            <th class="text-center">LAMA</th>
                                            <th class="text-center">BARU</th>
                                            <th class="text-center">JUMLAH</th>
                                        </tr>
                                        <tr>
                                            <th style="width: 10px" class="text-center">1</th>
                                            <th class="col" colspan='5'>2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6</th>
                                            <th class="text-center">7</th>
                                            <th class="text-center">8</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center">I</th>
                                            <th colspan='5'>Unsur Utama</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <?php
                                        if (!empty($unsur)) {
                                            $no = 1;
                                            $abjad = 'a';
                                            foreach ($unsur as $record) {
                                        ?>
                                        <tr>

                                            <td></td>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td colspan='4'><?php echo $record['namaUnsur'] ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <tr>
                                            <?php
                                                        $abjad = 'a';
                                                        $index = 0;
                                                        foreach ($record['subunsur'] as $record2) {
                                                    ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center"><?php echo $abjad++ ?></td>
                                            <td colspan='3'><?php echo $record2['namaSubunsur'] ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $index1 = 0;
                                        $noButir = 1;
                                        foreach ($record2['butir'] as $record3) { 
                                        ?>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><?php echo $noButir++ ?></td>
                                            <td colspan='2'><?php echo $record3['namaButir'] ?></td>
                                            <td class="text-center"><?php echo $record3['nilaiInstansiLama'] ?></td>
                                            <td class="text-center"><?php echo $record3['nilaiInstansiBaru'] ?></td>
                                            <td class="text-center"><?php echo $record3['nilaiInstansiJumlah'] ?></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                            <td class="text-center"></td>
                                        </tr>
                                        <?php 
                                                    } ?>

                                        <?php }}
                                        }
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="12"><label>Mengambil Kegiatan Kebawah atau
                                                    Keatas</label></td>
                                        <tr>
                                        <tr>
                                            <td class="text-center" colspan="6"><label>JUMLAH UNSUR UTAMA DAN UNSUR
                                                    PENUNJANG</label></td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">
                                                <?php
                                        if ($total[0]->poin) {
                                            echo $total[0]->poin;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                        if ($total[0]->poin) {
                                            echo $total[0]->poin;
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <p>*) Dicoret yang tidak perlu</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table id='table_bawah' class="table table-bordered" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>II</td>
                                            <td colspan="2">LAMPIRAN PENDUKUNG DUPAK :</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td width="600">
                                                <p>1. ..............</p>
                                                <p>2. ..............</p>
                                                <p>3. ..............</p>
                                                <p>4. dan seterusnya</p>
                                            </td>
                                            <td class="text-center">
                                                <p><?php echo $user->namaPangkat ?></p><br><br><br>
                                                <p><?php echo $user->name ?></p>
                                                <p><?php echo $user->nip ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>III</td>
                                            <td colspan="2">Catatan Pejabat Pengusul :</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>1. ..............</p>
                                                <p>2. ..............</p>
                                                <p>3. ..............</p>
                                                <p>4. dan seterusnya</p>
                                            </td>
                                            <td class="text-center">
                                                <p><?php echo $user->namaPangkat ?></p><br><br><br>
                                                <p><?php echo $atasan->name ?></p>
                                                <p><?php echo $user->nip ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IV</td>
                                            <td colspan="2">Catatan Anggota Tim Penilai</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>1. ..............</p>
                                                <p>2. ..............</p>
                                                <p>3. ..............</p>
                                                <p>4. dan seterusnya</p>
                                            </td>
                                            <td class="text-center">
                                                <p>..............</p><br><br><br>
                                                <p>Nama Penilai I:</p>
                                                <p>NIP:</p>
                                                <p>..............</p><br><br><br>
                                                <p>Nama Penilai II:</p>
                                                <p>NIP:</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>IV</td>
                                            <td colspan="2">Catatan Ketua Tim Penilai</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>1. ..............</p>
                                                <p>2. ..............</p>
                                                <p>3. ..............</p>
                                                <p>4. dan seterusnya</p>
                                            </td>
                                            <td class="text-center">
                                                <p></p><br><br><br>
                                                <p>Ketua Penilai:</p>
                                                <p>NIP:</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <tbody>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <a href="<?php echo base_url() . 'kegiatan/printDupak/' . $user->userId . '/' . $bulan . '/' . $tahun; ?>"
                                    target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                        class="fa fa-print"></i> Cetak</a>
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                </div>
            </div>
        </div>

    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deleteDivisi.js" charset="utf-8"></script>
<script>
    $(function () {
        $(".table_bawah").DataTable({
            "columns": [{
                    "width": "5%"
                },
                {
                    "width": "40%"
                },
                {
                    "width": "45%"
                }
            ],
            "paging": false,
            "lengthChange": true,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "pageLength": 5
        });
    });
</script>