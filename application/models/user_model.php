<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model
{
    public function userListingCount()
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        $this->db->join('tbl_divisi as Divisi', 'Divisi.idDivisi = BaseTbl.tbl_divisi_idDivisi', 'full');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('createdDtm', 'ASC');
        $query = $this->db->get();

        return count($query->result());
    }

    public function userListing()
    {
        $this->db->select('BaseTbl.*,Divisi.*, Jabatan.*, Pangkat.*, Role.*');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        $this->db->join('tbl_divisi as Divisi', 'Divisi.idDivisi = BaseTbl.tbl_divisi_idDivisi', 'left');
        $this->db->join('tbl_jabatan as Jabatan', 'Jabatan.idJabatan = BaseTbl.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as Pangkat', 'Pangkat.idPangkat = Jabatan.tbl_pangkat_idPangkat', 'left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->order_by('createdDtm', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserRoles()
    {
        $this->db->select('*');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserPangkat()
    {
        $this->db->select('*');
        $this->db->from('tbl_pangkat');
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserJabatan($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_jabatan');
        $this->db->where('tbl_pangkat_idPangkat', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserJabatanInfo()
    {
        $this->db->select('*');
        $this->db->from('tbl_jabatan');
        $query = $this->db->get();

        return $query->result();
    }

    public function getUserDivisi()
    {
        $this->db->select('*');
        $this->db->from('tbl_divisi');
        $query = $this->db->get();

        return $query->result();
    }

    public function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    public function getUserInfo($userId)
    {
        $this->db->select('BaseTbl.*,Divisi.*, Jabatan.*, Pangkat.*, Role.*');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId', 'left');
        $this->db->join('tbl_divisi as Divisi', 'Divisi.idDivisi = BaseTbl.tbl_divisi_idDivisi', 'left');
        $this->db->join('tbl_jabatan as Jabatan', 'Jabatan.idJabatan = BaseTbl.tbl_jabatan_idJabatan', 'left');
        $this->db->join('tbl_pangkat as Pangkat', 'Pangkat.idPangkat = Jabatan.tbl_pangkat_idPangkat', 'left');
        $this->db->where('isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->where('BaseTbl.userId', $userId);
        $query = $this->db->get();

        return $query->result();
    }

    public function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return true;
    }

    public function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }

    public function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId');
        $this->db->where('userId', $userId);
        $this->db->where('password', $oldPassword);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        return $query->result();
    }

    public function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }

    private function _uploadImage()
    {
        $config['upload_path'] = './upload/product/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = '123';
        $config['overwrite'] = true;
        $config['max_size'] = 1024; // 1MB
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    public function getPoint($userId, $status)
    {
        $sql = "SELECT sum(`point`) as jmlPoint, count(point) as jmlKegiatan FROM tbl_kegiatan_harian tkh
        LEFT JOIN tbl_butir bt ON bt.idButir = tkh.idButir 
        LEFT JOIN tbl_butir_kegiatan bk ON 
        JSON_CONTAINS(tkh.butirKegiatan , CAST(bk.idButirKegiatan as JSON), '$')
        WHERE tkh.userId = $userId AND tkh.status = '$status'
        GROUP BY tkh.idButir;";
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
}
