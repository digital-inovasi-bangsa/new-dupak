<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <style stype="text/css">
        @media print {
            * {
                overflow: visible !important;
            }

            .page {
                page-break-after: always;
            }
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
    <div class="wrapper">
        <section class="invoice">
            <div class="row" style="width:100%">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row invoice-info">
                                <div class="col-sm-3 invoice-col">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    <h4 class="text-center">DAFTAR USUL PENETAPAN ANGKA KREDIT<br>JABATAN FUNGSIONAL
                                        <br><br><br><br></h4>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 invoice-col">
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row invoice-info">
                                <div class="col-sm-5 invoice-col">
                                    <p> </p>
                                    <p>Nama</p>
                                    <p>Nomer Seri Kartu Pegawai</p>
                                    <p>Tempat, Tanggal Lahir</p>
                                    <p>Jenis Kelamin</p>
                                    <p>Pendidikan yang dihitung angka kreditnya</p>
                                    <p>Jabatan Rescuer</p>
                                    <p>Lama Kerja</p>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-7 invoice-col">
                                    <p>Periode : <?php echo $periode ?> </p>
                                    <p>: <?php echo $user->name ?></p>
                                    <p>: <?php echo $user->nomorSeriKartuPegawai ?></p>
                                    <p>: <?php echo $user->tempatLahir ?>, <?php echo $user->tanggalLahir ?></p>
                                    <p>: <?php echo $user->jenisKelamin ?></p>
                                    <p>: <?php echo $user->pendidikan ?></p>
                                    <p>: <?php echo $user->namaJabatan ?></p>
                                    <p>: <?php echo $lamaKerja ?></p>
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
                                                <th class="col" colspan='11' style='text-align:center'>UNSUR YANG
                                                    DINILAI
                                                </th>

                                            </tr>
                                            <tr>
                                                <th class="col" rowspan='3' colspan='5' style='text-align:center'>UNSUR,
                                                    SUB
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
                                        if(!empty($unsur))
                                        {
                                            $no = 1;
                                            $abjad = 'a';
                                            foreach($unsur as $record)
                                            {
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
                                        if(!empty($unsur))
                                        {
                                            $abjad = 'a';
                                            $index = 0;
                                            foreach($record['subunsur'] as $record2)
                                            {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"><?php echo $abjad++ ?></td>
                                                <td colspan='3'><?php echo $record2['namaSubunsur']?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php } }?>
                                            <?php 
                                        if(!empty($unsur))
                                        {
                                            $abjad = 'a';
                                            $no2 = 1;
                                            foreach($record2['butir'] as $record3)
                                            {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center"><?php echo $no2++ ?></td>
                                                <td colspan='2'><?php echo $record3['namaButir']?></td>
                                                <td class="text-center"><?php echo $record3['nilaiInstansiLama']?></td>
                                                <td class="text-center"><?php echo $record3['nilaiInstansiBaru']?></td>
                                                <td class="text-center"><?php echo $record3['nilaiInstansiJumlah']?>
                                                </td>
                                                <td class="text-center"><?php echo $record3['nilaiPenilaiLama']?></td>
                                                <td class="text-center"><?php echo $record3['nilaiPenilaiBaru']?></td>
                                                <td class="text-center"><?php echo $record3['nilaiPenilaiJumlah']?></td>
                                            </tr>
                                            <?php } }?>
                                            </td>
                                            <?php } }?>
                                            <tr>
                                                <td class="text-center" colspan="12"><label>Mengambil Kegiatan Kebawah
                                                        atau
                                                        Keatas</label></td>
                                            <tr>
                                            <tr>
                                                <td class="text-center" colspan="6"><label>JUMLAH UNSUR UTAMA DAN UNSUR
                                                        PENUNJANG</label></td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">
                                                    <?php
                                                if($total[0]->poin){ 
                                                    echo $total[0]->poin;
                                                }else{
                                                    echo '0';
                                                } 
                                            ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                if($total[0]->poin){ 
                                                    echo $total[0]->poin;
                                                }else{
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
                                    <tbody>
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
                                                    <p><?php echo $user->namaJabatan ?></p><br><br><br>
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
                                                    <p><?php echo $user->namaJabatan ?></p><br><br><br>
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
                                    <a href="<?php echo base_url() . 'kegiatan/printDupak/' . $user->name; ?>"
                                        target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                            class="fa fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div><!-- /.box-header -->
                    </div>
                </div>
            </div>

        </section>
    </div>
</body>

</html>