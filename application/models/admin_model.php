<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function check_password($name, $password)
    {
        $query = $this->db->get_where('admins', array('name' => $name, 'password' => md5($password)));
        
        return ($query->num_rows == 1) ? TRUE : FALSE;
    }
    
    public function update_password($name, $password)
    {
        $this->db->update('admins', array('password' => md5($password)), array('name' => $name));
    }

    public function is($name, $password)
    {
        $query = $this->db->get_where('admins', array('name' => $name, 'password' => md5($password)));
        
        return ($query->num_rows == 1) ? TRUE : FALSE;
    }
}
