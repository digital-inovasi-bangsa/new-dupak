<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Divisi
      <small>Tambah, Ubah, Hapus</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <?php $this->load->view('includes/_flash'); ?>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="box">
          <div class="box-header">
            <!-- Button -->
            <div class="box-title">
              
                <a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>divisi/addNew">Tambah Data</a>
              
            </div>
            <!-- Search Box -->
            <div class="box-tools">
              <form action="<?php echo base_url() ?>divisi/divisiListing" method="POST" id="searchList">
                <div class="input-group">
                  <input type="text" name="searchText" value="<?php echo $searchText; ?>"
                    class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari Data" />
                  <div class="input-group-btn">
                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
              <tr>
                <th>Id Divisi</th>
                <th>Nama Divisi</th>
                <th>Edit</th>
              </tr>
              <?php
                    if(!empty($divisiRecords))
                    {
                        foreach($divisiRecords as $record)
                        {
                    ?>
              <tr>
                <td><?php echo $record->idDivisi ?></td>
                <td><?php echo $record->namaDivisi ?></td>
                <td>
                  <a href="<?php echo base_url().'divisi/editOld/'.$record->idDivisi; ?>"><i
                      class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                  <a href="#" data-iddivisi="<?php echo $record->idDivisi; ?>" class="deleteDivisi"><i
                      class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                </td>
              </tr>
              <?php
                        }
                    }
                    ?>
            </table>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/deleteDivisi.js" charset="utf-8"></script>
<!--
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "divisi/DivisiListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
-->