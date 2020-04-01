<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Test extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('test_model');
	}
 
	public function index(){
		$this->load->database();
		$jumlah_data = $this->test_model->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'Test/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);		
		$data['divisi'] = $this->test_model->data($config['per_page'],$from);
		$this->load->view('test/v_test',$data);
	}
}
?>