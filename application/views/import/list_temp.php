<div>
    <table class="table table-responsive tb-init">
        <thead>
            <tr>
                <th>No.</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) { ?>
            	<tr>
            		<td></td>
            		<td><?= $value['barcode']; ?></td>
            		<td><?= $value['nama_item']; ?></td>
            		<td><?= $value['qty']; ?></td>
            		<td><?= $value['kategori']; ?></td>
            		<td><?= $value['sub_kategori']; ?></td>
            		<td><?= $value['harga_beli']; ?></td>
            		<td><?= $value['harga_jual']; ?></td>
            	</tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $('.tb-init').DataTable();
</script>