<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
	}

	public function index(){
		// echo phpinfo();
		header('Content-type: application/json');
		require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
		require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');

		$Reader = new SpreadsheetReader(__DIR__ . '/../third_party/excel_reader/example.xlsx');
		$Sheets = $Reader -> Sheets();

		$data = [];
		$start = 0;
		foreach ($Reader as $Row)
		{
			if($Row[0]=='end'){
				$start = 0;
			}

			if($start==1 && empty($Row[0])){
				// $query = $this->db->get_where('pos_item',array(
				// 	'barcode'=>$Row[1],
				// 	'id_kategori'=>$Row[4],
				// 	'id_sub_kategori'=>$Row[5]
				// ));

				// if($query->num_rows()>0){
				// 	$update = $this->db
				// 					->where('barcode',$Row[1])
				// 					->where('id_kategori',$Row[4])
				// 					->where('id_sub_kategori',$Row[5])
				// 					->update('pos_item',array('qty'=>$query->row()->qty+$Row[3]));

				// 	if($update){
				// 		echo "Success";
				// 	}else{
				// 		echo "Gagal";
				// 	}
				// }else{
				// 	echo "Item tidak ditemukan";
				// }
				$kategori = $this->db->get_where('pos_kategori',array('id'=>$Row[1]));
				$sub_kategori = $this->db->get_where('pos_kategori',array('id'=>$Row[1]));

				
				$nm_kategori = '';
				if($kategori->num_rows()>0){
					$nm_kategori = $kategori->row()->description;
				}

				$nm_sub_kategori = '';
				if($sub_kategori->num_rows()>0){
					$nm_sub_kategori = $sub_kategori->row()->sub_description;
				}

				array_push($data,array(
					'barcode'=>$Row[1],
					'nama_item'=>$Row[2],
					'kategori'=>$nm_kategori,
					'sub_kategori'=>$nm_sub_kategori,
					'harga_beli'=>$Row[6],
					'harga_jual'=>$Row[7],
					'durasi'=>$Row[8]
				));
			}

			if($Row[0]=='start'){
				$start = 1;
			}
		}

		echo json_encode($data);
	}

	public function item(){
		$var['title'] = 'IMPORT BARANG';
		$var['page_title'] = 'IMPORT BARANG';
		$var['content']='import/story';
		$var['s_active']='import_item';
		$var['js'] = 'js-import';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		// $var['mode'] = 'view';
		

		$this->load->view('view-index',$var);
	}
}

?>