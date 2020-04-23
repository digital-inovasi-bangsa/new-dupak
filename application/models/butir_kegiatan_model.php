<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Butir_kegiatan_model extends CI_Model
{
    function ButirKegiatanListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_butir_kegiatan as a');
        $this->db->join('tbl_butir as b', 'a.idButir = b.idButir','left');
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function butirKegiatanListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_butir_kegiatan as a');
        $this->db->join('tbl_butir as b', 'a.idButir = b.idButir','left');
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
        $this->db->insert('tbl_butir_kegiatan', $butirInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function getButirInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir_kegiatan as a');
        $this->db->join('tbl_butir as b', 'a.idButir = b.idButir','left');
        $this->db->where('idButirKegiatan', $userId);
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

    function getUserButir()
    {
        $this->db->select('*');
        $this->db->from('tbl_butir');
        $query = $this->db->get();
        
        return $query->result();
    }
    
}
