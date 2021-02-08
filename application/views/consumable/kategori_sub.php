<div class="row">
  <div class="col-md-6">
    <div id="table-wrapper">
      <center>
        <h2>SET UP <?php echo $page_title; ?></h2>
        <hr style="border-top: 3px double #8c8b8b;">
        <?php //$this->load->view('tpl_form_message');
        ?>
      </center>

      <br>
      <!-- <a href="<?php //echo base_url('kategori/add');
                    ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> ADD KATEGORI</a> -->
      <button type="button" id="addRow" class="btn btn-success" onclick="add_kategori()">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah Kategori
      </button>
      <br>
      <hr style="border-top: 3px double #8c8b8b;">

      <table id="tb_kategori" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($kategori)) { ?>
            <?php $no = 1; ?>
            <?php foreach ($kategori as $key => $value) { ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $value->id; ?></td>
                <td><?= $value->description; ?></td>
                <td>
                  <button onclick="edit(<?= $value->id; ?>)" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                  <button onclick="SK.delKat(<?= $value->id; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            <?php $no++;
            } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-md-6">
    <div id="table-wrapper">
      <center>
        <h2>SET UP <?php echo $page_title_2; ?></h2>
        <hr style="border-top: 3px double #8c8b8b;">
        <?php //$this->load->view('tpl_form_message');
        ?>
      </center>

      <br>
      <!-- <a href="<?php //echo base_url('kategori/add');
                    ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i> ADD KATEGORI</a> -->
      <button type="button" id="addRow" class="btn btn-success" onclick="add_sub_kategori()">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah Sub Kategori
      </button>
      <br>
      <hr style="border-top: 3px double #8c8b8b;">

      <table id="tb_kategori_sub" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Nama Sub Kategori</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($sub_kategori)) { ?>
            <?php $no = 1; ?>
            <?php foreach ($sub_kategori as $key => $value) { ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $value->id; ?></td>
                <td><?= $value->description; ?></td>
                <td><?= $value->sub_description; ?></td>
                <td>
                  <button onclick="edit(<?= $value->id; ?>)" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></button>
                  <button onclick="SK.delSubKat(<?= $value->id; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            <?php $no++;
            } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
