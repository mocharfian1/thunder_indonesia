<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// echo phpinfo();
		header('Content-type: application/json');
	}

	public function item()
	{
		$var['title'] = 'Import Item';
		$var['page_title'] = 'IMPORT ITEM';
		$var['content'] = 'import/list_item';
		$var['s_active'] = 'import_item';
		$var['js'] = 'js-import_item';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];



		$this->load->view('view-index', $var);
	}

	public function submit_upload()
	{
		require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
		require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');

		$Reader = new SpreadsheetReader(__DIR__ . '/../third_party/excel_reader/example.xlsx');
		$Sheets = $Reader->Sheets();

		$data = [];
		foreach ($Reader as $Row) {
			$kategori = $this->db->get_where('pos_kategori', array('id' => $Row[0]));
			$sub_kategori = $this->db->get_where('pos_sub_kategori', array('id' => $Row[1]));


			$nm_kategori = '';
			if ($kategori->num_rows() > 0) {
				$nm_kategori = $kategori->row()->description;
			}

			$nm_sub_kategori = '';
			if ($sub_kategori->num_rows() > 0) {
				$nm_sub_kategori = $sub_kategori->row()->sub_description;
			}

			array_push($data, array(
				'barcode' => $Row[2],
				'nama_item' => $Row[2],
				'kategori' => $nm_kategori,
				'sub_kategori' => $nm_sub_kategori
			));
		}

		echo json_encode($data);
	}


	public function upload()
	{
		// header('Content-type: application/json');

		if ($_FILES) {
			$tmp = $_FILES['file_input']['tmp_name'];
			$type = $_FILES['file_input']['type'];
			$size = $_FILES['file_input']['size'];
			$filename = $_FILES['file_input']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'] . '/assets/import_excel/' . time() . '_' . date('d-m-Y') . '.' . $ext))
				$status = 1;
			else
				$status = 2;

			$hasil = array(
				'status' => $status,
				'filename' => $filename,
				'type' => $type,
				'size' => $size,
			);

			// echo json_encode($hasil);
		}

		require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
		require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');

		$Reader = new SpreadsheetReader($_SERVER['DOCUMENT_ROOT'] . '/assets/import_excel/' . time() . '_' . date('d-m-Y') . '.' . $ext);
		$Sheets = $Reader->Sheets();

		$insert = $this->db->insert('history_import', array(
			'id' => ''
		));

		$id_history = $this->db->insert_id();
		$var['id_history'] = $id_history;

		$data = [];
		$dataToDB = [];

		foreach ($Reader as $Row) {

			$kategori = $this->db->get_where('pos_kategori', array('id' => $Row[0]));
			$sub_kategori = $this->db->get_where('pos_sub_kategori', array('id' => $Row[1]));
			$is_avail = $this->db->get_where('pos_item', array('barcode' => $Row[2], 'is_delete' => 0));

			$nm_kategori = '';
			if ($kategori->num_rows() > 0) {
				$nm_kategori = $kategori->row()->description;
			}

			$nm_sub_kategori = '';
			if ($sub_kategori->num_rows() > 0) {
				$nm_sub_kategori = $sub_kategori->row()->sub_description;
			}

			$ck_avail = 0;
			if ($is_avail->num_rows() > 0) {
				$ck_avail = 1;
			}

			$tmp = array(
				'barcode' => $Row[2],
				'nama_item' => $Row[3],
				'merek' => $Row[4],
				'qty' => $Row[5],
				'kategori' => $nm_kategori,
				'sub_kategori' => $nm_sub_kategori,
				'duplicate' => $ck_avail
			);

			$tmpToDB = array(
				'id_import' => $id_history,
				'barcode' => $Row[2],
				'nama_item' => $Row[3],
				'merek' => $Row[4],
				'qty' => $Row[5],
				'id_kat' => $Row[0],
				'id_sub_kat' => $Row[1]
			);

			array_push($data, $tmp);
			array_push($dataToDB, $tmpToDB);
		}

		unset($data[0]);
		unset($dataToDB[0]);

		$this->db->insert_batch('history_item_import', $dataToDB);
		$var['data'] = $data;
		$var['dataToDB'] = $dataToDB;

		$this->load->view('import/list_temp', $var);
	}

	public function upload_consumable()
	{
		$jenis = $_GET['jenis'];
		// header('Content-type: application/json');

		if ($_FILES) {
			$tmp = $_FILES['file_input']['tmp_name'];
			$type = $_FILES['file_input']['type'];
			$size = $_FILES['file_input']['size'];
			$filename = $_FILES['file_input']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);

			if (move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'] . '/assets/import_excel/' . time() . '_' . date('d-m-Y') . '.' . $ext))
				$status = 1;
			else
				$status = 2;

			$hasil = array(
				'status' => $status,
				'filename' => $filename,
				'type' => $type,
				'size' => $size,
			);

			// echo json_encode($hasil);
		}

		require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
		require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');

		$Reader = new SpreadsheetReader($_SERVER['DOCUMENT_ROOT'] . '/assets/import_excel/' . time() . '_' . date('d-m-Y') . '.' . $ext);
		$Sheets = $Reader->Sheets();

		$insert = $this->db->insert('consumable_history_import', array(
			'id' => ''
		));

		$id_history = $this->db->insert_id();
		$var['id_history'] = $id_history;

		$data = [];
		$dataToDB = [];

		foreach ($Reader as $Row) {

			$kategori = $this->db->get_where('consumable_kategori', array('id' => $Row[0]));
			$sub_kategori = $this->db->get_where('consumable_sub_kategori', array('id' => $Row[1]));
			$is_avail = $this->db->get_where('consumable_item', array('barcode' => $Row[2], 'is_delete' => 0));

			$nm_kategori = '';
			if ($kategori->num_rows() > 0) {
				$nm_kategori = $kategori->row()->description;
			}

			$nm_sub_kategori = '';
			if ($sub_kategori->num_rows() > 0) {
				$nm_sub_kategori = $sub_kategori->row()->sub_description;
			}

			$ck_avail = 0;
			if ($is_avail->num_rows() > 0) {
				$ck_avail = 1;
			}

			$tmp = array(
				'barcode' => $Row[2],
				'nama_item' => $Row[3],
				'qty' => $Row[4],
				'min_stock' => $Row[5],
				'max_stock' => $Row[6],
				'kategori' => $nm_kategori,
				'sub_kategori' => $nm_sub_kategori,
				'duplicate' => $ck_avail
			);

			$tmpToDB = array(
				'id_import' => $id_history,
				'jenis'=>$jenis,
				'barcode' => $Row[2],
				'nama_item' => $Row[3],
				'qty' => $Row[4],
				'min_stock' => $Row[5],
				'max_stock' => $Row[6],
				'id_kat' => $Row[0],
				'id_sub_kat' => $Row[1]
			);

			array_push($data, $tmp);
			array_push($dataToDB, $tmpToDB);
		}

		unset($data[0]);
		unset($dataToDB[0]);

		$this->db->insert_batch('consumable_history_item_import', $dataToDB);
		$var['data'] = $data;
		$var['dataToDB'] = $dataToDB;
		$var['is_consumable'] = 'CONSUMABLE';

		$this->load->view('import/list_temp', $var);
	}

	function submit_import()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');

		$import = $this->db->get_where('history_item_import', array(
			'id_import' => $id,
			'imported' => 0
		));

		$message_ext = '';

		if ($import->num_rows() > 0) {
			$data = [];

			foreach ($import->result() as $key => $value) {
				$ck_barang = $this->db->get_where('pos_item', array(
					'barcode' => $value->barcode,
					'is_delete' => 0
				));

				if ($ck_barang->num_rows() > 0) {
					$message_ext .= '(' . $value->barcode . ') ' . $value->nama_item . ' => Gagal Diimport (Barang sudah ada)' . "<br>";
				} else {
					array_push($data, array(
						'jenis_item' => 'ITEM',
						'is_external' => 0,
						'pos_type' => 'KANTOR',
						'barcode' => $value->barcode,
						'id_sub_kategori' => $value->id_sub_kat,
						'id_kategori' => $value->id_kat,
						'item_name' => $value->nama_item,
						'qty' => $value->qty,
						'merek' => $value->merek,
						'update_by' => $_SESSION['id_user'],
						'insert_by' => $_SESSION['id_user'],
						'status' => 'Active'
					));
				}
			}

			if (count($data) > 0) {
				$query = $this->db->insert_batch('pos_item', $data);

				if ($query) {
					$update = $this->db->where('id_import', $id)->where('imported', 0)->update('history_item_import', array('imported' => 1));

					if ($update) {
						echo json_encode(array(
							'success' => true,
							'message' => 'Sukses import data barang.<br>' . $message_ext
						));
					} else {
						echo json_encode(array(
							'success' => false,
							'message' => 'Gagal import data barang.'
						));
					}
				} else {
					echo json_encode(array(
						'success' => false,
						'message' => 'Gagal import data barang.'
					));
				}
			} else {
				echo json_encode(array(
					'success' => false,
					'message' => 'Tidak ada barang yang diimport.'
				));
			}
		}
	}

	function submit_import_consumable()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		// $type = $this->input->post('type');

		$import = $this->db->get_where('consumable_history_item_import', array(
			'id_import' => $id,
			'imported' => 0
		));

		$message_ext = '';

		if ($import->num_rows() > 0) {
			$data = [];

			foreach ($import->result() as $key => $value) {
				$ck_barang = $this->db->get_where('consumable_item', array(
					'barcode' => $value->barcode,
					'is_delete' => 0
				));

				if ($ck_barang->num_rows() > 0) {
					$message_ext .= '(' . $value->barcode . ') ' . $value->nama_item . ' => Gagal Diimport (Barang sudah ada)' . "<br>";
				} else {
					array_push($data, array(
						'type' => $value->jenis,
						'barcode' => $value->barcode,
						'item_name' => $value->nama_item,
						'id_kategori' => $value->id_kat,
						'id_sub_kategori' => $value->id_sub_kat,
						'qty' => $value->qty,
						'min_stock' => $value->min_stock,
						'max_stock' => $value->max_stock,
						'update_by' => $_SESSION['id_user'],
						'insert_by' => $_SESSION['id_user']
					));
				}
			}

			if (count($data) > 0) {
				$query = $this->db->insert_batch('consumable_item', $data);

				if ($query) {
					$update = $this->db->where('id_import', $id)->where('imported', 0)->update('consumable_history_item_import', array('imported' => 1));

					if ($update) {
						echo json_encode(array(
							'success' => true,
							'message' => 'Sukses import data barang.<br>' . $message_ext
						));
					} else {
						echo json_encode(array(
							'success' => false,
							'message' => 'Gagal import data barang. (Code : 81)'
						));
					}
				} else {
					echo json_encode(array(
						'success' => false,
						'message' => 'Gagal import data barang. (Code : 91)',
						'query' => $this->db->last_query()
					));
				}
			} else {
				echo json_encode(array(
					'success' => false,
					'message' => 'Tidak ada barang yang diimport.'
				));
			}
		}
	}
}
