<div class="panel panel-default">
	  <div class="panel-heading">Filter By</div>
	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-lg-12">

				<table width="100%" border="1" class="table table-responsive table-striped table-bordered">
					<thead style="text-align: center" class="bg-primary">
						<tr>
							<td colspan="2">Div</td>
							<td colspan="2">Audio System</td>
							<td colspan="5" rowspan="2">Listen Warehouse</td>
							<td rowspan="3">Remarks</td>
						</tr>
						<tr>
							<td colspan="2">Update</td>
							<td colspan="2">4 Jan 2021</td>
						</tr>
						<tr>
							<td>No.</td>
							<td>Product</td>
							<td>Brand</td>
							<td>Category</td>
							<td>Model / Specification</td>
							<td>In Repair</td>
							<td>Stock</td>
							<td>Balance</td>
							<td>Qty [Repair]</td>
							<!-- <td>Remarks</td> -->
						</tr>
						<tr class="bg-success">
							<td colspan="10">&nbsp;</td>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; ?>
						<?php foreach ($allItem as $key => $value) { ?>
							<tr>
								<td><?= $no; ?></td>
								<td><?= $value->jenis_item; ?></td>
								<td><?= $value->merek; ?></td>
								<td><?= $value->kategori_item; ?></td>
								<td><?= $value->nama_item; ?></td>
								<td></td>
								<td><?= $value->qty; ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>