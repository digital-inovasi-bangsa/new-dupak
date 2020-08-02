<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    public function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $data['pageTitle'] = 'Masuk Ke Sistem';
            $this->load->view('includes/auth/header', $data);
            $this->load->view('login');
            $this->load->view('includes/auth/footer');
        } else {
            redirect('/dashboard');
        }
    }

    public function forgotPassword()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['pageTitle'] = 'Lupa Kata Sandi';
            $this->load->view('includes/auth/header', $data);
            $this->load->view('forgot/forgotpassword');
            $this->load->view('includes/auth/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('tbl_users', ['email' => $email])->row_array();
            //$user = $email;

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                ];
                $this->db->insert('tbl_tokens', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Cek email anda untuk melakukan reset password</div>');
                redirect('login/forgotpassword');
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar!');
                redirect('login/forgotpassword');
            }
        }
    }

    public function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => getenv('EMAIL_ADDRESS'),
            'smtp_pass' => getenv('EMAIL_PASSWORD'),
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $this->email->from(getenv('EMAIL_ADDRESS'), 'Basarnas Jogja');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'login/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'login/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('tbl_users', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('tbl_tokens', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('login');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('login');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('includes/auth/header', $data);
            $this->load->view('forgot/changepassword');
            $this->load->view('includes/auth/footer');
        } else {
            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('tbl_users');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('tbl_tokens', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('login');
        }
    }

    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]|');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $ecryptPassword = md5($password);

            $result = $this->login_model->loginMe($email, $ecryptPassword);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = array(
                        'userId' => $res->userId,
                        'role' => $res->roleId,
                        'roleText' => $res->role,
                        'name' => $res->name,
                        'fotoProfil' => $res->fotoProfil,
                        'idJabatan' => $res->tbl_jabatan_idJabatan,
                        'idPangkat' => $res->tbl_pangkat_idPangkat,
                        'isLoggedIn' => true,
                    );

                    $this->session->set_userdata($sessionArray);
                    $this->session->set_flashdata('success', 'Berhasil Login Ke Sistem');
                    redirect('/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau Kata Sandi Salah');
                redirect('/login');
            }
        }
    }
}
