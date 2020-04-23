<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subunsur_model extends CI_Model
{
    function SubunsurListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur as a');
        $this->db->join('tbl_unsur as b','b.idunsur=a.idunsur','left');

        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function subunsurListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur as a');
        $this->db->join('tbl_unsur as b', 'b.idunsur=a.idunsur','left');
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

    function addNewUnsur($unsurInfo)
    {
        $this->db->trans_start();
        $this->db->insert('idUnsur', $unsurInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getUnsurInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur');
        $this->db->where('idUnsur', $userId);
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
    
    
    function editSubunsur($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
        
        return TRUE;
    }

    function deleteunsur($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }

    function getUserUnsur()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur');
        $query = $this->db->get();
        
        return $query->result();
    }

    function addNewSubunsur($subunsurInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_subunsur', $subunsurInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();

        return $insert_id;
        
    }

    function deleteSubunsur($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }

    function getSubunsurInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur as a');
        $this->db->where('a.idSubunsur', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
