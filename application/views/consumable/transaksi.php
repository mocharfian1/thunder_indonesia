<div class="row">
  <div class="col-md-12">
    <div id="table-wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8">
                <div class="box box-warning">
                  
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-4">
                        <form>
                            <div class="form-group">
                              <label for="barcode">Date</label>
                              <input type="date" class="form-control" id="nama_barang" placeholder="Nama Barang">
                            </div>
                        </form>
                      </div>
                      <div class="col-md-8">
                        <form>
                            <div class="form-group">
                              <label for="barcode">Nomor Pemesanan</label>
                              <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang">
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <div class="col-md-4">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3 style="text-align: right">1</h3>
                    </div>
                    <div class="icon">
                      <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                      More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
                  
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="row">
                    <div class="col-md-2">
                      <form>
                        <div class="form-group">
                          <label for="barcode">Kategori</label>
                          <select class="form-control" id="kategori" onchange="setSub(this)">
                            <option disabled selected>-- Pilih Kategori --</option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value->id; ?>"><?= $value->description; ?></option>    
                            <?php } ?>

                            ?>
                          </select>
                          <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
                        </div>
                      </form>
                    </div>
                    <div class="col-md-2">
                      <form>
                        <div class="form-group">
                          <label for="barcode">Sub Kategori</label>
                          <select class="form-control" id="sub_kategori" onchange="setItem(this)">
                            <option disabled selected>-- Pilih Sub Kategori --</option>
                          </select>
                          <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
                        </div>
                      </form>
                    </div>
                    <div class="col-md-4">
                      <form>
                        <div class="form-group">
                          <label for="barcode">Barang</label>
                          <select class="form-control" id="item_select" onchange="">
                            <option disabled selected>-- Pilih Barang --</option>
                          </select>
                          <!-- <small class="form-text text-muted">Barcode otomatis mendeteksi jika ada kesamaan.</small> -->
                        </div>
                      </form>
                    </div>
                    <div class="col-md-2">
                      <form>
                        <div class="form-group">
                          <label for="barcode">Qty</label>
                          <input type="number" class="form-control" id="nama_barang" placeholder="Qty">
                        </div>
                      </form>
                    </div>
                    <div class="col-md-2">
                      <form>
                        <div class="form-group">
                          <label for="barcode">Action</label>
                          <button class="btn btn-success form-control">
                            <i class="fa fa-plus"></i>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <table class="table table-responsive table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Pensil 2B Warna Biru</td>
                  <td>20</td>
                  <td>20.000</td>
                  <td>
                    <button class="btn btn-xs btn-warning">
                      <i class="fa fa-edit">&nbsp;Edit</i>
                    </button>
                    <button class="btn btn-xs btn-danger">
                      <i class="fa fa-trash">&nbsp;Hapus</i>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="bg-aqua">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>50.000</th>
                  <th></th>
                </tr>
              </tfoot>
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
</style>