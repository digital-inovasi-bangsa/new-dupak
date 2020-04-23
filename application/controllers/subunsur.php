<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Subunsur extends CI_Controller
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
        $this->load->model('subunsur_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Subunsur';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('subunsur/subunsur');
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

    function subunsurListing()
    {
        if($this->isAdmin() == TRUE)


        {
            $this->loadThis();
        }
        else
        {                 
            $data['subunsurRecords'] = $this->subunsur_model->subunsurListing();
            $this->global['pageTitle'] = 'Dupak : Subunsur Listing';
            $this->load->view('includes/header', $this->global);
            $this->load->view('subunsur/subunsur', $data);
            // echo '<pre>',print_r($data),'</pre>';die;
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
            $this->load->model('subunsur_model');
            $data['unsur'] = $this->subunsur_model->getUserUnsur();            
            $this->global['pageTitle'] = 'Dupak : Add New Subunsur';
            $this->load->view('includes/header', $this->global);
            $this->load->view('subunsur/addNew', $data);
            $this->load->view('includes/footer');
        }
    }
    
   function addNewSubunsur()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fsubunsur','Subunsur','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('idUnsur','unsur','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $namaSubunsur = ucwords(strtolower($this->input->post('fsubunsur')));
                $idUnsur = $this->input->post('idUnsur');
                
                $subunsurInfo = array(
                    'namaSubunsur' => $namaSubunsur,
                    'idUnsur' => $idUnsur
                );
                
                $result = $this->subunsur_model->addNewSubunsur($subunsurInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Sub Unsur Berhasil Ditambahkan');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Sub Unsur Gagal Ditambahkan');
                }
                
                redirect('subunsur/subunsurListing');
            }
        }
    }

    function deleteSubunsur()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $idSubunsur = $this->input->post('idSubunsur');
            $subunsurInfo = 'tbl_subunsur';
            $data = array('idSubunsur' => $idSubunsur);
            // print_r($data);die;
            $result = $this->subunsur_model->deleteSubunsur($data, $subunsurInfo);

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
                redirect('subunsur/subunsurListing');
            }
            $data['subunsurInfo'] = $this->subunsur_model->getSubunsurInfo($userId);
            $data['unsur'] = $this->subunsur_model->getUserUnsur();
            // print_r($this->subunsur_model->getSubunsurInfo($userId));die;
            $this->global['pageTitle'] = 'Dupak : Edit Subunsur';
            $this->load->view('includes/header', $this->global);
            $this->load->view('subunsur/editOld', $data);
            $this->load->view('includes/footer');
        }
    }

    function editSubunsur()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $idSubunsur = $this->input->post('idSubunsur');
            
            $this->form_validation->set_rules('fsubunsur','Unsur Lengkap','trim|required|max_length[128]|xss_clean');
    
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($idSubunsur);
            }
            else
            {
                $namaSubunsur = ucwords(strtolower($this->input->post('fsubunsur')));
                $idUnsur = $this->input->post('idUnsur');
                $data = array(
                    'idUnsur' => $idUnsur,
                    'namaSubunsur' => $namaSubunsur
                );
             
                $where = array(
                    'idSubunsur' => $idSubunsur
                );
                $result = $this->subunsur_model->editSubunsur($where,$data,'tbl_subunsur');
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Sub Unsur Berhasil Diperbaharui');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Sub Unsur Gagal Diperbaharui');
                }
                
                redirect('subunsur/subunsurListing');
            }
        }
    }
}

?>