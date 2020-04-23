<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Unsur_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function UnsurListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
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
    function unsurListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $query = $this->db->get();
        
        return $query->result();
    }

     /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUnsur($unsurInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_unsur', $unsurInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUnsur($unsurId)
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur');
        $this->db->where('idUnsur', $unsurId);
        $query = $this->db->get();
        
        return $query->result();
    }   
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUnsur($where,$data,$table)
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
    function deleteUnsur($userId, $userInfo)
    {
        $this->db->where($userId);
        $this->db->delete($userInfo);
         
        return $this->db->affected_rows();
    }


    function getUnsurInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $this->db->where('a.idUnsur', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
