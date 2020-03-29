<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function DivisiListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_divisi as a');
        if(!empty($searchText)) { $this->db->or_like('a.idDivisi', $searchText); $this->db->or_like('a.namaJabatan', $searchText); $this->db->or_like('b.namaDivisi', $searchText);}
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
    function divisiListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_divisi as a');
        if(!empty($searchText)) { $this->db->or_like('a.idDivisi', $searchText); $this->db->or_like('a.namaJabatan', $searchText); $this->db->or_like('b.namaDivisi', $searchText);}
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        return $query->result();
    }

     /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewDivisi($divisiInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_divisi', $divisiInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getPangkatDivisi($divisiId)
    {
        $this->db->select('*');
        $this->db->from('tbl_divisi');
        $this->db->where('idDivisi', $divisiId);
        $query = $this->db->get();
        
        return $query->result();
    }   
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editDivisi($where,$data,$table)
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
    function deleteDivisi($divisiId, $divisiInfo)
    {
        $this->db->where($divisiId);
		$this->db->delete($divisiInfo);
        
        return $this->db->affected_rows();
    }

    function getDivisiInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_divisi as a');
        $this->db->where('a.idDivisi', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
