<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
        $this->load->model('user_model');
        $this->load->library('tupload');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dupak : Dashboard';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('dashboard');
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
    
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['userRecords'] = $this->user_model->userListing();
            $this->global['pageTitle'] = 'Dupak : User Listing';
            $this->load->view('includes/header', $this->global);
            $this->load->view('user/users', $data);
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
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            $data['divisi'] = $this->user_model->getUserDivisi();
            $data['jabatan'] = $this->user_model->getUserJabatan();
            $this->global['pageTitle'] = 'Dupak : Add New User';
            $this->load->view('includes/header', $this->global);
            $this->load->view('user/addNew', $data);
            $this->load->view('includes/footer');
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]|is_unique[tbl_users.email]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('divisi','Divisi','trim|required');
            $this->form_validation->set_rules('nip','NIP','trim|required|numeric|min_length[11]|xss_clean');
            $this->form_validation->set_rules('mobile','Mobile Number','required|numeric|min_length[11]|xss_clean');
            $this->form_validation->set_rules('jabatan','Jabatan','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $idDivisi = $this->input->post('divisi');
                $nip = $this->input->post('nip');
                $mobile = $this->input->post('mobile');
                $idJabatan = $this->input->post('jabatan');
                
                if (!empty($_FILES['user_img_upload']['tmp_name'])) {
                    $fotoProfile = $this->_upload_foto($nip);
                } else {
                    $fotoProfile = 'default.jpg';
                }
                $userInfo = array( 
                    'email'=>$email, 
                    'password'=>md5($password), 
                    'roleId'=>$roleId, 
                    'name'=> $name,
                    'tbl_divisi_idDivisi'=>$idDivisi,
                    'nip'=>$nip,
                    'mobile'=>$mobile, 
                    'createdBy'=>$this->vendorId,
                    'createdDtm'=>date('Y-m-d H:i:sa'),
                    'fotoProfil'=> $fotoProfile,
                    'tbl_jabatan_idJabatan'=> $idJabatan
                );
                $result = $this->user_model->addNewUser($userInfo);
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                redirect('user/addNew');
            }
        }
    }

    public function _upload_foto($user_id){
        
		$config['upload_path'] = './upload/images/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['file_name'] = $user_id . '_' . date('Ymdhis');
        // --
        $this->tupload->initialize($config);
        // process upload images
        if ($this->tupload->do_upload_image('user_img_upload', 128, false)) {
        // --
            $data = $this->tupload->data();
        // --
            return $data['file_name'];
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
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['divisi'] = $this->user_model->getUserDivisi();
            $data['jabatan'] = $this->user_model->getUserJabatan();
            $data['ok'] = $this->user_model->getUserJabatan();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);   
            $this->global['pageTitle'] = 'Dupak : Edit User';
            // print_r($data['userInfo']);die;
            $this->load->view('includes/header', $this->global);
            $this->load->view('user/editOld', $data);
            $this->load->view('includes/footer');
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $idDivisi = $this->input->post('divisi');
                $nip = $this->input->post('nip');
                $mobile = $this->input->post('mobile');
                $idJabatan = $this->input->post('jabatan');
                if (!empty($_FILES['user_img_upload']['tmp_name'])) {
                    $fotoProfile = $this->_upload_foto($nip);
                } else {
                    $fotoProfile = 'default.jpg';
                }
                
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,'tbl_divisi_idDivisi'=>$idDivisi, 'nip'=>$nip,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'),
                                    'fotoProfil'=> $fotoProfile, 'tbl_jabatan_idJabatan' => $idJabatan);
                }
                else
                {
                    $userInfo = array('email'=>$email,'password'=>md5($password), 'roleId'=>$roleId, 'name'=>$name,'tbl_divisi_idDivisi'=>$idDivisi, 'nip'=>$nip,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'),
                                    'fotoProfil'=> $fotoProfile, 'tbl_jabatan_idJabatan'=>$idJabatan);
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($this->db->error()){
                    $this->session->set_flashdata('error', 'User updation failed');
                } else {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                
                // if($result)
                // {
                //     $this->session->set_flashdata('success', 'User updated successfully');
                // }
                // else
                // {
                //     $this->session->set_flashdata('error', 'User updation failed');
                // }
                
                redirect('user/userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Dupak : Change Password';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('user/changePassword');
        $this->load->view('includes/footer');
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, md5($oldPassword));
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>md5($newPassword), 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('loadChangePass');
            }
        }
    }
}

?>