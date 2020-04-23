<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi extends CI_Controller
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
        $this->load->model('divisi_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Divisi';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('divisi/divisi');
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
        $this->global['pageTitle'] = 'Dupak : Access Denied';
        
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

    function divisiListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;            
            $count = $this->divisi_model->divisiListingCount();            
            $data['divisiRecords'] = $this->divisi_model->divisiListing();
            // print_r($data['userRecords']);die;            
            $this->global['pageTitle'] = 'Lihat Divisi';
            $this->load->view('includes/header', $this->global);
            $this->load->view('divisi/divisi', $data);
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
            $this->global['pageTitle'] = 'Tambahkan Divisi';
            $this->load->view('includes/header', $this->global);
            $this->load->view('divisi/addNew');
            $this->load->view('includes/footer');
        }
    }
    
    function addNewDivisi()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fdivisi','Divisi','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $namaDivisi = ucwords(strtolower($this->input->post('fdivisi')));
                
                $divisiInfo = array(
                    'namaDivisi' => $namaDivisi
                );
                
                $result = $this->divisi_model->addNewDivisi($divisiInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Divisi Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Divisi Gagal Ditambahkan');
                }
                
                redirect('divisi/divisiListing');
            }
        }
    }

    function deleteDivisi()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idDivisi = $this->input->post('idDivisi');
            $divisiInfo = 'tbl_divisi';
            $data = array('idDivisi' => $idDivisi);
            
            $result = $this->divisi_model->deleteDivisi($data, $divisiInfo);
            
            if ($result) { 
                $this->session->set_flashdata('success', 'Divisi Berhasil Dihapus');
                echo(json_encode(array('status'=>TRUE))); 
            }
            else 
            { 
                $this->session->set_flashdata('error', 'Divisi Gagal Dihapus');
                echo(json_encode(array('status'=>FALSE))); 
            }
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
                redirect('divisi/divisiListing');
            }
            $data['divisiInfo'] = $this->divisi_model->getDivisiInfo($userId);
            $this->global['pageTitle'] = 'Dupak : Edit Divisi';
            $this->load->view('includes/header', $this->global);
            $this->load->view('divisi/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editDivisi()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idDivisi = $this->input->post('idDivisi');
            
            $this->form_validation->set_rules('fdivisi','Divisi Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idDivisi);
            }
            else
            {
                $namaDivisi = ucwords(strtolower($this->input->post('fdivisi')));
                $data = array(
                    'namaDivisi' => $namaDivisi
                );
             
                $where = array(
                    'idDivisi' => $idDivisi
                );
                $result = $this->divisi_model->editDivisi($where,$data,'tbl_divisi');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Divisi Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Divisi Gagal Diperbaharui');
                }
                
                redirect('divisi/divisiListing');
            }
        }
    }
}

?>