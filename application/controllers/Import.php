<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
	}

	public function index(){
		// echo phpinfo();
		header('Content-type: application/json');
		
		
	}

	public function item(){
		$var['title'] = 'Import Item';
		$var['page_title'] = 'IMPORT ITEM';
		$var['content']='import/list_item';
		$var['s_active']='import_item';
		$var['js'] = 'js-import_item';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		
		

		$this->load->view('view-index',$var);
	}

	public function submit_upload(){
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


	public function upload(){
		// header('Content-type: application/json');
		
		if ($_FILES){
		    $tmp = $_FILES['file_input']['tmp_name'];
		    $type = $_FILES['file_input']['type'];
		    $size = $_FILES['file_input']['size'];
		    $filename = $_FILES['file_input']['name'];
		    $ext = pathinfo($filename, PATHINFO_EXTENSION);
		    
		    if (move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].'/assets/import_excel/'.time().'_'.date('d-m-Y').'.'.$ext))
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

		$Reader = new SpreadsheetReader($_SERVER['DOCUMENT_ROOT'].'/assets/import_excel/'.time().'_'.date('d-m-Y').'.'.$ext);
		$Sheets = $Reader->Sheets();

		$data = [];
		$start = 0;
		foreach ($Reader as $Row)
		{
			if($Row[0]=='end'){
				$start = 0;
			}

			if($start==1 && empty($Row[0])){
				$kategori = $this->db->get_where('pos_kategori',array('id'=>$Row[4]));
				$sub_kategori = $this->db->get_where('pos_sub_kategori',array('id'=>$Row[5]));

				
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
					'qty'=>$Row[3],
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

		$var['data'] = $data;

		$this->load->view('import/list_temp',$var);
	}
}

?>