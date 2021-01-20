<?php
class Model_report extends CI_Model {
	function __construct(){
		parent::__construct();
	}
	public function getDriver(){
		$query = $this->db->query("select id,name,user_type,is_freelance from user where (user_type='Kurir' or user_type='Freelance') and is_delete=0 and is_active=1");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function getDataReportDriver($id=null,$month=null,$year=null){
			$query = $this->db->query("	select
			p.id,c.id_kurir,u.name,p.no_pemesanan,p.nama_event,p.tgl_pemesanan,p.`status`
			from
			pemesanan as p
			join crew_pemesanan as c on c.id_pemesanan=p.id
			join user as u on u.id=c.id_kurir
			where
			p.is_delete=0
			and
			c.is_delete=0
			and
			p.jenis='pemesanan'
			and c.id_kurir=".$id."
			and month(tgl_pemesanan)=".$month."
			and year(tgl_pemesanan)=".$year);
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function tb_item_disewa(){
			$query = $this->db->query("	select
			/* i.item_name,
			ip.qty,
			ip.durasi,
			d.name as durasi_name,
			d.harga, */
			sum(ip.qty) as total_disewa,
			sum(d.harga) as total_anggaran_from_durasi,
			sum(ip.total_harga) as anggaran_akhir
			from
			pemesanan as p
			join item_pemesanan as ip on ip.id_pemesanan=p.id
			join pos_item as i on ip.id_item=i.id
			join durasi as d on ip.durasi=d.id
			where
			p.`status`=3
			and p.is_delete=0
			group by i.id
			");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function tb_item_terlaris(){
			$query = $this->db->query("	select
			/* i.item_name,
			ip.qty,
			ip.durasi,
			d.name as durasi_name,
			d.harga, */
			sum(ip.qty) as total_disewa,
			sum(d.harga) as total_anggaran_from_durasi,
			sum(ip.total_harga) as anggaran_akhir
			from
			pemesanan as p
			join item_pemesanan as ip on ip.id_pemesanan=p.id
			join pos_item as i on ip.id_item=i.id
			join durasi as d on ip.durasi=d.id
			where
			p.`status`=3
			and p.is_delete=0
			group by i.id
			order by total_disewa desc
			");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	public function tb_jumlah_driver(){
			$query = $this->db->query("	select u.name,
			(select count(*) from crew_pemesanan as cp join pemesanan as pp on cp.id_pemesanan=pp.id where  cp.id_kurir=u.id and cp.is_delete=0 and pp.is_delete=0 and pp.jenis='pemesanan') as total_jobs,
			(select count(*) from crew_pemesanan as cp join pemesanan as pp on cp.id_pemesanan=pp.id where (pp.`status`>=2 and pp.`status`<5) and cp.id_kurir=u.id and pp.is_delete=0 and pp.jenis='pemesanan' and cp.is_delete=0) as progress,
			(select count(*) from crew_pemesanan as cp join pemesanan as pp on cp.id_pemesanan=pp.id where pp.`status`=5 and cp.id_kurir=u.id and pp.is_delete=0 and cp.is_delete=0 and pp.jenis='pemesanan') as done
			from user as u where (u.user_type='Kurir' or u.user_type='Freelance')
			group by u.id
			order by total_jobs desc
			");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function kategori(){
		$query = $this->db->query("select * from pos_kategori where is_delete=0;");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function sub_kategori(){
		$query = $this->db->query("select * from pos_sub_kategori where is_delete=0;");
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}

	public function getAllItem(){
		$query = $this->db->query("
			select     	
						i.id as ID_ITEM,
			            kt.code, 
			            sb.id as id_sub,
			            kt.id as id_kat,
			            sb.sub_kategori_code, 
			            kt.code,  
			            u.username as update_by_username, 
			            i.barcode,
			            i.qty,
			            i.merek,
			            i.satuan,
			            i.deskripsi_satuan,
			            i.harga_beli,
			            i.harga_jual,
			            i.lost_remark,
			            i.fragile,
			            i.status,
			            i.nama_gudang,
						i.kode_gudang,
						i.kode_lokasi,
						i.kode_rak,
						i.tahun_pembelian,

			             
			            i.item_name as nama_item,
			            sb.sub_description as jenis_item,
			            kt.description as kategori_item,
			            i.harga_beli,
			            i.harga_jual,
			            i.cost_percentage,
			            sb.update_date, 
			            sb.is_delete

			from        pos_kategori as kt, 
			            pos_item as i, 
			            pos_sub_kategori as sb left join user as u on u.id = sb.update_by

			where       sb.is_delete = '0' and 
			            kt.is_delete = '0' and 
			            i.is_delete = '0' and
			            i.id_sub_kategori=sb.id AND
			            i.id_kategori=kt.id AND 
			            i.id_sub_kategori=sb.id
			order by 
						i.id_kategori asc, i.id_sub_kategori asc, i.merek asc
		");

		if($query->num_rows()>0){
			return $query->result();
		}else{
			return null;
		}
	}
	
}
?>