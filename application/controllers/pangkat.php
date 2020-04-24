<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pangkat extends CI_Controller
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
        $this->load->model('pangkat_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Jabatan';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('pangkat/pangkat');
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

    function pangkatListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('pangkat_model');                        
            $data['pangkatRecords'] = $this->pangkat_model->pangkatListing();
            $this->global['pageTitle'] = 'Daftar Jabatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('pangkat/pangkat', $data);
            $this->load->view('includes/footer');
        }
    }
    
    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('pangkat_model');
            $data['roles'] = $this->pangkat_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Tambahkan Data Jabatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('pangkat/addNew', $data);
            $this->load->view('includes/footer');
        }
    }

    /**
     * This function is used to add new pangkat to the system
     */
    function addNewPangkat()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fpangkat','Pangkat','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fpangkat')));
                
                $pangkatInfo = array('namaPangkat'=>$name);
                
                $this->load->model('pangkat_model');
                $result = $this->pangkat_model->addNewPangkat($pangkatInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Jabatan Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Jabatan Gagal Ditambahkan');
                }
                
                redirect('pangkat/pangkatListing');
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
                redirect('pangkat/pangkatListing');
            }
            $this->load->model('pangkat_model');
            $data['pangkatInfo'] = $this->pangkat_model->getPangkatInfo($userId);
                   
            $this->global['pageTitle'] = 'Ubah Jabatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('pangkat/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editPangkat()
    {
        $this->load->model('pangkat_model');
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idPangkat = $this->input->post('idPangkat');
            
            $this->form_validation->set_rules('fpangkat','Pangkat Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idPangkat);
            }
            else
            {
                $namaPangkat = ucwords(strtolower($this->input->post('fpangkat')));
                $data = array(
                    'namaPangkat' => $namaPangkat
                );
             
                $where = array(
                    'idPangkat' => $idPangkat
                );
                $result = $this->pangkat_model->editPangkat($where,$data,'tbl_pangkat');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Jabatan Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Jabatan Gagal Diperbaharui');
                }
                
                redirect('pangkat/pangkatListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePangkat()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $pangkatId = $this->input->post('idPangkat');
            $pangkatInfo = 'tbl_pangkat';
            $data = array('idPangkat' => $pangkatId);
            
            $result = $this->pangkat_model->deletePangkat($data, $pangkatInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    
}

?>