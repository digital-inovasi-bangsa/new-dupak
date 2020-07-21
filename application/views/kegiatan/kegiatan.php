<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $pageTitle; ?>
    </h1>
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
        <?php
                    if(!empty($kegiatan))
                    {
                        $no = 1;
                        foreach($kegiatan as $record)
                        {
                    ?>
        <div class="alert" style="background-color: gray;color: white">
          <a class="icon fa fa-upload fa-2x text-white pull-right" href="<?php echo base_url(); ?>kegiatan/uploadBukti/<?php echo $record->idKegiatanHarian?>">
          </a>
          <h4><i class="icon fa fa-warning fa-sm"></i> <?php echo $record->status ?></h4>
          Kegiatan : <?php echo $record->namaButir ?> <br>
          Tanggal Kegiatan : <?php echo $record->tanggalMulai ?> - <?php echo $record->tanggalSelesai ?>
        </div>
        <?php } 
                        }?>

        <div class="box box-warning">
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

<script>
  var dataCalendar;
  $(document).ready(function () {
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
    var calendar = $('#calendar').fullCalendar({
      contentHeight: 600,
      eventClick: function(info) {
        var eventObj = info.event;

        if (eventObj.url) {
          alert(
            'Clicked ' + eventObj.title + '.\n' +
            'Will open ' + eventObj.url + ' in a new tab'
          );

          window.open(eventObj.url);

          info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
        } else {
          alert('Clicked ' + eventObj.title);
        }
      },
      editable: false,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
      },
      events: "<?php echo base_url(); ?>kegiatan/loadCalendar",
      eventRender: function(event, element) {
      $(element).tooltip({title: event.description});             
     }
    });
    calendar.render();
  });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deletePangkat.js" charset="utf-8"></script>