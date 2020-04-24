
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>SISTEM INFORMASI LAPORAN DAFTAR USULAN PENILAIAN ANGKA KREDIT (DUPAK) RESCUER BASARNAS YOGYAKARTA</b>
        </div>
        <strong>SUZANTI INDAH SARI - 160101219</strong>
    </footer>

    <!-- jQuery 2.1.4 -->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
  <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
  <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
  </body>
</html>