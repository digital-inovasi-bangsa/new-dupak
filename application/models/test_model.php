<?php 
 
class Test_model extends CI_Model{
	function data($number,$offset){
		return $query = $this->db->get('tbl_divisi',$number,$offset)->result();		
	}
 
	function jumlah_data(){
		return $this->db->get('tbl_divisi')->num_rows();
	}
}