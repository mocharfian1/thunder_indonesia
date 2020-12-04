<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct() { 
		parent::__construct(); 
	}

	public function index(){
		require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
		require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');

		$Reader = new SpreadsheetReader(__DIR__ . '/../third_party/excel_reader/example.xlsx');
		$Sheets = $Reader -> Sheets();



		foreach ($Reader as $Row)
		{
			print_r($Row);
		}
	}
}

?>