<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pangkat_model extends CI_Model
{
    function pangkatListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_pangkat as a');
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function pangkatListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_pangkat as a');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    function addNewPangkat($pangkatInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_pangkat', $pangkatInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getPangkatInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_pangkat');
        $this->db->where('idPangkat', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getUserInfo($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
		$this->db->where('roleId !=', 1);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function editPangkat($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
        
        return TRUE;
    }

    function deletePangkat($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }
    
}

  