<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model
{
    function RoleListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_roles as a');
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function roleListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_roles as a');
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

    function addNewRole($roleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_roles', $roleInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function editRole($where,$data,$table)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
        
        return TRUE;
    }

    function deleteRole($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }

    function getRoleInfo($roleId)
    {
        $this->db->select('*');
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId', $roleId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
