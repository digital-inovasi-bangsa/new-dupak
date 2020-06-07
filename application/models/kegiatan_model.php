<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Kegiatan_model extends CI_Model
{
    public function unsurListingCount()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $query = $this->db->get();

        return count($query->result());
    }

    public function unsurListing()
    {
        $this->db->select('*');
        $this->db->from('tbl_unsur as a');
        $query = $this->db->get();

        return $query->result();
    }

    public function getSubunsur($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_subunsur');
        $this->db->where('idUnsur', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getButir($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir');
        $this->db->where('idSubunsur', $id);
        $query = $this->db->get();

        return $query->result();
    }
    public function getJenjang($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_jenjang');
        $query = $this->db->get();
        return $query->result();
    }

    public function getButirKegiatan($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_butir_kegiatan');
        $this->db->where('idButir', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function addNewKegiatan($kegiatanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_kegiatan_harian', $kegiatanInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    public function fetch_all_event($id)
    {
        $this->db->order_by('idKegiatanHarian');
        $this->db->join('tbl_butir as butir', 'harian.idButir = butir.idButir', 'left');
        $this->db->where('harian.userId', $id);
        return $this->db->get('tbl_kegiatan_harian as harian');
    }

    public function getTelahDiajukan($id)
    {
        $this->db->select('bt.namaButir,tkh.*,
        us.nip ,us.name, jj.namaJenjang , jb.namaJabatan , pk.namaPangkat,tkh.idKegiatanHarian,');
        $this->db->from('tbl_kegiatan_harian as tkh');
        $this->db->join('tbl_butir as bt', 'tkh.idButir = bt.idButir', 'left');
        $this->db->join('tbl_users as us', 'us.userId = tkh.userId', 'left');
        $this->db->join('tbl_jenjang as jj', 'jj.idJenjang = tkh.idJenjang', 'left');
        $this->db->join('tbl_jabatan as jb', 'jb.idJabatan = us.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as pk', 'pk.idPangkat = jb.tbl_pangkat_idPangkat', 'left');
        $this->db->where('tkh.userId', $id);
        $this->db->where('tkh.status', 'Belum Upload Bukti');
        $query = $this->db->get();

        return $query->result();
    }

    public function addNewBuktiKegiatan($kegiatanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_dokumen_kegiatan', $kegiatanInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    public function updateStatusKegiatan($kegiatanInfo, $idKegiatanHarian)
    {
        $this->db->where('idKegiatanHarian', $idKegiatanHarian);
        $this->db->update('tbl_kegiatan_harian', $kegiatanInfo);

        return true;
    }

    public function getKegiatanDiajukan()
    {
        $this->db->select('bt.namaButir,tkh.tanggalMulai,tkh.tanggalSelesai, tkh.tanggalSelesai ,
        us.nip ,us.name, jj.namaJenjang , jb.namaJabatan , pk.namaPangkat,tkh.idKegiatanHarian, tkh.createdAt,
        dk.path_dokumentasi, dk.path_surat_kegiatan, dk.path_laporan_kegiatan, 
        dk.path_jurnal, dk.path_daftar_hadir, dk.path_check_peralatan, dk.path_sprint_siaga,
        un.namaUnsur, sus.namaSubunsur');
        $this->db->from('tbl_kegiatan_harian as tkh');
        $this->db->join('tbl_butir as bt', 'tkh.idButir = bt.idButir', 'left');
        $this->db->join('tbl_users as us', 'us.userId = tkh.userId', 'left');
        $this->db->join('tbl_unsur as un', 'un.idUnsur = tkh.idUnsur', 'left');
        $this->db->join('tbl_subunsur as sus', 'sus.idSubunsur = tkh.idSubunsur', 'left');
        $this->db->join('tbl_jenjang as jj', 'jj.idJenjang = tkh.idJenjang', 'left');
        $this->db->join('tbl_jabatan as jb', 'jb.idJabatan = us.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as pk', 'pk.idPangkat = jb.tbl_pangkat_idPangkat', 'left');
        $this->db->join('tbl_dokumen_kegiatan as dk', 'dk.idKegiatanHarian = tkh.idKegiatanHarian', 'full');
        $this->db->where('status', 'Diajukan');
        $this->db->order_by('tkh.updatedAt', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getRiwayatKegiatanHarian($id)
    {
        $this->db->select('bt.namaButir,tkh.tanggalMulai,tkh.tanggalSelesai, tkh.tanggalSelesai, tkh.status , tkh.catatan, bt.namaButir,
        us.nip ,us.name, jj.namaJenjang , jb.namaJabatan , pk.namaPangkat,tkh.idKegiatanHarian, un.namaUnsur, sus.namaSubunsur,
        tkh.createdAt, tkh.updatedAt');
        $this->db->from('tbl_kegiatan_harian as tkh');
        $this->db->join('tbl_butir as bt', 'tkh.idButir = bt.idButir', 'left');
        $this->db->join('tbl_users as us', 'us.userId = tkh.userId', 'left');
        $this->db->join('tbl_jenjang as jj', 'jj.idJenjang = tkh.idJenjang', 'left');
        $this->db->join('tbl_jabatan as jb', 'jb.idJabatan = us.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as pk', 'pk.idPangkat = jb.tbl_pangkat_idPangkat', 'left');
        $this->db->join('tbl_unsur as un', 'un.idUnsur = tkh.idUnsur', 'left');
        $this->db->join('tbl_subunsur as sus', 'sus.idSubunsur = tkh.idSubunsur', 'left');
        $this->db->where('tkh.userId', $id);
        $this->db->order_by('tkh.updatedAt', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getKegiatanDiajukanCount()
    {
        $this->db->select('bt.namaButir,tkh.tanggalMulai,tkh.tanggalSelesai, tkh.tanggalSelesai ,
        us.nip ,us.name, jj.namaJenjang , jb.namaJabatan , pk.namaPangkat,tkh.idKegiatanHarian,
        dk.path_dokumentasi, dk.path_surat_kegiatan, dk.path_laporan_kegiatan');
        $this->db->from('tbl_kegiatan_harian as tkh');
        $this->db->join('tbl_butir as bt', 'tkh.idButir = bt.idButir', 'left');
        $this->db->join('tbl_users as us', 'us.userId = tkh.userId', 'left');
        $this->db->join('tbl_jenjang as jj', 'jj.idJenjang = tkh.idJenjang', 'left');
        $this->db->join('tbl_jabatan as jb', 'jb.idJabatan = us.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as pk', 'pk.idPangkat = jb.tbl_pangkat_idPangkat', 'left');
        $this->db->join('tbl_dokumen_kegiatan as dk', 'dk.idKegiatanHarian = tkh.idKegiatanHarian', 'full');
        $this->db->where('status', 'Diajukan');
        $query = $this->db->get();
        return count($query->result());
    }

    public function editStatus($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);

        return true;
    }

    public function getKegiatan($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_dokumen_kegiatan');
        $this->db->where('idKegiatanHarian', $id);
        $query = $this->db->get();

        $row = $query->row();

        return $row;
    }

    public function getSpmk($id, $tahun, $bulanAwal, $bulanAkhir)
    {
        $sql = "SELECT tkh.idKegiatanHarian ,tkh.userId , un.namaUnsur, SUM(bk.`point`) as point,
        tkh.tanggalMulai, tkh.tanggalSelesai, un.idUnsur from
        tbl_kegiatan_harian tkh
        JOIN tbl_unsur un ON un.idUnsur = tkh.idUnsur
        JOIN tbl_butir_kegiatan bk ON
        JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
        WHERE tkh.userId = $id AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status ='Diterima'
        GROUP BY tkh.idUnsur
        ORDER BY tkh.tanggalMulai";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getTabelKegiatanSpmk($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur)
    {
        $sql = "SELECT tkh.idKegiatanHarian ,tkh.userId , bk.point as poin, un.namaUnsur,sus.namaSubunsur ,SUM(bk.`point`) as point,
        tkh.tanggalMulai, tkh.tanggalSelesai, tkh.idButir , bk.keterangan, COUNT(bk.idButirKegiatan) as volume from 
        tbl_kegiatan_harian tkh 
        JOIN tbl_unsur un ON un.idUnsur = tkh.idUnsur 
        JOIn tbl_subunsur sus On sus.idSubunsur = un.idUnsur 
        JOIN tbl_butir_kegiatan bk ON 
        JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
        WHERE tkh.userId = $userId AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status ='Diterima' AND un.idUnsur = $idUnsur
        GROUP BY bk.idButirKegiatan 
        ORDER BY tkh.tanggalMulai";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getTabelKegiatanSpmkTotal($userId, $tahun, $bulanAwal, $bulanAkhir, $idUnsur)
    {
        $sql = "SELECT SUM(rst.jumlahVolume) as volume, SUM(rst.point) as poin from (
            SELECT SUM(bk.`point`) as point, COUNT(bk.idButirKegiatan) as jumlahVolume from 
            tbl_kegiatan_harian tkh
            JOIN tbl_unsur un ON un.idUnsur = tkh.idUnsur 
            JOIN tbl_subunsur sus On sus.idSubunsur = un.idUnsur 
            JOIN tbl_butir_kegiatan bk ON 
            JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
            WHERE tkh.userId = $userId AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status = 'Diterima' AND un.idUnsur = $idUnsur
            GROUP BY tkh.idKegiatanHarian
            ORDER BY tkh.tanggalMulai) as rst;";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getTabelKegiatanDupak($userId, $tahun, $bulanAwal, $bulanAkhir){
        $sql = "SELECT tkh.idKegiatanHarian ,tkh.userId , bk.point as poin, un.namaUnsur,sus.namaSubunsur ,SUM(bk.`point`) as point,
        tkh.tanggalMulai, tkh.tanggalSelesai, tkh.idButir , bk.keterangan, COUNT(bk.idButirKegiatan) as volume from 
        tbl_kegiatan_harian tkh 
        JOIN tbl_unsur un ON un.idUnsur = tkh.idUnsur 
        JOIn tbl_subunsur sus On sus.idSubunsur = un.idUnsur 
        JOIN tbl_butir_kegiatan bk ON 
        JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
        WHERE tkh.userId = $userId AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status ='Diterima'
        GROUP BY bk.idButirKegiatan 
        ORDER BY tkh.tanggalMulai";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getTabelKegiatanDupakTotal($userId, $tahun, $bulanAwal, $bulanAkhir){
        $sql = "SELECT SUM(rst.jumlahVolume) as volume, SUM(rst.point) as poin from (
            SELECT SUM(bk.`point`) as point, COUNT(bk.idButirKegiatan) as jumlahVolume from 
            tbl_kegiatan_harian tkh
            JOIN tbl_unsur un ON un.idUnsur = tkh.idUnsur 
            JOIN tbl_subunsur sus On sus.idSubunsur = un.idUnsur 
            JOIN tbl_butir_kegiatan bk ON 
            JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
            WHERE tkh.userId = $userId AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status = 'Diterima'
            GROUP BY tkh.idKegiatanHarian
            ORDER BY tkh.tanggalMulai) as rst;";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getPointButir($userId, $tahun, $bulanAwal, $bulanAkhir, $idButir)
    {
        $sql = "SELECT tkh.idButir,bt.namaButir, sum(`point`) as point FROM tbl_kegiatan_harian tkh
        LEFT JOIN tbl_butir bt ON bt.idButir = tkh.idButir 
        LEFT JOIN tbl_butir_kegiatan bk ON 
        JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
        WHERE tkh.userId = $userId AND tkh.idButir = $idButir AND tkh.tanggalSelesai BETWEEN '$tahun-$bulanAwal-01' AND '$tahun-$bulanAkhir-01' AND tkh.status ='Diterima'
        GROUP BY tkh.idButir";
        //execute query
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getAtasan()
    {
        $this->db->select('tu.name,tu.nip, jb.namaJabatan , dv.namaDivisi, pn.namaPangkat');
        $this->db->from('tbl_users tu');
        $this->db->join('tbl_divisi dv', 'tu.tbl_divisi_idDivisi = dv.idDivisi ', 'left');
        $this->db->join('tbl_jabatan jb', 'tu.tbl_jabatan_idJabatan = jb.idJabatan ', 'left');
        $this->db->join('tbl_pangkat pn', 'jb.tbl_pangkat_idPangkat = pn.idPangkat ', 'left');
        $this->db->where('tu.roleId', '18');
        $query = $this->db->get();

        $row = $query->row();

        return $row;
    }

    public function getUser($id){
        $this->db->select('tu.*, jb.namaJabatan , dv.namaDivisi, pn.namaPangkat');
        $this->db->from('tbl_users tu');
        $this->db->join('tbl_divisi dv', 'tu.tbl_divisi_idDivisi = dv.idDivisi ', 'left');
        $this->db->join('tbl_jabatan jb', 'tu.tbl_jabatan_idJabatan = jb.idJabatan ', 'left');
        $this->db->join('tbl_pangkat pn', 'jb.tbl_pangkat_idPangkat = pn.idPangkat ', 'left');
        $this->db->where('tu.userId', $id);
        $query = $this->db->get();

        $row = $query->row();

        return $row;
    }

}
