<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends CI_Model 
{
    public function get_all($uid)
    {
        $contacts = $this->db->order_by('cid')
            ->get_where('contacts', array('uid' => $uid))
            ->result_array();
        
        return $contacts;
    }

    public function get_names($uid)
    {
        $contacts = $this->db->select('name')
            ->order_by('name')
            ->get_where('contacts', array('uid' => $uid))
            ->result_array();

        return $contacts;
    }

    public function get_data($uid, $name)
    {
        $contact = $this->db->select('name, email, phone')
            ->get_where('contacts', array('uid' => $uid, 'name' => $name))
            ->row_array();

        return $contact;
    }

    public function add($name, $email, $phone, $uid)
    {
        $query = $this->db->get_where('contacts', array('name' => $name, 'uid' => $uid));
        
        if ($query->num_rows == 1) {
            return FALSE;
        }

        $this->db->insert('contacts', array('name' => $name, 'email' => $email, 'phone' => $phone, 'uid' => $uid));

        $this->db->set('contacts', 'contacts+1', FALSE)
            ->where('uid', $uid)
            ->update('users');

        return TRUE;
    }

    public function delete($name, $uid)
    {
        $this->db->delete('contacts', array('name' => $name, 'uid' => $uid));

        $this->db->set('contacts', 'contacts-1', FALSE)
            ->where('uid', $uid)
            ->update('users');
    }

    public function update($name, $email, $phone, $uid)
    {
        $this->db->where(array('uid' => $uid, 'name' => $name))
            ->update('contacts', array('email' => $email, 'phone' => $phone));        
    }

}
