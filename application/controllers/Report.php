<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class report extends CI_Controller {
	function __construct(){
		parent::__construct();

	}

	public function index(){

	}

	public function report_driver(){
		

		$var['title'] = 'Report';
		$var['page_title'] = 'REPORT';
		$var['content']='view-report_driver';
		$var['s_active']='report_driver';
		$var['js'] = 'js-report_driver';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		$var['mode']='view';

		$this->load->model('model_report');
		
		$var['driver'] = $this->model_report->getDriver();
		

		$this->load->view('view-index',$var);
	}

	public function report_jurnal(){
		

		$var['title'] = 'Report';
		$var['page_title'] = 'REPORT';
		$var['content']='view-report_jurnal';
		$var['s_active']='report_jurnal';
		$var['js'] = 'js-report_jurnal';
		$var['plugin'] = 'plugin_1';
		$var['user'] = $_SESSION['user_type'];
		$var['mode']='view';

		$this->load->model('model_report');
		
		$var['allItem'] = $this->model_report->getAllItem();

		$items = $var['allItem'];
		
		
		if($this->input->get('export') == 'true'){
			// require(__DIR__ . '/../third_party/excel_reader/php-excel-reader/excel_reader2.php');
			// require(__DIR__ . '/../third_party/excel_reader/SpreadsheetReader.php');
			require(__DIR__ . '/../third_party/excel/PHPExcel.php');
			require(__DIR__ . '/../third_party/excel/PHPExcel/Reader/HTML.php');
			// require_once( APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
			// header('Content-Description: File Transfer');
   //  		header('Content-Type: application/octet-stream');
		
			// header('Content-Disposition: attachment; filename="Jurnal_'.date("d-m-Y").'.xls"');
			
			$htmlnya = $this->load->view('view-export_jurnal',$var,TRUE);

			$temp_html_file = './assets/'.time().'.html';
			file_put_contents($temp_html_file, $htmlnya);

			$reader = PHPExcel_IOFactory::createReader('Html');

			$spreadsheet = $reader->load($temp_html_file);

			$writer = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel2007');

			$filename = 'assets/doc_jurnal/Jurnal_'.date("d-m-Y").'_'.time().'.xlsx';

			$writer->save($filename);

			header('Content-Type: application/x-www-form-urlencoded');
			header('Content-Transfer-Encoding: Binary');
			header('Location:'.base_url().$filename);

			readfile($filename);

			unlink($temp_html_file);
			// unlink($filename);

			exit;

		}else{
			$this->load->view('view-index',$var);
		}

		

	}

	public function tb_driver(){
		$id_kurir = $_POST['id_kurir'];
		$month = $_POST['month'];
		$year = $_POST['year'];

		$var['mode']='post_tb';
		$var['status'] = [
			'Waiting Approval',
			'Order Received',
			'Courier Assigned',
			'Prepare Item',
			'Courier On The Way',
			'Done',
			'Cancel'
		];
		$this->load->model('model_report');
		$var['tb_report_driver'] = $this->model_report->getDataReportDriver($id_kurir,$month,$year);
		$var['jumlah_jobs']=count($var['tb_report_driver']);
		$var['success']=0;
		$var['progress']=0;

		if(!empty($var['tb_report_driver'])){
			foreach ($var['tb_report_driver'] as $key => $value) {
				if($value->status==5){
					$var['success']++;
				}

				if($value->status<5){
					$var['progress']++;
				}
			}
		}

		$this->load->view('view-report_driver',$var);
	}
}

?>