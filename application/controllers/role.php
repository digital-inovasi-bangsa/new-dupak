<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller
{
    
    protected $role = ''; 
    protected $vendorId = '';
    protected $name = '';
    protected $roleText = '';
    protected $global = array();
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Role';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('role/role');
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
            
            $this->global['name'] = $this->name;
            $this->global['role'] = $this->role;
            $this->global['role_text'] = $this->roleText;
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

    function roleListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {                  
            $data['roleRecords'] = $this->role_model->roleListing();
            $this->global['pageTitle'] = 'Dupak : Role Listing';
            $this->load->view('includes/header', $this->global);
            $this->load->view('role/role', $data);
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
            $this->load->model('role_model');
            
            $this->global['pageTitle'] = 'Dupak : Add New Role';
            $this->load->view('includes/header', $this->global);
            $this->load->view('role/addNew');
            $this->load->view('includes/footer');
        }
    }
    
    function addNewRole()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('frole','Role','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $role = ucwords(strtolower($this->input->post('frole')));
                
                $roleInfo = array(
                    'role' => $role
                );
                
                $result = $this->role_model->addNewRole($roleInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Jabatan created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Jabatan creation failed');
                }
                
                redirect('role/addNew');
            }
        }
    }

    function deleteRole()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $roleId = $this->input->post('roleId');
            $roleInfo = 'tbl_roles';
            $data = array('roleId' => $roleId);
            
            $result = $this->role_model->deleteRole($data, $roleInfo);

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
                redirect('role/roleListing');
            }
            $data['roleInfo'] = $this->role_model->getRoleInfo($userId);
            
            $this->global['pageTitle'] = 'Dupak : Edit Role';
            $this->load->view('includes/header', $this->global);
            $this->load->view('role/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editRole()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $roleId = $this->input->post('roleId');
            
            $this->form_validation->set_rules('frole','Role Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($roleId);
            }
            else
            {
                $role = ucwords(strtolower($this->input->post('frole')));

                $data = array(
                    'role' => $role
                );
             
                $where = array(
                    'roleId' => $roleId
                );
                $result = $this->role_model->editRole($where,$data,'tbl_roles');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Role updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Role updation failed');
                }
                
                redirect('role/roleListing');
            }
        }
    }
}

?>