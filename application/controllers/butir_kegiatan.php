<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Butir_Kegiatan extends CI_Controller
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
        $this->load->model('butir_kegiatan_model');
        $this->load->model('butir_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Butir Kegiatan';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('butir_kegiatan/butir_kegiatan');
        $this->load->view('includes/footer');
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('/login');
        }
        else
        {
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
    function isAdmin()
    {
        if($this->role != ROLE_ADMIN) { return true; }
        else {return false; }
    }
    
    /**
     * This function is used to check the access
     */
    function isTicketter()
    {
        if($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) { return true; }
        else {return false; }
        
    }
    
    /**
     * This function is used to load the set of views
     */
    function loadThis()
    {
        $this->global['pageTitle'] = 'Akses Ditolak';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('access');
        $this->load->view('includes/footer');
    }
    
    
    /**
     * This function is used to logged out user from system
     */
    function logout()
    {
        $this->session->sess_destroy();
        
        redirect('/login');
    }

    function butirKegiatanListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {                 
            $data['butirKegiatanRecords'] = $this->butir_kegiatan_model->butirKegiatanListing();
            $this->global['pageTitle'] = 'Daftar Butir Kegiatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir_kegiatan/butir_kegiatan', $data);
            $this->load->view('includes/footer');
        }
    }

    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['butir'] = $this->butir_kegiatan_model->getUserButir();            
            $this->global['pageTitle'] = 'Tambahkan Data Butir Kegiatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir_kegiatan/addNew', $data);
            $this->load->view('includes/footer');
        }
    }
    
    function addNewButir()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('keterangan','Butir Kegiatan','trim|required');
            $this->form_validation->set_rules('butir','butir','trim|required');
            $this->form_validation->set_rules('point','Point','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $keterangan = ucwords(strtolower($this->input->post('keterangan')));
                $butir = $this->input->post('butir');
                $point = $this->input->post('point');
                
                $butirKegiatanInfo = array(
                    'keterangan' => $keterangan,
                    'idButir' => $butir,
                    'point' => $point
                );
                
                $result = $this->butir_kegiatan_model->addNewButir($butirKegiatanInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Butir Kegiatan Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Butir Kegiatan Gagal Ditambahkan');
                }
                
                redirect('butir_kegiatan/butirKegiatanListing');
            }
        }
    }

    function deleteButir()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idButir = $this->input->post('idButirKegiatan');
            $butirInfo = 'tbl_butir_kegiatan';
            $data = array('idButirKegiatan' => $idButir);
            
            $result = $this->butir_model->deleteButir($data, $butirInfo);

            //print_r($result);die;
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 0)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('butir_kegiatan/butirKegiatanListing');
            }
            $data['butirInfo'] = $this->butir_kegiatan_model->getButirInfo($userId);
            $data['butir'] = $this->butir_kegiatan_model->getUserButir();  
            $this->global['pageTitle'] = 'Ubah Butir Kegiatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir_kegiatan/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editButir()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idButir = $this->input->post('idButirKegiatan');
            
            $this->form_validation->set_rules('fbutir','Butir Kegiatan','trim|required');
            $this->form_validation->set_rules('idButir','butir','trim|required');
            $this->form_validation->set_rules('point','Point','trim|required');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idButir);
            }
            else
            {
                $keterangan = ucwords(strtolower($this->input->post('fbutir')));
                $butir = $this->input->post('idButir');
                $point = $this->input->post('point');
                
                $butirInfo = array(
                    'keterangan' => $keterangan,
                    'idButir' => $butir,
                    'point' => $point
                );
             
                $where = array(
                    'idButirKegiatan' => $idButir
                );
                $result = $this->butir_model->editButir($where,$butirInfo,'tbl_butir_kegiatan');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Butir Kegiatan Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Butir Kegiatan Gagal Diperbaharui');
                }
                
                redirect('butir_kegiatan/butirKegiatanListing');
            }
        }
    }
}

?>