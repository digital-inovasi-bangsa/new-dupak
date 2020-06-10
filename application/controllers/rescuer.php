<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rescuer extends CI_Controller
{

    protected $role = '';
    protected $vendorId = '';
    protected $name = '';
    protected $roleText = '';
    protected $fotoProfil = '';
    protected $global = array();

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('kegiatan_model');
        $this->load->library('tupload');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        $userId = $this->session->userdata('userId');
        $data['jumlahUser'] = $this->user_model->userListingCount();
        $data['jumlahKegiatan'] = $this->kegiatan_model->getKegiatanDiajukanCount();
        $data['kegiatanPegawaiDiterima'] = $this->user_model->getPoint($userId, 'diterima');
        $data['kegiatanPegawaiDitolak'] = $this->user_model->getPoint($userId, 'ditolak');
        $this->load->view('includes/header', $this->global);
        $this->load->view('dashboard', $data);
        $this->load->view('includes/footer');
    }

    /**
     * This function used to check the user is logged in or not
     */
    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            redirect('/login');
        } else {
            $this->role = $this->session->userdata('role');
            $this->vendorId = $this->session->userdata('userId');
            $this->name = $this->session->userdata('name');
            $this->roleText = $this->session->userdata('roleText');
            $this->fotoProfil = $this->session->userdata('fotoProfil');

            $this->global['name'] = $this->name;
            $this->global['role'] = $this->role;
            $this->global['role_text'] = $this->roleText;
            $this->global['fotoProfil'] = $this->fotoProfil;
        }
    }

    /**
     * This function is used to check the access
     */
    public function isAdmin()
    {
        if ($this->role != ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to check the access
     */
    public function isTicketter()
    {
        if ($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to load the set of views
     */
    public function loadThis()
    {
        $this->global['pageTitle'] = 'Akses Ditolak';

        $this->load->view('includes/header', $this->global);
        $this->load->view('access');
        $this->load->view('includes/footer');
    }

    /**
     * This function is used to logged out user from system
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Anda Berhasil Keluar Sistem');
        redirect('/login');
    }

    /**
     * This function is used to load the user list
     */
    public function rescuerListing()
    {
        $this->load->model('user_model');
        $data['userRecords'] = $this->user_model->rescuerListing();
        $this->global['pageTitle'] = 'Daftar Rescuer';
        $this->load->view('includes/header', $this->global);
        $this->load->view('rescuer/rescuer', $data);
        $this->load->view('includes/footer');
    }

    /**
     * This function is used to load the add new form
     */
    public function addNew()
    {
        $this->load->model('user_model');
        $data['roles'] = $this->user_model->getUserRoles();
        $data['divisi'] = $this->user_model->getUserDivisi();
        $data['pangkat'] = $this->user_model->getUserPangkat();
        $this->global['pageTitle'] = 'Tambahkan Data Rescuer';
        $this->load->view('includes/header', $this->global);
        $this->load->view('rescuer/addNew', $data);
        $this->load->view('includes/footer');
    }

    /**
     * This function is used to add new user to the system
     */
    public function addNewUser()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[128]|is_unique[tbl_users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|max_length[20]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric|xss_clean|is_unique[tbl_users.nip]');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric|xss_clean|is_unique[tbl_users.mobile]');
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
            $this->form_validation->set_rules('nomorSeriKartuPegawai', 'Nomor Seri Kartu Pegawai', 'trim|required');
            $this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
            $this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'trim|required');
            $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
            $this->form_validation->set_rules('mulaiKerja', 'Mulai Kerja', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->addNew();
            } else {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $nip = $this->input->post('nip');
                $mobile = $this->input->post('mobile');
                $idJabatan = $this->input->post('jabatan');
                $nomorSeriKartuPegawai = $this->input->post('nomorSeriKartuPegawai');
                $tanggalLahir = $this->input->post('tanggalLahir');
                $tempatLahir = $this->input->post('tempatLahir');
                $jenisKelamin = $this->input->post('jenisKelamin');
                $pendidikan = $this->input->post('pendidikan');
                $mulaiKerja = $this->input->post('mulaiKerja');

                if (!empty($_FILES['user_img_upload']['tmp_name'])) {
                    $fotoProfile = $this->_upload_foto($nip);
                } else {
                    $fotoProfile = 'default.jpg';
                }
                $userInfo = array(
                    'email' => $email,
                    'password' => md5($password),
                    'roleId' => $roleId,
                    'name' => $name,
                    'nip' => $nip,
                    'mobile' => $mobile,
                    'createdBy' => $this->vendorId,
                    'createdDtm' => date('Y-m-d H:i:sa'),
                    'fotoProfil' => $fotoProfile,
                    'tbl_jabatan_idJabatan' => $idJabatan,
                    'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
                $result = $this->user_model->addNewUser($userInfo);
                if ($result == true) {
                    $this->session->set_flashdata('success', 'User berhasil ditambahkan');
                } else {
                    $this->session->set_flashdata('error', 'User gagal ditambahkan');
                }
                redirect('user/userListing');
            }
        }
    }

    public function _upload_foto($user_id)
    {

        $config['upload_path'] = './upload/images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = $user_id . '_' . date('Ymdhis');
        // --
        $this->tupload->initialize($config);
        // process upload images
        if ($this->tupload->do_upload_image('user_img_upload', 128, false)) {
            // --
            $data = $this->tupload->data();
            // --
            return $data['file_name'];
        }
    }
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    public function editOld($userId = null)
    {
        $data['roles'] = $this->user_model->getUserRoles();
        $data['jabatan'] = $this->user_model->getUserJabatanInfo();
        $data['pangkat'] = $this->user_model->getUserPangkat();
        $data['userInfo'] = $this->user_model->getUserInfo($userId);
        $this->global['pageTitle'] = 'Ubah Rescuer';
        $this->load->view('includes/header', $this->global);
        $this->load->view('rescuer/editOld', $data);
        $this->load->view('includes/footer');
    }

    public function callJabatan()
    {
        $id = $this->input->post('idPangkat');
        $data = $this->user_model->getUserJabatan($id);
        echo json_encode($data);
    }

    /**
     * This function is used to edit the user information
     */
    public function editUser()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]|xss_clean');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('nomorSeriKartuPegawai', 'Nomor Seri Kartu Pegawai', 'trim|required');
        $this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('mulaiKerja', 'Mulai Kerja', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->editOld($userId);
        } else {
            $userId = $this->input->post('userId');
            $name = ucwords(strtolower($this->input->post('fname')));
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $roleId = 7;
            $nip = $this->input->post('nip');
            $mobile = $this->input->post('mobile');
            $idJabatan = $this->input->post('jabatan');
            $idDivisi = 16;
            $nomorSeriKartuPegawai = $this->input->post('nomorSeriKartuPegawai');
            $tanggalLahir = $this->input->post('tanggalLahir');
            $tempatLahir = $this->input->post('tempatLahir');
            $jenisKelamin = $this->input->post('jenisKelamin');
            $pendidikan = $this->input->post('pendidikan');
            $mulaiKerja = $this->input->post('mulaiKerja');
            if (!empty($_FILES['user_img_upload']['tmp_name'])) {
                $fotoProfile = $this->_upload_foto($nip);
            } else {
                $data = $this->user_model->getUserInfo($userId);
                $fotoProfile = $data[0]->fotoProfil;
            }

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array(
                    'email' => $email, 'roleId' => $roleId, 'name' => $name, 'tbl_divisi_idDivisi' => $idDivisi, 'nip' => $nip,
                    'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:sa'),
                    'fotoProfil' => $fotoProfile, 'tbl_jabatan_idJabatan' => $idJabatan, 'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            } else if (empty($password) && empty($_FILES['user_img_upload']['tmp_name'])) {
                $userInfo = array(
                    'email' => $email, 'password' => md5($password), 'roleId' => $roleId, 'name' => $name, 'tbl_divisi_idDivisi' => $idDivisi, 'nip' => $nip,
                    'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:sa'),
                    'tbl_jabatan_idJabatan' => $idJabatan, 'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            } else {
                $userInfo = array(
                    'email' => $email, 'password' => md5($password), 'roleId' => $roleId, 'name' => $name, 'tbl_divisi_idDivisi' => $idDivisi, 'nip' => $nip,
                    'mobile' => $mobile, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:sa'),
                    'fotoProfil' => $fotoProfile, 'tbl_jabatan_idJabatan' => $idJabatan, 'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            }

            $result = $this->user_model->editUser($userInfo, $userId);

            if ($result) {
                $this->session->set_flashdata('success', 'User berhasil diperbaharui');
            } else {
                $this->session->set_flashdata('error', 'User gagal diperbaharui');
            }

            redirect('rescuer/rescuerListing');
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    public function deleteUser()
    {
        $userId = $this->input->post('userId');
        $userInfo = array('isDeleted' => 1, 'updatedBy' => $this->vendorId, 'updatedDtm' => date('Y-m-d H:i:sa'));

        $result = $this->user_model->deleteUser($userId, $userInfo);

        if ($result > 0) {
            echo (json_encode(array('status' => true)));
        } else {
            echo (json_encode(array('status' => false)));
        }
    }

    /**
     * This function is used to load the change password screen
     */
    public function loadChangePass()
    {
        $this->global['pageTitle'] = 'Ubah Profil';
        $userId = $this->session->userdata('userId');
        $data['roles'] = $this->user_model->getUserRoles();
        $data['jabatan'] = $this->user_model->getUserJabatanInfo();
        $data['pangkat'] = $this->user_model->getUserPangkat();
        $data['userInfo'] = $this->user_model->getUserInfoAll($userId);
        $this->load->view('includes/header', $this->global);
        $this->load->view('user/changePassword', $data);
        $this->load->view('includes/footer');
    }

    /**
     * This function is used to change the password of the user
     */
    public function changePassword()
    {
        $this->load->library('form_validation');

        $userId = $this->input->post('userId');

        $this->form_validation->set_rules('fname', 'Full Name', 'trim|required|max_length[128]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'matches[password]|max_length[20]');
        //$this->form_validation->set_rules('role', 'Role', 'trim|required|numeric');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|min_length[10]|xss_clean');
        $this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric');
        //$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('nomorSeriKartuPegawai', 'Nomor Seri Kartu Pegawai', 'trim|required');
        $this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required');
        $this->form_validation->set_rules('mulaiKerja', 'Mulai Kerja', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->editOld($userId);
        } else {
            $userId = $this->input->post('userId');
            $name = ucwords(strtolower($this->input->post('fname')));
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //$roleId = $this->input->post('role');
            $nip = $this->input->post('nip');
            $mobile = $this->input->post('mobile');
            //$idJabatan = $this->input->post('jabatan');
            $idDivisi = 16;
            $nomorSeriKartuPegawai = $this->input->post('nomorSeriKartuPegawai');
            $tanggalLahir = $this->input->post('tanggalLahir');
            $tempatLahir = $this->input->post('tempatLahir');
            $jenisKelamin = $this->input->post('jenisKelamin');
            $pendidikan = $this->input->post('pendidikan');
            $mulaiKerja = $this->input->post('mulaiKerja');
            if (!empty($_FILES['user_img_upload']['tmp_name'])) {
                $fotoProfile = $this->_upload_foto($nip);
            } else {
                $data = $this->user_model->getUserInfo($userId);
                $fotoProfile = $data[0]->fotoProfil;
            }

            $userInfo = array();

            if (empty($password)) {
                $userInfo = array(
                    'email' => $email,
                    //'roleId' => $roleId,
                    'name' => $name,
                    //'tbl_divisi_idDivisi' => $idDivisi,
                    'nip' => $nip,
                    'mobile' => $mobile,
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:sa'),
                    'fotoProfil' => $fotoProfile,
                    // 'tbl_jabatan_idJabatan' => $idJabatan,
                    'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            } else if (empty($password) && empty($_FILES['user_img_upload']['tmp_name'])) {
                $userInfo = array(
                    'email' => $email, 'password' => md5($password),
                    'roleId' => $roleId,
                    'name' => $name,
                    //'tbl_divisi_idDivisi' => $idDivisi,
                    'nip' => $nip,
                    'mobile' => $mobile,
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:sa'),
                    //'tbl_jabatan_idJabatan' => $idJabatan,
                    'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            } else {
                $userInfo = array(
                    'email' => $email,
                    'password' => md5($password),
                    // 'roleId' => $roleId,
                    'name' => $name,
                    'tbl_divisi_idDivisi' => $idDivisi,
                    'nip' => $nip,
                    'mobile' => $mobile,
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:sa'),
                    'fotoProfil' => $fotoProfile,
                    // 'tbl_jabatan_idJabatan' => $idJabatan,
                    'nomorSeriKartuPegawai' => $nomorSeriKartuPegawai,
                    'tanggalLahir' => $tanggalLahir,
                    'tempatLahir' => $tempatLahir,
                    'jenisKelamin' => $jenisKelamin,
                    'pendidikan' => $pendidikan,
                    'mulaiKerja' => $mulaiKerja,
                );
            }

            $result = $this->user_model->editUser($userInfo, $userId);

            if ($result) {
                $this->session->set_flashdata('success', 'User berhasil diperbaharui');
            } else {
                $this->session->set_flashdata('error', 'User gagal diperbaharui');
            }

            redirect('dashboard');
        }
    }
}
