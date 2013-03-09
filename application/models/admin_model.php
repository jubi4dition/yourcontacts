<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function is($name, $password)
    {
        $query = $this->db->get_where('admins', array('name' => $name, 'password' => md5($password)));
        
        return ($query->num_rows == 1) ? TRUE : FALSE;
    }
}
