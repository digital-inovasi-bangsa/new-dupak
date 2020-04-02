<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('divisi_model');
        $this->isLoggedIn();   
    }
    
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Divisi';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('kegiatan/kegiatan');
        $this->load->view('includes/footer');
    }
    
   
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
    
   
    function isAdmin()
    {
        if($this->role != ROLE_ADMIN) { return true; }
        else {return false; }
    }
    
   
    function isTicketter()
    {
        if($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) { return true; }
        else {return false; }
        
    }
    
    
    function loadThis()
    {
        $this->global['pageTitle'] = 'Dupak : Access Denied';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('access');
        $this->load->view('includes/footer');
    }
    
    
   
    function logout()
    {
        $this->session->sess_destroy();
        
        redirect('/login');
    }

}

?>