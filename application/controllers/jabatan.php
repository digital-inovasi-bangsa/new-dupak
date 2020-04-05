<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
        $this->load->model('jabatan_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Jabatan';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('jabatan/jabatan');
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

    function jabatanListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {                 
            $data['jabatanRecords'] = $this->jabatan_model->jabatanListing();
            $this->global['pageTitle'] = 'Dupak : Jabatan Listing';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jabatan/jabatan', $data);
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
            $this->load->model('jabatan_model');
            $data['pangkat'] = $this->jabatan_model->getUserPangkat();
            
            $this->global['pageTitle'] = 'Dupak : Add New Jabatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jabatan/addNew', $data);
            $this->load->view('includes/footer');
        }
    }
    
    function addNewJabatan()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fjabatan','Jabatan','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('pangkat','pangkat','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $namaJabatan = ucwords(strtolower($this->input->post('fjabatan')));
                $idPangkat = $this->input->post('pangkat');
                
                $jabatanInfo = array(
                    'namaJabatan' => $namaJabatan,
                    'tbl_pangkat_idpangkat' => $idPangkat
                );
                
                $result = $this->jabatan_model->addNewJabatan($jabatanInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Pangkat created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pangkat creation failed');
                }
                
                redirect('jabatan/jabatanListing');
            }
        }
    }

    function deleteJabatan()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idJabatan = $this->input->post('idJabatan');
            $jabatanInfo = 'tbl_jabatan';
            $data = array('idJabatan' => $idJabatan);
            
            $result = $this->jabatan_model->deleteJabatan($data, $jabatanInfo);

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
                redirect('jabatan/jabatanListing');
            }
            $data['jabatanInfo'] = $this->jabatan_model->getJabatanInfo($userId);
            $data['pangkat'] = $this->jabatan_model->getUserPangkat();
            // print_r($data);die;
            $this->global['pageTitle'] = 'Dupak : Edit Jabatan';
            $this->load->view('includes/header', $this->global);
            $this->load->view('jabatan/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editJabatan()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idJabatan = $this->input->post('idJabatan');
            
            $this->form_validation->set_rules('fjabatan','Pangkat Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idJabatan);
            }
            else
            {
                $namaJabatan = ucwords(strtolower($this->input->post('fjabatan')));
                $idPangkat = $this->input->post('idPangkat');
                $data = array(
                    'tbl_pangkat_idPangkat' => $idPangkat,
                    'namaJabatan' => $namaJabatan
                );
             
                $where = array(
                    'idJabatan' => $idJabatan
                );
                $result = $this->jabatan_model->editJabatan($where,$data,'tbl_jabatan');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Pangkat updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pangkat updation failed');
                }
                
                redirect('jabatan/jabatanListing');
            }
        }
    }
}

?>