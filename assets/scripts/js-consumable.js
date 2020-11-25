$('.datatable').DataTable();

class Sparepart{
	add(){
		$.confirm({
			title:'Tambah Barang ( Consumable )',
			content:function(){
				var self = this;
				return $.post(URL+'consumable/v_addSparepart').done((data)=>{
					self.setContent(data);
				});
			},
			buttons:{
				ok:{
					text:'Simpan',
					btnClass:'btn-primary',
					action:function(){
						var self = this.$content;

						let barcode = self.find('#barcode').val();
						let nama_barang = self.find('#nama_barang').val();
						let kategori = self.find('#kategori').val();
						let sub_kategori = self.find('#sub_kategori').val();
						let qty = self.find('#qty').val();
						let satuan = self.find('#satuan').val();

						$.post(URL+'consumable/submitAdd',{
							type:'SPAREPART',
							barcode:barcode,
							item_name:nama_barang,
							id_kategori:kategori,
							id_sub_kategori:sub_kategori,
							qty:qty,
							satuan:satuan
						}).done((d)=>{

						}).fail((e)=>{

						});
					}
				},close:{
					text:'Batal',
					btnClass:'btn-danger'
				}
			}
		});
	}

	setSub(e){
		$('#sub_kategori').html(`<option disabled selected>-- Pilih Sub Kategori --</option>`);
		var id_kat = $(e).val();

		$.post(URL+'consumable/getSubKategoriConsumable',{id_kat:id_kat}).done((data)=>{

			for(let i=0; i<data.data.length; i++){
				let opt = new Option(data.data[i].sub_description,data.data[i].id);
				$('#sub_kategori').append(opt);
			}
		}).fail((e)=>{

		});
	}

	getBarcode(e){
		let barcode = $(e).val();

		$.post(URL+'consumable/chBarcode',{barcode:barcode}).done((data)=>{
			$('#notif_barcode').text(data.message);
		}).fail((e)=>{

		});
	}
}

var SP = new Sparepart();

function addSparepart(){
	SP.add();
}

function setSub(e){
	SP.setSub(e);
}

function ckBarcode(e){
	setTimeout(()=>{
		SP.getBarcode(e);
	},100);
}