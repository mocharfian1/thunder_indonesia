<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumable extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
		//$this->load->library('mail');
		//$this->load->library('email'); //tambahkan dalam contruct pemanggil libarary mail
	}
	public function index(){
		$var['title'] = 'Consumable';
		$var['page_title'] = 'CONSUMABLE';
		$var['content']='consumable/stock';
		$var['s_active']='consumable';
		$var['js'] = 'js-consumable';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		// $var['mode'] = 'view';
		

		$this->load->view('view-index',$var);
	}

	public function consumable_sparepart(){
		$var['title'] 		= 'Sparepart';
		$var['page_title'] 	= 'CONSUMABLE';
		$var['content'] 	= 'consumable/sparepart';
		$var['s_active'] 	= 'consumable-sparepart';
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];
		// $var['mode'] = 'view';
		

		$this->load->view('view-index',$var);
	}

	public function consumable_atk(){
		$var['title'] 		= 'ATK';
		$var['page_title'] 	= 'CONSUMABLE';
		$var['content'] 	= 'consumable/atk';
		$var['s_active'] 	= 'consumable-atk';
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];
		// $var['mode'] = 'view';
		

		$this->load->view('view-index',$var);
	}

	public function consumable_lainnya(){
		$var['title'] 		= 'Barang Pendukung';
		$var['page_title'] 	= 'CONSUMABLE';
		$var['content'] 	= 'consumable/lainnya';
		$var['s_active'] 	= 'consumable-lainnya';
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];
		// $var['mode'] = 'view';
		

		$this->load->view('view-index',$var);
	}

	public function v_addSparepart(){
		$query = $this->db->get_where('consumable_kategori',array(
			'is_delete'=>0
		));

		$var['kategori'] = '';

		if($query->num_rows()>0){
			$var['kategori'] = $query->result();
		}else{
			$var['kategori'] = array();
		}

		$this->load->view('consumable/v-add_sparepart',$var);
	}

	public function submitAdd(){
		header('Content-type:application/json');

		// $type = $this->input->get('type');
		$this->db->insert('consumable_item',$this->input->post());
	}

	public function getKategoriConsumable(){
		$query = $this->db->get_where('consumable_kategori',array(
			'is_delete'=>0
		));

		if($query->num_rows()>0){
			echo json_encode(array(
				'success'=>true,
				'data'=>$query->result()
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'data'=>null
			));
		}
	}

	public function getSubKategoriConsumable(){
		header('Content-type:application/json');
		$id_kat = $this->input->post('id_kat');

		$query = $this->db->get_where('consumable_sub_kategori',array(
			'id_kategori'=>$id_kat,
			'is_delete'=>0
		));

		if($query->num_rows()>0){
			echo json_encode(array(
				'success'=>true,
				'data'=>$query->result()
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'data'=>null
			));
		}
	}

	public function chBarcode(){
		header('Content-type:application/json');

		$barcode = $this->input->post('barcode');

		$query = $this->db->get_where('consumable_item',array(
			'barcode'=>$barcode,
			'is_delete'=>0
		));

		if($query->num_rows()>0){
			echo json_encode(array(
				'success'=>false,
				'message'=>'Barcode sudah digunakan'
			));
		}else{
			echo json_encode(array(
				'success'=>true,
				'message'=>'Barcode dapat dugunakan'
			));
		}
	}
}

?>