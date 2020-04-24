<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Butir extends CI_Controller
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
        $this->load->model('butir_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Butir';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('butir/butir');
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

    function butirListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {                 
            $data['butirRecords'] = $this->butir_model->butirListing();
            $this->global['pageTitle'] = 'Daftar Butir';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir/butir', $data);
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
            $this->load->model('butir_model');
            $data['subunsur'] = $this->butir_model->getUserSubunsur();
            
            $this->global['pageTitle'] = 'Tambahkan Data Butir';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir/addNew', $data);
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
            
            $this->form_validation->set_rules('fbutir','Butir','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('subunsur','subunsur','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $namaButir = ucwords(strtolower($this->input->post('fbutir')));
                $idSubunsur = $this->input->post('subunsur');
                
                $butirInfo = array(
                    'namaButir' => $namaButir,
                    'idSubunsur' => $idSubunsur
                );
                
                $result = $this->butir_model->addNewButir($butirInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Butir Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Butir Gagal Ditambahkan');
                }
                
                redirect('butir/butirListing');
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
            $idButir = $this->input->post('idButir');
            $butirInfo = 'tbl_butir';
            $data = array('idButir' => $idButir);
            
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
                redirect('butir/butirListing');
            }
            $data['butirInfo'] = $this->butir_model->getButirInfo($userId);
            $data['subunsur'] = $this->butir_model->getUserSubunsur();
            $this->global['pageTitle'] = 'Ubah Butir';
            $this->load->view('includes/header', $this->global);
            $this->load->view('butir/editOld', $data);
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
            
            $idButir = $this->input->post('idButir');
            
            $this->form_validation->set_rules('fbutir','Nama Butir','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idButir);
            }
            else
            {
                $namaButir = ucwords(strtolower($this->input->post('fbutir')));
                $idSubunsur = $this->input->post('subunsur');
                
                $butirInfo = array(
                    'namaButir' => $namaButir
                );
             
                $where = array(
                    'idButir' => $idButir
                );
                $result = $this->butir_model->editButir($where,$butirInfo,'tbl_butir');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Butir Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Butir Gagal Diperbaharui');
                }
                
                redirect('butir/butirListing');
            }
        }
    }
}

?>