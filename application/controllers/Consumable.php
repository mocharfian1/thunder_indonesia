<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Consumable extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function resultJSON($n = null)
	{
		header('Content-type: application/json');
		if ($n == 1) {
			echo json_encode(array(
				'success' => true,
				'message' => 'Berhasil menambah data'
			));
		} else {
			if ($n == 0) {
				echo json_encode(array(
					'success' => false,
					'message' => 'Gagal menambah data'
				));
			} else {
				echo json_encode(array(
					'success' => false,
					'message' => 'Gagal menambah data'
				));
			}
		}
	}

	function resultJSON_del($n = null)
	{
		header('Content-type: application/json');
		if ($n == 1) {
			echo json_encode(array(
				'success' => true,
				'message' => 'Berhasil menghapus data'
			));
		} else {
			if ($n == 0) {
				echo json_encode(array(
					'success' => false,
					'message' => 'Gagal menghapus data'
				));
			} else {
				echo json_encode(array(
					'success' => false,
					'message' => 'Gagal menghapus data'
				));
			}
		}
	}

	public function index()
	{
		$var['title'] = 'Consumable';
		$var['page_title'] = 'CONSUMABLE';
		$var['content'] = 'consumable/stock';
		$var['s_active'] = 'consumable';
		$var['js'] = 'js-consumable';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		// $var['mode'] = 'view';


		$this->load->view('view-index', $var);
	}

	public function consumable_transaksi()
	{
		$var['title'] 		= 'TRANSAKSI';
		$var['page_title'] 	= 'CONSUMABLE';
		$var['content'] 	= 'consumable/transaksi';
		$var['s_active'] 	= 'consumable-transaksi';
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];


		$query = $this->db->get_where('consumable_kategori', array(
			'is_delete' => 0
		));

		$var['kategori'] = '';

		if ($query->num_rows() > 0) {
			$var['kategori'] = $query->result();
		} else {
			$var['kategori'] = array();
		}


		$this->load->view('view-index', $var);
	}

	public function consumable_table()
	{
		$var['title'] 		= 'Sparepart';
		$var['page_title'] 	= 'CONSUMABLE';
		$var['content'] 	= 'consumable/item';
		$var['s_active'] 	= 'consumable-' . $this->input->get('type');
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];
		// $var['mode'] = 'view';

		$var['type'] = $this->input->get('type');

		$query = $this->db->query("
			select 
				ck.description,cs.sub_description,i.*
			from
				consumable_item i
				join consumable_kategori ck on i.id_kategori=ck.id
				join consumable_sub_kategori cs on i.id_sub_kategori=cs.id
			where
				i.`type`='" . $var['type'] . "'
				and i.is_delete=0
		");

		$var['barang'] = array();

		if ($query->num_rows() > 0) {
			$var['barang'] = $query->result();
		}

		$this->load->view('view-index', $var);
	}

	public function consumable_kategori_sub()
	{
		$var['title'] 		= 'Kategori & Sub Kategori';
		$var['page_title'] 	= 'KATEGORI';
		$var['page_title_2'] = 'SUB KATEGORI';
		$var['content'] 	= 'consumable/kategori_sub';
		$var['s_active'] 	= 'consumable-kategori_sub';
		$var['js'] 			= 'js-consumable';
		$var['plugin'] 		= 'plugin_1';
		$var['user'] 		= $_SESSION['user_type'];
		// $var['mode'] = 'view';

		$query_sub = $this->db->query("
			select 
				cs.id,
				ck.description,
				cs.sub_description
			from 
				consumable_kategori ck
				join consumable_sub_kategori cs on ck.id=cs.id_kategori
			where
				ck.is_delete = 0
				and cs.is_delete = 0
		");

		$var['sub_kategori'] = array();

		if ($query_sub->num_rows() > 0) {
			$var['sub_kategori'] = $query_sub->result();
		}

		$query_kat = $this->db->query("
			select 
				ck.id,			
				ck.description
			from 
				consumable_kategori ck
			where
				ck.is_delete = 0
		");

		$var['kategori'] = array();

		if ($query_kat->num_rows() > 0) {
			$var['kategori'] = $query_kat->result();
		}


		$this->load->view('view-index', $var);
	}

	public function v_add_item()
	{
		$query = $this->db->get_where('consumable_kategori', array(
			'is_delete' => 0
		));

		$var['kategori'] = '';

		if ($query->num_rows() > 0) {
			$var['kategori'] = $query->result();
		} else {
			$var['kategori'] = array();
		}

		$this->load->view('consumable/v-add_item', $var);
	}

	public function submitAdd()
	{
		header('Content-type:application/json');

		// $type = $this->input->get('type');
		$insert = $this->db->insert('consumable_item', $this->input->post());

		if ($insert) {
			$this->resultJSON(1);
		} else {
			$this->resultJSON(0);
		}
	}

	public function getKategoriConsumable()
	{
		header('Content-type:application/json');
		$query = $this->db->get_where('consumable_kategori', array(
			'is_delete' => 0
		));

		if ($query->num_rows() > 0) {
			echo json_encode(array(
				'success' => true,
				'data' => $query->result()
			));
		} else {
			echo json_encode(array(
				'success' => false,
				'data' => null
			));
		}
	}

	public function getSubKategoriConsumable()
	{
		header('Content-type:application/json');
		$id_kat = $this->input->post('id_kat');

		$query = $this->db->get_where('consumable_sub_kategori', array(
			'id_kategori' => $id_kat,
			'is_delete' => 0
		));

		if ($query->num_rows() > 0) {
			echo json_encode(array(
				'success' => true,
				'data' => $query->result()
			));
		} else {
			echo json_encode(array(
				'success' => false,
				'data' => null
			));
		}
	}

	public function getItemConsumable()
	{
		header('Content-type:application/json');
		$id_kat = $this->input->post('id_kat');
		$id_sub = $this->input->post('id_sub');

		$query = $this->db->get_where('consumable_item', array(
			'id_kategori' => $id_kat,
			'id_sub_kategori' => $id_sub,
			'is_delete' => 0
		));

		if ($query->num_rows() > 0) {
			echo json_encode(array(
				'success' => true,
				'data' => $query->result()
			));
		} else {
			echo json_encode(array(
				'success' => false,
				'data' => null
			));
		}
	}

	public function chBarcode()
	{
		header('Content-type:application/json');

		$barcode = $this->input->post('barcode');

		$query = $this->db->get_where('consumable_item', array(
			'barcode' => $barcode,
			'is_delete' => 0
		));

		if ($query->num_rows() > 0) {
			echo json_encode(array(
				'success' => false,
				'message' => 'Barcode sudah digunakan'
			));
		} else {
			echo json_encode(array(
				'success' => true,
				'message' => 'Barcode dapat dugunakan'
			));
		}
	}

	public function create_kategori()
	{
		header('Content-type:application/json');

		$nama = $this->input->post('nama_kategori');

		$query = $this->db->insert('consumable_kategori', array(
			'description'	=>	$nama
		));

		if ($query) {
			$this->resultJSON(1);
		} else {
			$this->resultJSON(0);
		}
	}

	public function create_sub_kategori()
	{
		header('Content-type:application/json');

		$id_kat 	= $this->input->post('kategori');
		$nama 		= $this->input->post('nama_sub_kategori');

		$query = $this->db->insert('consumable_sub_kategori', array(
			'id_kategori'		=>	$id_kat,
			'sub_description'	=>	$nama
		));

		if ($query) {
			$this->resultJSON(1);
		} else {
			$this->resultJSON(0);
		}
	}

	public function deleteSK()
	{
		header('Content-type: application/json');
		$type = $this->input->post('type');
		$id = $this->input->post('id');

		if ($type == 'KAT') {
			$update = $this->db->where('id', $id)->update('consumable_kategori', array(
				'is_delete' => 1
			));

			if ($update) {
				$this->resultJSON_DEL(1);
			} else {
				$this->resultJSON_DEL(0);
			}
		} else {
			if ($type == 'SUB') {
				$update = $this->db->where('id', $id)->update('consumable_sub_kategori', array(
					'is_delete' => 1
				));

				if ($update) {
					$this->resultJSON_DEL(1);
				} else {
					$this->resultJSON_DEL(0);
				}
			} else {
				if ($type == 'ITEM') {
					$update = $this->db->where('id', $id)->update('consumable_item', array(
						'is_delete' => 1
					));

					if ($update) {
						$this->resultJSON_DEL(1);
					} else {
						$this->resultJSON_DEL(0);
					}
				}
			}
		}
	}
}
