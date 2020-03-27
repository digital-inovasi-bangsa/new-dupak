<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function RoleListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_roles as a');
        if(!empty($searchText)) { $this->db->or_like('a.roleId', $searchText); $this->db->or_like('a.role', $searchText);}
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function roleListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_roles as a');
        if(!empty($searchText)) { $this->db->or_like('a.roleId', $searchText); $this->db->or_like('a.role', $searchText);}
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

     /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewRole($roleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_roles', $roleInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editRole($where,$data,$table)
    {
        
        // return TRUE;
        $this->db->where($where);
        $this->db->update($table,$data);
        
        return TRUE;
    }

    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteRole($userId, $userInfo)
    {
        $this->db->where($userId);
		$this->db->delete($userInfo);
        
        return $this->db->affected_rows();
    }



    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
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
