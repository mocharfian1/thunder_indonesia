$('.datatable').DataTable();

var items = [];

class Sparepart {
	static kat = 0;
	static sub_kat = 0;

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

		console.log(items);
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

class Transaksi {

}

var SP = new Sparepart();
var SK = new SubKat();

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

