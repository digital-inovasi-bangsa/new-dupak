<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kegiatan Harian
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Calendar</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <a class="btn btn-primary btn-sm btn-block" style="margin-bottom: 20px;"
          href="<?php echo base_url(); ?>kegiatan/addNew">
          <i class="fa fa-plus"></i> Tambah Kegiatan
        </a>
        <div class="box box-solid">
          <div class="box-header with-border">
            <h4 class="box-title">Keterangan</h4>
          </div>
          <div class="box-body">
            <!-- the events -->
            <div id="external-events">
              <div class="external-event" style="background-color: gray;color: white">Belum Upload Bukti</div>
              <div class="external-event" style="background-color: purple;color: white">Telah diajukan</div>
              <div class="external-event" style="background-color: green;color: white">Disetujui</div>
              <div class="external-event" style="background-color: red;color: white">Ditolak</div>
              <div class="external-event" style="background-color: black;color: white">Kadaluarsa</div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <div id="calendar"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->
<script>
  var dataCalendar;
  $(document).ready(function () {
      var hasil;
      var result = $.ajax({
      url: '<?php echo base_url(); ?>kegiatan/loadCalendar',
      type: "GET",
      dataType: "json",
      success: function (data) {
        hasil = data;
        return hasil;
        // console.log(dataCalendar);
      }
    });
    console.log(hasil);
    var calendar = $('#calendar').fullCalendar({
      editable: true,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },
      events: "<?php echo base_url(); ?>kegiatan/loadCalendar",
    });
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deletePangkat.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>