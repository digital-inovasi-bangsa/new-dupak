
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dupak Basarnas | print Spmk <?php echo $user->name ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-1 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-10 invoice-col">
          <h5 class="text-center">SURAT PERNYATAAN MELAKUKAN KEGIATAN <?php echo $kegiatan[0]['namaUnsur'] ?><br><br><br><br><br></h5>
        </div>
        <!-- /.col -->
        <div class="col-sm-1 invoice-col">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row invoice-info">
        <div class="col-sm-5 invoice-col">
            <p>Yang bertanda tangan dibawah ini</p>
            <p>Nama</p>
            <p>NIP</p>
            <p>Pangkat/golongan ruang</p>
            <p>Jabatan</p>
            <p>Unit Kerja</p>
            <p>Menyatakan bahwa</p>
            <p>Nama</p>
            <p>NIP</p>
            <p>Pangkat/golongan ruang</p>
            <p>Jabatan</p>
            <p>Unit Kerja</p>
            <p>telah mengikuti <?php echo $kegiatan[0]['namaUnsur'] ?> sebagai berikut</p>
        </div>
        <!-- /.col -->
        <div class="col-sm-7 invoice-col">
            <p>: </p>
            <p>: <?php echo $atasan->name ?></p>
            <p>: <?php echo $atasan->nip ?></p>
            <p>: <?php echo $atasan->namaJabatan ?></p>
            <p>: <?php echo $atasan->namaPangkat ?></p>
            <p>: <?php echo $atasan->namaDivisi ?></p>
            <p>: </p>
            <p>: <?php echo $user->name ?></p>
            <p>: <?php echo $user->nip ?></p>
            <p>: <?php echo $user->namaJabatan ?></p>
            <p>: <?php echo $user->namaPangkat ?></p>
            <p>: <?php echo $user->namaDivisi ?></p>
            <p>: </p>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Kegiatan</th>
              <th>Periode</th>
              <th>Angka Kredit</th>
              <th>Volume</th>
              <th>Total Angka Kredit</th>
            </tr>
            </thead>
            <tbody>
            <?php
                    if(!empty($kegiatan))
                    {
                        $no = 1;
                        $arr = 0;
                        foreach($kegiatan as $record)
                        {
                    ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $record['keterangan'] ?></td>
              <td><?php echo $periode ?></td>
              <td><?php echo $record['poin'] ?></td>
              <td><?php echo $record['volume'] ?></td>
              <td><?php echo $record['point'] ?></td>
            </tr>
            <?php
                        }
                    }
                    ?>
            <tr>
              <td colspan="4" class="text-right">Total</td>
              <td><?php echo $total[0]->volume ?></td>
              <td><?php echo $total[0]->poin ?></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
            <p class="text-center">Mengetahui,</p>
            <p class="text-center">Atasan Langsung</p>
            <br><br><br><br>
            <p class="text-center"><?php echo $atasan->name ?></p>
            <p class="text-center"><?php echo $atasan->nip ?></p>
            <br><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>