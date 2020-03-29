<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi extends CI_Controller
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
            
            $this->load->library('pagination');
            
            $count = $this->divisi_model->divisiListingCount($searchText);
            
            $config['base_url'] = base_url().'divisi/divisiListing';
            $config['total_rows'] = $count;
            $config['uri_segment'] = 2;
            $config['per_page'] = 5;
            $config['num_links'] = 5;
            $config['full_tag_open'] = '<nav><ul class="pagination">';
            $config['full_tag_close'] = '</ul></nav>';
            $config['first_tag_open'] = '<li class="arrow">';
            $config['first_link'] =  'First';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Previous';
            $config['prev_tag_open'] = '<li class="arrow">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li class="arrow">';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';        
            $config['last_tag_open'] = '<li class="arrow">';
            $config['last_link'] = 'Last';
            $config['last_tag_close'] = '</li>';
            
            $this->pagination->initialize($config);
            $page = $config['per_page'];
            $segment = $this->uri->segment(2);
            
            $data['divisiRecords'] = $this->divisi_model->divisiListing($searchText, $page, $segment);
            // print_r($data['userRecords']);die;            
            $this->global['pageTitle'] = 'Dupak : Divisi Listing';
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
            $this->global['pageTitle'] = 'Dupak : Add New Divisi';
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
                    $this->session->set_flashdata('success', 'New Divisi created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Divisi creation failed');
                }
                
                redirect('divisi/addNew');
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
                    $this->session->set_flashdata('success', 'Divisi updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Divisi updation failed');
                }
                
                redirect('divisi/divisiListing');
            }
        }
    }
}

?>