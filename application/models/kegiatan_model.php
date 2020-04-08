<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
    function unsurListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    function unsurListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $query = $this->db->get();
        
        return $query->result();
    }

    function getSubunsur($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur');
        $this->db->where('idUnsur', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getButir($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir');
        $this->db->where('idSubunsur', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getJenjang($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_jenjang');
        $this->db->where('idJabatan', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getButirKegiatan($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir_kegiatan');
        $this->db->where('idButir', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function addNewKegiatan($kegiatanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_kegiatan_harian', $kegiatanInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function fetch_all_event(){
        $this->db->order_by('idKegiatanHarian');
        $this->db->join('tbl_butir as butir', 'harian.idButir = butir.idButir','left');
        return $this->db->get('tbl_kegiatan_harian as harian');
    }

    function getTelahDiajukan($id){
        $this->db->select('*');
        $this->db->from('tbl_kegiatan_harian');
        $this->db->where('userId', $id);
        $this->db->where('status', 'Belum Upload Bukti');
        $query = $this->db->get();
        
        $row=$query->row();

        return $row;
    }

    function addNewBuktiKegiatan($kegiatanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_dokumen_kegiatan', $kegiatanInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function UpdateStatusKegiatan($kegiatanInfo, $idKegiatanHarian)
    {
        $this->db->where('idKegiatanHarian', $idKegiatanHarian);
        $this->db->update('tbl_kegiatan_harian', $kegiatanInfo);
        
        return TRUE;
    }
    
}
