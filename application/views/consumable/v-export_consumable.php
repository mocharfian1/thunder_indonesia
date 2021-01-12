<table id="tb_item" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
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
      <th>Indikator</th>
      <th>Max Stock</th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($barang)){ ?>
      <?php $no=1; foreach ($barang as $key => $value) { ?>
        <?php $ind = (int)((int)$value->qty - (int)$value->min_stock); ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= $value->barcode; ?></td>
          <td><?= $value->item_name; ?></td>
          <td><?= $value->description; ?></td>
          <td><?= $value->sub_description; ?></td>
          <td><?= $value->qty; ?></td>
          <td><?= $value->satuan; ?></td>
          <td><?= $value->min_stock; ?></td>
          <td <?= $ind<10?'class="btn-danger"':''; ?>><?= (int)((int)$value->qty - (int)$value->min_stock); ?></td>
          <td><?= $value->max_stock; ?></td>
        </tr>
      <?php $no++; } ?>
    <?php } ?>
  </tbody>
</table>