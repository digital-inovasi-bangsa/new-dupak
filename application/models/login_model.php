<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($email, $ecryptPassword)
    {
        $this->db->select('*');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.password', $ecryptPassword);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
}

?>