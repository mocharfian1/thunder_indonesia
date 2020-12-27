<div class="row">
  <div class="col-md-12">
    <div id="table-wrapper">
        <div class="row">
          <div class="col-md-12">
            <center><h3>CONSUMABLE TRANSACTION</h3></center>
            <hr style="border: 1px black dotted">
            <button onclick="window.location.href = '/consumable/consumable_transaksi'" class="btn btn-success"><span class="fa fa-plus">&nbsp;Tambah Transaksi</span></button>
            <hr style="border: 1px black dotted">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-responsive table-striped table-hover tb_list_transaction">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Transaksi</th>
                  <th>Jumlah Item</th>
                  <th>Dibuat Tanggal</th>
                  <th>Dibuat Oleh</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($list_transaction)){ $no=1; ?>
                  <?php foreach ($list_transaction as $key => $value) { ?>
                      <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value->no_transaksi; ?></td>
                        <td><?= $value->jml; ?></td>
                        <td><?= date('d F Y',strtotime($value->insert_date)); ?></td>
                        <td>-</td>
                        <td>
                          <button class="btn btn-xs btn-warning" onclick="TR.rubahTransaksi('<?= $value->no_transaksi; ?>')">
                            <i class="fa fa-edit">&nbsp;Edit</i>
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
  </div>
</div>

<style type="text/css">
  td {
    /*border: 1px solid #000;*/
}

tr td:last-child {
    width: 1%;
    white-space: nowrap;
}

table thead tr {
  background-color: #3c8dbc;
  color: white;
}
</style>