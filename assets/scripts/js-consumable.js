$('.datatable').DataTable();

class Sparepart{
	add(type=null){
		$.confirm({
			title:'Tambah Barang ( Consumable )',
			content:function(){
				var self = this;
				return $.post(URL+'consumable/v_add_item').done((data)=>{
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
							type:type,
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

class SubKat{
	addKategori(){
		$.confirm({
			title:`Tambah Kategori`,
			content:`
				<form>
					<div class="form-group">
					    <input id="nama_kategori" type='text' class="form-control" placeholder="Masukkan Nama Kategori">
					</div>
				</form>
			`,
			buttons:{
				submit:{
					text:'Simpan',
					btnClass:'btn-primary',
					action:function(){
						var self = this;
						var nama_kategori = self.$content.find('#nama_kategori').val();

						$.post(URL+'consumable/create_kategori',{nama_kategori:nama_kategori}).done((data)=>{
							alert(data.message);
							window.location.reload();
						}).fail((e)=>{

						});
					}
				},cancel:{
					text:'Batal'
				}
			}
		});
	}

	addSubKategori(){
		$.confirm({
			title:`Tambah Sub Kategori`,
			content:function(){
				var self = this;
				return $.get(URL+'consumable/getKategoriConsumable').done((data)=>{
					var opt = `<option disabled selected>-- Pilih Kategori --</option>`;
					for(var i = 0; i<data.data.length; i++){
						opt+=`<option value=`+data.data[i].id+`>`+data.data[i].description+`</option>`;
					}

					self.setContent(`
						<form>
							<div class="form-group">
								<select class="form-control" id="kategori">
									`+opt+`
								</select>
							</div>
							<div class="form-group">
							    <input id="nama_sub_kategori" type='text' class="form-control" placeholder="Masukkan Nama Kategori">
							</div>
						</form>
					`);
				}).fail((e)=>{

				});
			},
			buttons:{
				submit:{
					text:'Simpan',
					btnClass:'btn-primary',
					action:function(){
						var self = this;
						var kategori = self.$content.find('#kategori').val();
						var nama_sub_kategori = self.$content.find('#nama_sub_kategori').val();

						$.post(URL+'consumable/create_sub_kategori',{kategori:kategori, nama_sub_kategori:nama_sub_kategori}).done((data)=>{
							alert(data.message);
							window.location.reload();
						}).fail((e)=>{

						});
					}
				},cancel:{
					text:'Batal'
				}
			}
		});
	}
}

var SP = new Sparepart();
var SK = new SubKat();

function add_item(type=null){
	SP.add(type);
}

function setSub(e){
	SP.setSub(e);
}

function ckBarcode(e){
	setTimeout(()=>{
		SP.getBarcode(e);
	},100);
}

function add_kategori(){
	SK.addKategori();
}

function add_sub_kategori(){
	SK.addSubKategori();
}

