<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    function loginMe($email, $ecryptPassword)
    {
        $this->db->select('BaseTbl.*, Role.role, Jabatan.namaJabatan, Jabatan.tbl_pangkat_idPangkat');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        $this->db->join('tbl_jabatan as Jabatan', 'Jabatan.idJabatan = BaseTbl.tbl_jabatan_idJabatan','left');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.password', $ecryptPassword);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
}

?>