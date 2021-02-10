<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <!-- <table width="100%">
      <tbody>
        <tr>
          <td>Nomor Pemesanan : <?//$list_item_pemesanan[0]->no_pemesanan?></td>
          <td align="right" rowspan="2"><img width="70px" src="<?php// $logo; ?>" /></td>
        </tr>
        <tr>
          <td>Tanggal Pemesanan : <?//$list_item_pemesanan[0]->tgl_pemesanan?></td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
    <table width="100%">
      <tbody>
        <tr>
          <th>Informasi Pemesanan</th>
          <th width="50%" align="left">Informasi Acara</th>
        </tr>
        <tr>
          <td valign="top">
            <p>Pemesan</p>
            <p>Nama Pemesan : <?//$list_item_pemesanan[0]->nama_pemesan?></p>
            <p>Group :</p>
            <p>Lantai : <?//$list_item_pemesanan[0]->lantai?></p>
          </td>
          <td style="text-align:left">
            <p>
              <label>PIC : <?//$list_item_pemesanan[0]->pic?></label><br /><label>Nama Event : <?//$list_item_pemesanan[0]->nama_event?></label><br /><label>Alamat Venue : <?//$list_item_pemesanan[0]->alamat_venue?></label><br /><label>Loading IN : <?//$list_item_pemesanan[0]->loading_in?></label><br /><label>Loading OUT : <?//$list_item_pemesanan[0]->loading_out?></label>
            </p>
            <br>
            <table width="100%" style="text-align:center" cellpadding="3px">
              <tbody>
                <tr>
                  <th>Tanggal Acara</th>
                  <th>Sampai Acara</th>
                </tr>
                <tr>
                  <td> <?//$list_item_pemesanan[0]->ls_tanggal_acara[0]['tanggal_awal']?> </td>
                  <td> <?//$list_item_pemesanan[0]->ls_tanggal_acara[0]['tanggal_akhir']?> </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table> -->
    <table width="100%">
      <thead>
        <tr>
          <th align="left" colspan="5">Checklist Equipment</th>
          <th align="right" rowspan="4"><img width="70px" src="<?= $logo; ?>"></th>
        </tr>
        <tr style="font-size: 0.7em">
          <td width="23%">Nama Event</td>
          <td>: <?=$list_item_pemesanan[0]->nama_event?></td>
          <td></td>
          <td width="15%">Kepala Team</td>
          <td width="15%">:</td>
        </tr>
        <tr style="font-size: 0.7em">
          <td>Alamat</td>
          <td>: <?=$list_item_pemesanan[0]->alamat_venue?></td>
          <td></td>
          <td>Crew</td>
          <td>:</td>
        </tr>
        <tr style="font-size: 0.7em">
          <td>Tanggal Acara</td>
          <td>: <?=$list_item_pemesanan[0]->ls_tanggal_acara[0]['tanggal_awal']?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </thead>
    </table>
    <br>
    <table cellpadding="3px" cellspacing="0" border="1" width="100%" style="font-size: 11px">
      <tbody>
        <tr>
          <th>No</th>
          <th>Barcode</th>
          <th>Nama Barang</th>
          <th>Stock</th>
          <th>Jumlah</th>
          <th>Out</th>
          <th>In</th>
        </tr>
        <?php $n=0; ?>
        <?php foreach ($list_item_pemesanan as $list): ?>
          <?php
          $n++;
          ?>
          <tr>
            <td><?=$n?></td>
            <td><?=$list->barcode?></td>
            <td><?=$list->item_name?></td>
            <td><?=$list->h_stock?></td>
            <td><?=$list->qty?></td>
            <td><?=$list->is_out='checked'?'Y':' '?></td>
            <td><?=$list->is_in='checked'?'Y':' '?></td>
          </tr>

        <?php endforeach; ?>
      </tbody>
    </table>
    <br>
<p>Mengetahui:</p>
<table width="100%" style="text-align:center" cellpadding="5px">
  <tbody>
    <tr>
      <td>Kep. Team</td>
      <td>Kep. Divisi</td>
      <td>Kep. Gudang</td>
      <td>Staff Gudang</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

  </body>
</html>
