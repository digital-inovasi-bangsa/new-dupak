<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Butir_model extends CI_Model
{
    function ButirListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_butir as a');
        $this->db->join('tbl_subunsur as b', 'a.idSubunsur = b.idSubunsur','left');
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function butirListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_butir as a');
        $this->db->join('tbl_subunsur as b', 'a.idSubunsur = b.idSubunsur','left');
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

    function addNewButir($butirInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_butir', $butirInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getButirInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir as a');
        $this->db->join('tbl_subunsur as b', 'a.idSubunsur = b.idSubunsur','left');
        $this->db->where('idButir', $userId);
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
    
    
    function editButir($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
        
        return TRUE;
    }

    function deleteButir($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }

    function getUserSubunsur()
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur');
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
