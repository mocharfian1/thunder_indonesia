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
        <button type="button" id="addRow" class="btn btn-success" onclick="add_item(`<?= $_GET['type']; ?>`)">
            <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah Item
        </button>
        <button type="button" id="addRow" class="btn btn-warning" onclick="add_item(`<?= $_GET['type']; ?>`)">
            <span class="glyphicon glyphicon-plus"></span>&nbsp;Transaksi
        </button>
        <br>
        <hr style="border-top: 3px double #8c8b8b;">

        <table id="tb_item" class="table table-bordered table-striped table-hover datatable" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Barcode</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Sub Kategori</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Min Stock</th>
              <th>Max Stock</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($barang)){ ?>
              <?php $no=1; foreach ($barang as $key => $value) { ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $value->barcode; ?></td>
                  <td><?= $value->item_name; ?></td>
                  <td><?= $value->description; ?></td>
                  <td><?= $value->sub_description; ?></td>
                  <td><?= $value->qty; ?></td>
                  <td><?= $value->satuan; ?></td>
                  <td><?= $value->min_stock; ?></td>
                  <td><?= $value->max_stock; ?></td>
                  <td>
                    <button class="btn btn-warning btn-xs">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-xs" onclick="SK.delItem(<?= $value->id; ?>)">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php $no++; } ?>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </div>
</div>