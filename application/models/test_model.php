<?php

class Test_model extends CI_Model
{
 function fetch_all_event(){
  $this->db->order_by('id');
  return $this->db->get('tbl_kegiatan');
 }

 function insert_event($data)
 {
  $this->db->insert('tbl_kegiatan', $data);
 }

 function update_event($data, $id)
 {
  $this->db->where('id', $id);
  $this->db->update('tbl_kegiatan', $data);
 }

 function delete_event($id)
 {
  $this->db->where('id', $id);
  $this->db->delete('tbl_kegiatan');
 }
}

?>