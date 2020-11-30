<form>
  <div class="form-group">
    <label for="barcode">Barcode</label>
    <input type="number" class="form-control" id="barcode" placeholder="Enter Barcode" onkeydown="ckBarcode(this)">
    <small id="notif_barcode" class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small>
    <input id="bc_cek" type="hidden">
  </div>
  <div class="form-group">
    <label for="barcode">Nama Barang</label>
    <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang">
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
  <div class="form-group">
    <label for="barcode">Kategori</label>
    <select class="form-control" id="kategori" onchange="setSub(this)">
    	<option disabled selected>-- Pilih Kategori --</option>
		<?php foreach ($kategori as $key => $value) { ?>
			<option value="<?= $value->id; ?>"><?= $value->description; ?></option>
		<?php } ?>
    </select>
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
  <div class="form-group">
    <label for="barcode">Sub Kategori</label>
    <select class="form-control" id="sub_kategori">
      
    </select>
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>

  <div class="form-group">
    <label for="qty">Qty</label>
    <input type="number" class="form-control" id="qty" placeholder="Qty">
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
  <div class="form-group">
    <label for="satuan">Satuan</label>
    <input type="text" class="form-control" id="satuan" placeholder="Satuan">
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
  <div class="form-group">
    <label for="min_stock">Minimal</label>
    <input type="number" class="form-control" id="min_stock" placeholder="Minimal Stock">
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
  <div class="form-group">
    <label for="max_stock">Maximal Stock</label>
    <input type="number" class="form-control" id="max_stock" placeholder="Maximal Stock">
    <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
  </div>
</form>