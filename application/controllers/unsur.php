<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Unsur extends CI_Controller
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
        $this->load->model('unsur_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Unsur';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('unsur/unsur');
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

    function unsurListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;            
            $count = $this->unsur_model->unsurListingCount();            
            $data['unsurRecords'] = $this->unsur_model->unsurListing();            
            $this->global['pageTitle'] = 'Daftar Unsur';
            $this->load->view('includes/header', $this->global);
            $this->load->view('unsur/unsur', $data);
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
            $this->global['pageTitle'] = 'Tambahkan Data Unsur';
            $this->load->view('includes/header', $this->global);
            $this->load->view('unsur/addNew');
            $this->load->view('includes/footer');
        }
    }
    
    function addNewUnsur()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('funsur','Unsur','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
           {
                $namaUnsur = ucwords(strtolower($this->input->post('funsur')));
                
                $unsurInfo = array(
                    'namaUnsur' => $namaUnsur
                );
                   

                $result = $this->unsur_model->addNewUnsur($unsurInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Unsur Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Unsur Gagal Ditambahkan');
                }
                
                redirect('unsur/unsurListing');
            }
        }
    }

     function deleteUnsur()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idUnsur = $this->input->post('idUnsur');
            $unsurInfo = 'tbl_unsur';
            $data = array('idUnsur' => $idUnsur);
            
            $result = $this->unsur_model->deleteUnsur($data, $unsurInfo);

            // print_r($result);die;
            
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
                redirect('unsur/unsurListing');
            }
            $data['unsurInfo'] = $this->unsur_model->getUnsurInfo($userId);
            $this->global['pageTitle'] = 'Ubah Unsur';
            $this->load->view('includes/header', $this->global);
            $this->load->view('unsur/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editUnsur()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idUnsur = $this->input->post('idUnsur');
            
            $this->form_validation->set_rules('funsur','Unsur Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idUnsur);
            }
            else
            {
                $namaUnsur = ucwords(strtolower($this->input->post('funsur')));
                $data = array(
                    'namaUnsur' => $namaUnsur
                );
             
                $where = array(
                    'idUnsur' => $idUnsur
                );
                $result = $this->unsur_model->editUnsur($where,$data,'tbl_unsur');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Unsur Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Unsur Gagal Diperbaharui');
                }
                
                redirect('unsur/unsurListing');
            }
        }
    }
}

?>