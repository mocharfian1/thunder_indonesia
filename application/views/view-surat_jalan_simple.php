<table width="100%"  style="font-size: 0.8em">
	<thead>
		<!-- <tr>
			<th colspan="5">PT. ARCOMEGA DIGITAL PERKASA - Delivery Note - View</th>
		</tr> -->
		<tr>
			<td colspan="4" width="50%" style="vertical-align: top;">
				<h2>Surat Jalan</h2>
			</td>
		</tr>
	</thead>
	<tbody>
		<!-- <tr>
			<td colspan="5" height="20px"></td>
		</tr> -->
		<tr>
			<td style="vertical-align: top"><?= strtoupper($r[0]->nama_pemesan); ?></td>
			<td style="text-align: right; border-right: solid 2px black; padding-right: 10px">
				<b>Delivery Date</b><br>
				<span><?= date('d M Y',strtotime($r[0]->tgl_pemesanan)); ?></span><br><br>

				<b>Order Number</b><br>
				<span><?= strtoupper($r[0]->no_pemesanan); ?></span>

			</td>
			<td style="padding-left: 10px; vertical-align: top">
				Jl.Asem No.54 RT.003/RW.004,<br>
				Kelapa Dua Wetan - Ciracas<br>
				Jakarta Timur - 13730<br>
				84.864.775.6-009.000 <br>
				<b>No. SO:</b> <?=$r[0]->no_sales_order?>
			</td>
			<td colspan="3" width="50%" style="text-align: right">
				<img width="70px" src="<?= $logo; ?>" />
			</td>
		</tr>
		<tr><td colspan="4"><br></td></tr>
	</tbody>
</table>
<table width="100%" style="font-size: 0.8em">
	<tbody>
		<tr>
			<td>ACARA : <?= strtoupper($r[0]->nama_event); ?>&nbsp;<?= date('d F Y',strtotime(($r[0]->tanggal_acara))); ?>&nbsp;LOADING (<?= $r[0]->loading_in; ?>)&nbsp;LOKASI&nbsp;:&nbsp;<?= $r[0]->alamat_venue; ?></td>
		</tr>
	</tbody>
</table>

<table width="100%" border="1" cellspacing="0" style="font-size: 11px;">
  <thead>
    <tr style="background-color: yellow;">
      <th width="30px">No.</th>
      <th>Description </th>
      <th>Qty</th>
    </tr>
  </thead>
  <tbody>
    <?php $no_kat=1; ?>
    <?php if(!empty($kat)){ ?>
      <?php foreach ($kat as $key => $value) { ?>
          <tr>
            <td class="b t" ><?= $no_kat; ?></td>
            <td class="b" style="background-color: <?= empty($value->nama_kategori)?'green':'blue'; ?>; color: white;"><b><?= empty($value->nama_kategori)?'TANPA KATEGORI':$value->nama_kategori; ?></td></b>
            <td class="b"></td>
          </tr>
          <?php foreach ($r as $k => $v) { ?>
            <?php if($v->id_kat==$value->id){ ?>
              <tr>
                <td class="b"></td>
                <!-- <td class="b t"><?= $v->satuan; ?></td> -->
                <td class="b"><?= $v->item_name; ?></td>
                <td class="b t" width="10%" style="padding-right: 0; text-align: center;"><?= $v->qty; ?></td>
              </tr>
              <?php if($v->jenis_item=='PAKET'){ ?>
                <?php foreach ($v->isi_paket as $kp => $vp) { ?>
                  <tr>
                    <td class="b"></td>
                    <td class="b t"></td>
                    <td class="b t"></td>
                    <td class="b" width="10%" style="padding-right: 20px; text-align: center;">---- <?= $vp->item_name; ?> <b>[<?= $vp->item_qty; ?> <?= $vp->satuan; ?>]</b></td>

                  </tr>
                <?php } ?>

              <?php } ?>
            <?php } ?>
          <?php } ?>
          <?php $no_kat++; ?>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>

<hr>
<table width="100%">
	<tbody>
		<tr>
			<td>Dibuat Oleh, <br>Kepala Gudang</td>
			<td>Disiapkan Oleh, <br>Staff Gudang</td>
			<td>Dibawa Oleh, <br>Driver</td>
			<td>Diketahui Oleh, <br>Sekuriti</td>
			<td>Penerima,</td>
		</tr>
		<tr>
			<td><br>&nbsp;<br></td>
		</tr>
		<tr>
			<td><br>&nbsp;<br></td>
		</tr>
		<tr>
			<td><br>&nbsp;<br></td>
		</tr>
		<tr>
			<td colspan="5" style="font-size:9px"><i>*Tanda tangan disertakan Nama Jelas dan Tanggal<i></td>
		</tr>
	</tbody>
</table>
