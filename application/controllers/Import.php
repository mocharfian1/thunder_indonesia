<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
	}

	public function index(){
		
		
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



		foreach ($Reader as $Row)
		{
			print_r($Row);
		}
	}

	public function upload(){
		if (isset($_POST['btnSubmit'])) {
		    $uploadfile = $_FILES["uploadImage"]["tmp_name"];
		    $folderPath = "uploads/";
		    
		    if (! is_writable($folderPath) || ! is_dir($folderPath)) {
		        echo "error";
		        exit();
		    }
		    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderPath . $_FILES["uploadImage"]["name"])) {
		        echo '<img src="' . $folderPath . "" . $_FILES["uploadImage"]["name"] . '">';
		        exit();
		    }
		}
	}
}

?>