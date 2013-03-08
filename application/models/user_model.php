<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function check_password($uid, $password)
    {
        $check = $this->db->get_where('users', array('uid' => $uid, 'password' => md5($password)));
        
        return ($check->num_rows == 1) ? TRUE : FALSE;
    }

    public function update_password($uid, $password)
    {
        return $this->db->update('users', array('password' => md5($password)), array('uid' => $uid));
    }
}
