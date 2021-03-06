<?php if (!empty($is_consumable) && $is_consumable == 'CONSUMABLE') { ?>

    <div>
        <input type="hidden" id="id_import" value=<?= $id_history; ?> />
        <table class="table table-responsive tb-init">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Barcode</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Min Stock</th>
                    <th>Max Stock</th>
                    <th>Sudah Ada</th>
                    <!-- <th>Pilih&nbsp;Semua&nbsp;<input type="checkbox" name="ck"  onclick="trCheck(this)"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td></td>
                        <td><?= $value['barcode']; ?></td>
                        <td><?= $value['kategori']; ?></td>
                        <td><?= $value['sub_kategori']; ?></td>
                        <td><?= $value['nama_item']; ?></td>
                        <td><?= $value['qty']; ?></td>
                        <td><?= $value['min_stock']; ?></td>
                        <td><?= $value['max_stock']; ?></td>
                        <td><input class="duplicate" type="checkbox" <?= $value['duplicate'] == 1 ? 'checked' : ''; ?> readonly value="okokokokoko" /></td>
                        <!-- <td><input type="checkbox" class="pilih" ></td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <style type="text/css">
            input.duplicate[type="checkbox"][readonly] {
                pointer-events: none;
            }
        </style>
    </div>

    <script>
        $('.tb-init').DataTable({
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }]
        });
    </script>

<?php } else { ?>


    <div>
        <input type="hidden" id="id_import" value=<?= $id_history; ?> />
        <table class="table table-responsive tb-init">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Barcode</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Sudah Ada</th>
                    <!-- <th>Pilih&nbsp;Semua&nbsp;<input type="checkbox" name="ck"  onclick="trCheck(this)"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td></td>
                        <td><?= $value['barcode']; ?></td>
                        <td><?= $value['kategori']; ?></td>
                        <td><?= $value['sub_kategori']; ?></td>
                        <td><?= $value['nama_item']; ?></td>
                        <td><?= $value['qty']; ?></td>
                        <td><input class="duplicate" type="checkbox" <?= $value['duplicate'] == 1 ? 'checked' : ''; ?> readonly value="okokokokoko" /></td>
                        <!-- <td><input type="checkbox" class="pilih" ></td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <style type="text/css">
            input.duplicate[type="checkbox"][readonly] {
                pointer-events: none;
            }
        </style>
    </div>

    <script>
        $('.tb-init').DataTable({
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }]
        });
    </script>
<?php } ?>