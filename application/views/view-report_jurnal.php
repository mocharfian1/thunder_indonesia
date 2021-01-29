

<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h4 class="panel-title pull-left" style="padding-top: 7.5px;">Jurnal Hari Ini</h4>
			<div class="btn-group pull-right">
			<a href="?export=true" class="btn btn-success btn-sm">Export Excel</a><!-- 
			<a href="#" class="btn btn-default btn-sm">## Delete</a>
			<a href="#" class="btn btn-default btn-sm">## Move</a> -->
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">

				<table width="100%" border="1" class="table table-responsive table-striped table-bordered" id="tb_report_jurnal">
					<thead style="text-align: center" class="bg-primary">
						<tr class="red">
							<th colspan="2">Div</th>
							<th colspan="2">Audio System</th>
							<th colspan="6" rowspan="2">Listen Warehouse</th>
							<th rowspan="3">Remarks</th>
						</tr>
						<tr class="red">
							<th colspan="2">Update</th>
							<th colspan="2"><?= date('d F Y'); ?></th>
						</tr>
						<tr class="red">
							<th>No.</th>
							<th>Product</th>
							<th>Brand</th>
							<th>Category</th>
							<th>Model / Specification</th>
							<th>In Repair</th>
							<th>Out</th>
							<th>Stock</th>
							<th>Balance</th>
							<th>Qty [Repair]</th>
							<!-- <th>Remarks</th> -->
						</tr>
						<tr class="bg-purple red r_width">
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
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
								<td><?= $value->in_repair; ?></td>
								<td><?= $value->jml_out; ?></td>
								<td><?= $value->qty+$value->in_repair+$value->jml_out; ?></td>
								<td><?= $value->qty; ?></td>
								<td><?= $value->in_repair; ?></td>
								<td></td>
							</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
				<table id="tb_header_fixed" class="table"></table>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	#tb_header_fixed {
	    position: fixed;
	    top: 0px; display:none;
	    background-color:white;
	}

	table > thead > tr > th {
	    text-align: center;
	}

	table#tb_report_jurnal > thead > tr.r_width > th {
		height: 20px;
	}
</style>