$('#tb_item').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          {
              extend: 'print',
              exportOptions: {
                  columns: '0,1,2,3,4,5,6,7,8,9'
              }
          },
        ]
    } );


var itemsInTable = [];

function setBtnDelItem(id=null,server=null){
	return `<button class='btn btn-danger btn-xs' onclick="TR.delItem(`+id+`,`+server+`)"><span class="fa fa-trash"></span></button>`;
}
// var aDemoItems = [
//     {
//         "no":1,
//         "nama_barang":"LanTest101",
//         "qty":"x1",
//         "total":"yLanTest101",
//         "action":btn
//     },
//     {
//         "no":1,
//         "nama_barang":"LanTest101",
//         "qty":"x1",
//         "total":"yLanTest101",
//         "action":btn
//     },
//     {
//         "no":1,
//         "nama_barang":"LanTest101",
//         "qty":"x1",
//         "total":"yLanTest101",
//         "action":btn
//     }
// ];
var tb_list_transaction = $('.tb_list_transaction').DataTable();
var datatable = $('.datatable').DataTable({
	"language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
    "data" : [],
    "columns" : [
        { "title":"No.","data":"no" },
        { "title":"Barcode","data" : "barcode" },
        { "title":"Kategori","data" : "kategori" },
        { "title":"Sub Kategori","data" : "sub_kategori" },
        { "title":"Nama Barang","data" : "nama_barang" },
        { "title":"Qty","data" : "qty" },
        { "title":"Action","data" : "action" }
    ],"initComplete": function(settings, json) {
	    if(no_transaksi!=''){
	    	$.post(URL + '/consumable/getEditItemConsumable', { no_transaksi:no_transaksi }).done((data) => {
	    		var d = data.result;
	    		// var insertTable = [];

				for (var i = 0; i < data.result.length; i++) {

					itemsInTable.push({
						no : i+1,
						id : d[i].id,
						barcode : d[i].barcode,
						nama_barang : d[i].item_name,
						kategori : d[i].nm_kat,
						sub_kategori : d[i].nm_sub_kat,
						qty : parseInt(d[i].qty),
						server : 1,
						action : setBtnDelItem(d[i].id,1)
					});
				}
				// console.log(insertTable);

	    		datatable.clear();
				datatable.rows.add(itemsInTable);
				datatable.draw();
				// $('div.loading').remove();
			}).fail((e) => {

			});
	    }
  	}
});

var items = [];

class Sparepart {
 	kat = 0;
	sub_kat = 0;

	add(type = null) {
		$.confirm({
			title: 'Tambah Barang ( Consumable )',
			content: function () {
				var self = this;
				return $.post(URL + 'consumable/v_add_item').done((data) => {
					self.setContent(data);
				});
			},
			buttons: {
				ok: {
					text: 'Simpan',
					btnClass: 'btn-primary',
					action: function () {
						var self = this.$content;

						let barcode = self.find('#barcode').val();
						let nama_barang = self.find('#nama_barang').val();
						let kategori = self.find('#kategori').val();
						let sub_kategori = self.find('#sub_kategori').val();
						let qty = self.find('#qty').val();
						let satuan = self.find('#satuan').val();
						let min_stock = self.find('#min_stock').val();
						let max_stock = self.find('#max_stock').val();

						$.post(URL + 'consumable/submitAdd', {
							type: type,
							barcode: barcode,
							item_name: nama_barang,
							id_kategori: kategori,
							id_sub_kategori: sub_kategori,
							qty: qty,
							satuan: satuan,
							min_stock: min_stock,
							max_stock: max_stock
						}).done((d) => {
							if (d.success == true) {
								alert(d.message);
								window.location.reload();
							} else {
								alert(d.message);
							}
						}).fail((e) => {
							alert('Gagal menambahkan Data');
						});
					}
				}, close: {
					text: 'Batal',
					btnClass: 'btn-danger'
				}
			}
		});
	}

	setSub(e) {
		items = [];
		$('#sub_kategori').html(`<option disabled selected>-- Pilih Sub Kategori --</option>`);
		var id_kat = $(e).val();
		this.kat = id_kat;

		$.post(URL + 'consumable/getSubKategoriConsumable', { id_kat: id_kat }).done((data) => {

			for (let i = 0; i < data.data.length; i++) {
				let opt = new Option(data.data[i].sub_description, data.data[i].id);
				$('#sub_kategori').append(opt);
			}
		}).fail((e) => {

		});
	}

	getBarcode(e) {
		let barcode = $(e).val();

		$.post(URL + 'consumable/chBarcode', { barcode: barcode }).done((data) => {
			$('#notif_barcode').text(data.message);
		}).fail((e) => {

		});
	}

	setItem(e) {

		$('#item_select').removeClass('hidden');
		$('#item_select').select2();

		this.sub_kat = $(e).val();
		var kat = this.kat;

		$('#item_select').html('<option disabled selected>-- Pilih Item --</option>');

		$.post(URL + '/consumable/getItemConsumable', { id_sub: $(e).val(), id_kat: kat }).done((data) => {

			var i;
			for (i = 0; i < data.data.length; i++) {
				var value = data.data[i].id;
				var optSub = new Option(data.data[i].item_name, value);
				$('#item_select').append(optSub);

				items.push({
					id: value,
					item_name: data.data[i].item_name,
					barcode: data.data[i].barcode,
					min_stock: data.data[i].min_stock,
					max_stock: data.data[i].max_stock
				});
			}
		}).fail((e) => {

		});

		// console.log(items);
	}
}

class SubKat {
	addKategori() {
		$.confirm({
			title: `Tambah Kategori`,
			content: `
				<form>
					<div class="form-group">
					    <input id="nama_kategori" type='text' class="form-control" placeholder="Masukkan Nama Kategori">
					</div>
				</form>
			`,
			buttons: {
				submit: {
					text: 'Simpan',
					btnClass: 'btn-primary',
					action: function () {
						var self = this;
						var nama_kategori = self.$content.find('#nama_kategori').val();

						if (nama_kategori.trim() == '') {
							alert('Nama kategori belum diisi.');
						} else {
							$.post(URL + 'consumable/create_kategori', { nama_kategori: nama_kategori }).done((data) => {
								alert(data.message);
								window.location.reload();
							}).fail((e) => {

							});
						}

					}
				}, cancel: {
					text: 'Batal'
				}
			}
		});
	}

	addSubKategori() {
		$.confirm({
			title: `Tambah Sub Kategori`,
			content: function () {
				var self = this;
				return $.get(URL + 'consumable/getKategoriConsumable').done((data) => {
					var opt = `<option disabled selected>-- Pilih Kategori --</option>`;

					if (data.success == true) {
						for (var i = 0; i < data.data.length; i++) {
							opt += `<option value=` + data.data[i].id + `>` + data.data[i].description + `</option>`;
						}

						self.setContent(`
							<form>
								<div class="form-group">
									<select class="form-control" id="kategori">
										`+ opt + `
									</select>
								</div>
								<div class="form-group">
								    <input id="nama_sub_kategori" type='text' class="form-control" placeholder="Masukkan Nama Kategori">
								</div>
							</form>
						`);
					} else {
						self.setContent(`
							Data Kategori belum ada.
						`);
					}

				}).fail((e) => {

				});
			},
			buttons: {
				submit: {
					text: 'Simpan',
					btnClass: 'btn-primary',
					action: function () {
						var self = this;
						var kategori = self.$content.find('#kategori').val();
						var nama_sub_kategori = self.$content.find('#nama_sub_kategori').val();

						$.post(URL + 'consumable/create_sub_kategori', { kategori: kategori, nama_sub_kategori: nama_sub_kategori }).done((data) => {
							alert(data.message);
							window.location.reload();
						}).fail((e) => {

						});
					}
				}, cancel: {
					text: 'Batal'
				}
			}
		});
	}

	delKat(id = null) {
		$.confirm({
			title: '',
			content: 'Anda ingin menghapus kategori ini?',
			buttons: {
				submit: {
					text: 'Hapus',
					btnClass: 'btn-danger',
					action: () => {

						$.post(URL + 'consumable/deleteSK', { type: 'KAT', id: id }).done((data) => {
							if (data.success == true) {
								alert(data.message);
								window.location.reload();
							}
						}).fail((e) => {
							alert('Gagal menghapus data.');
							window.location.reload();
						});
					}
				}, cancel: {
					text: 'Batal'
				}
			}
		});

	}

	delSubKat(id = null) {
		$.confirm({
			title: '',
			content: 'Anda ingin menghapus sub kategori ini?',
			buttons: {
				submit: {
					text: 'Hapus',
					btnClass: 'btn-danger',
					action: () => {
						$.post(URL + 'consumable/deleteSK', { type: 'SUB', id: id }).done((data) => {
							if (data.success == true) {
								alert(data.message);
								window.location.reload();
							}
						}).fail((e) => {
							alert('Gagal menghapus data.');
							window.location.reload();
						});
					}
				}, cancel: {
					text: 'Batal'
				}
			}
		});
	}

	delItem(id = null) {
		$.confirm({
			title: '',
			content: 'Anda ingin menghapus item ini?',
			buttons: {
				submit: {
					text: 'Hapus',
					btnClass: 'btn-danger',
					action: () => {
						$.post(URL + 'consumable/deleteSK', { type: 'ITEM', id: id }).done((data) => {
							if (data.success == true) {
								alert(data.message);
								window.location.reload();
							}
						}).fail((e) => {
							alert('Gagal menghapus data.');
							window.location.reload();
						});
					}
				}, cancel: {
					text: 'Batal'
				}
			}
		});
	}

	edit() {

	}
}

var id_ITEM = 0;
var itemsInTable = [];
var itemsDelete = [];

// function setValue(x = null){
// 	id_ITEM = x;
// }

class Transaksi {
	importItem(){
		$.confirm({
			title:'Upload File',
			content:`
				<form id="uploadXLS" enctype="multipart/form-data" method="post">
					<div class="form-group">
						<label for="file-import">Pilih FIle</label>
						<input class="form-control" id="file-import" type="file" accept=".xls,.xlsx"/>
					</div>
				</form>
			`,
			buttons:{
				submit:{
					text:'Submit',
					btnClass:'btn-success',
					action:()=>{
						var self = this;

						var fd = new FormData();
						var files = $('#file-import')[0].files;
						fd.append('file_input',files[0]);

						$.ajax({
							url: '/import/upload_consumable?jenis='+jenis,
							type: 'post',
							data: fd,
							contentType: false,
							processData: false,
							success: function(d){

								$.confirm({
									title:'LIST ITEM IMPORT',
									columnClass:'col-12',
									content:d,
									buttons:{
										submit:{
											text:'Proses',
											btnClass:'btn-primary',
											action:()=>{
												var id = $(d).find('input#id_import').val();

												$.post(URL+'import/submit_import_consumable',{id:id}).done((data_import)=>{
													$.alert({
														title:'Alert',
														content:data_import.message,
														columnClass:'col-md-8 col-md-offset-2'
													});
												}).fail((e)=>{

												});
											}
										},
										cancel:{
											text:'Cancel'
										}
									}
								});
							},
						});
					}
				},
				cancel:{
					text:'Cancel',
					btnClass:'btn-default'
				}
			}
		});
	}

	addItemTransaksi(){
		var id_brg = $('#item_select').val();
		var qty_barang = $('#qty_barang').val();

		$.post(URL+'consumable/getItemById',{id:id_brg,qty:qty_barang}).done((data)=>{
			var d = data.result;
			var d_ITEMS = itemsInTable.findIndex(({barcode}) => barcode == data.result.barcode);
			// console.log(d_ITEMS);
			if(d_ITEMS < 0){
				// alert('OKE');

				var insertTable = {
					id : d.id,
					barcode : d.barcode,
					nama_barang : d.item_name,
					kategori : d.nm_kat,
					sub_kategori : d.nm_sub_kat,
					qty : parseInt(qty_barang),
					action : setBtnDelItem(d.id)
				}

				// itemsInTable[d_ITEMS]
				itemsInTable.push(insertTable);
			}else{
				var qtyItem = itemsInTable[d_ITEMS].qty;
				var updateTable = {
					id : d.id,
					barcode : d.barcode,
					nama_barang : d.item_name,
					kategori : d.nm_kat,
					sub_kategori : d.nm_sub_kat,
					qty : parseInt(qty_barang) + parseInt(qtyItem),
					action : setBtnDelItem(d.id)
				}

				itemsInTable[d_ITEMS] = updateTable;
			}

			for (var i = 0; i < itemsInTable.length; i++) {
				itemsInTable[i].no = i+1;
			}

			datatable.clear();
			datatable.rows.add(itemsInTable);
			datatable.draw();

			// console.log(itemsInTable);
		}).fail((e)=>{

		});
	}

	submitTransaction(){
		$.confirm({
			title:'',
			content:no_transaksi==''?'Submit?':'Anda yakin ingin menyimpan perubahan ini?',
			buttons:{
				submit:{
					text:'Ya',
					btnClass:'btn-success',
					action:function(){
						for (var i = 0; i < itemsInTable.length; i++) {
							delete itemsInTable[i].action;
						}

						$.post(URL+'consumable/submitTransaction',{no_transaksi:no_transaksi,data:itemsInTable}).done((data)=>{
							// alert(data.success);
							if(data.success === true){
								$.dialog(data.message);
								window.location.href = URL+'consumable/list_transaksi';
							}else{
								$.dialog(data.message);
							}
						}).fail((e)=>{

						});
					}
				},cancel:{
					text:'Batal'
				}
			}
		});

	}

	submitUpdateTransaction(){
		for (var i = 0; i < itemsInTable.length; i++) {
			delete itemsInTable[i].action;
		}

		$.post(URL+'consumable/submitUpdateTransaction',{no_transaksi:no_transaksi,data:itemsInTable,dataDelete:itemsDelete}).done((data)=>{

		}).fail((e)=>{

		});
	}

	rubahTransaksi(x = null){
		window.location.href = '/consumable/consumable_transaksi?no_transaksi='+x;
	}

	hapusTransaksi(x = null){

	}

	delItem(x=null,server=null){
		var indexItem = itemsInTable.findIndex(({id}) => id == x);
		// alert();
		itemsInTable.splice(itemsInTable.findIndex(({id}) => id == x),1);
		// if(server==1){
		// 	$.post(URL+'consumable/delItemTransaction',{no_transaksi:no_transaksi,id:x}).done((data)=>{
		// 		itemsInTable.splice(itemsInTable.findIndex(({id}) => id == x),1);
		// 	}).fail((e)=>{

		// 	});

		// 	// itemsDelete.push(parseInt(itemsInTable[indexItem].id));
		// 	itemsInTable.splice(itemsInTable.findIndex(({id}) => id == x),1);
		// }else{
		// 	itemsInTable.splice(itemsInTable.findIndex(({id}) => id == x),1);
		// }


		// console.log(itemsDelete);
		datatable.clear();
		datatable.rows.add(itemsInTable);
		datatable.draw();
	}
}

var SP = new Sparepart();
var SK = new SubKat();
var TR = new Transaksi();

function add_item(type = null) {
	SP.add(type);
}

function setSub(e) {
	SP.setSub(e);
}

function setItem(e = null) {
	SP.setItem(e);
}

function ckBarcode(e) {
	setTimeout(() => {
		SP.getBarcode(e);
	}, 100);
}

function add_kategori() {
	SK.addKategori();
}

function add_sub_kategori() {
	SK.addSubKategori();
}
