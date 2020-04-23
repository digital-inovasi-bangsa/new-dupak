<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Jenjang extends CI_Controller
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
        $this->load->model('jenjang_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Jenjang';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('jenjang/jenjang');
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

    function jenjangListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;            
            $count = $this->jenjang_model->jenjangListingCount();            
            $data['jenjangRecords'] = $this->jenjang_model->jenjangListing();            
            $this->global['pageTitle'] = 'Dupak : Jenjang Listing';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jenjang/jenjang', $data);
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
            $this->global['pageTitle'] = 'Dupak : Add New Jenjang';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jenjang/addNew');
            $this->load->view('includes/footer');
        }
    }
    
    function addNewJenjang()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fjenjang','Jenjang','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $namaJenjang = ucwords(strtolower($this->input->post('fjenjang')));
                
                $jenjangInfo = array(
                    'namaJenjang' => $namaJenjang
                );
                   

                $result = $this->jenjang_model->addNewJenjang($jenjangInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Jenjang Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Jenjang Gagal Ditambahkan');
                }
                
                redirect('jenjang/jenjangListing');
            }
        }
    }

     function deleteJenjang()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idJenjang = $this->input->post('idJenjang');
            $jenjangInfo = 'tbl_jenjang';
            $data = array('idJenjang' => $idJenjang);
            
            $result = $this->jenjang_model->deleteJenjang($data, $jenjangInfo);

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
                redirect('jenjang/jenjangListing');
            }
            $data['jenjangInfo'] = $this->jenjang_model->getJenjangInfo($userId);
            $this->global['pageTitle'] = 'Dupak : Edit Jenjang';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jenjang/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editJenjang()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idJenjang = $this->input->post('idJenjang');
            
            $this->form_validation->set_rules('fjenjang','Jenjang Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idJenjang);
            }
            else
            {
                $namaJenjang = ucwords(strtolower($this->input->post('fjenjang')));
                $data = array(
                    'namaJenjang' => $namaJenjang
                );
             
                $where = array(
                    'idJenjang' => $idJenjang
                );
                $result = $this->jenjang_model->editJenjang($where,$data,'tbl_jenjang');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Jenjang Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Jenjang Gagal Diperbaharui');
                }
                
                redirect('jenjang/jenjangListing');
            }
        }
    }
}

?>