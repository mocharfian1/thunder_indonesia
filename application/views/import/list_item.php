<div class="row">
  <div class="col-md-12">
    <div id="table-wrapper">
        <center>
          <h2>SET UP <?php echo $page_title; ?></h2>
          <hr style="border-top: 3px double #8c8b8b;">
          <?php //$this->load->view('tpl_form_message'); ?>
        </center>

        <br>
        <!-- <a href="<?php //echo base_url('kategori/add'); ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> ADD KATEGORI</a> -->
        <br>
        <!-- <hr style="border-top: 3px double #8c8b8b;"> -->
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary" onclick="opForm()"><i class="glyphicon glyphicon-file"></i>&nbsp;Upload Excel</button>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <table id="tb_item" class="table table-bordered table-striped table-hover datatable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>ID</th>
                  <th>Tanggal Import</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($history)){ ?>
                  <?php $no=1; foreach ($history as $key => $value) { ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $value->barcode; ?></td>
                      <td><?= $value->item_name; ?></td>
                      <td><?= $value->description; ?></td>
                    </tr>
                  <?php $no++; } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>


