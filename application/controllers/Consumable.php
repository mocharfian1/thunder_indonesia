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
}

?>