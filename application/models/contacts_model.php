<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model 
{
	public function is_user($email, $password)
	{
		$query = $this->db->get_where('users', array('email' => $email, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	public function is_admin($name, $password)
	{
		$query = $this->db->get_where('admins', array('name' => $name, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	public function get_uid($email)
	{
		$row = $this->db->get_where('users', array('email' => $email))->row();
		return $row->uid;
	}
	
	public function get_username($email)
	{
		$row = $this->db->get_where('members2', array('email' => $email))->row();
		return $row->username;
	}
	
	public function validate_password($uid, $password)
	{
		$query = $this->db->get_where('users', array('uid' => $uid, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	public function update_password($uid, $password)
	{
		$this->db->update('users', array('password' => md5($password)), array('uid' => $uid));
	}
	
	public function validate_admin_password($name, $password)
	{
		$query = $this->db->get_where('admins', array('name' => $name, 'password' => md5($password)));
		return ($query->num_rows == 1) ? TRUE : FALSE;
	}
	
	public function update_admin_password($name, $password)
	{
		$this->db->update('admins', array('password' => md5($password)), array('name' => $name));
	}
	
	public function get_contacts($uid)
	{
		$contacts = $this->db->select('name, email, phone')->
							order_by('name')->
							get_where('contacts', array('uid' => $uid))->result_array();
	 	return $contacts;
	}
	
	public function get_contact_names($uid)
	{
		$contacts = $this->db->select('name')->
							order_by('name')->
							get_where('contacts', array('uid' => $uid))->result_array();
	 	return $contacts;
	}
	
	public function get_contact_data($uid, $name)
	{
		$contact = $this->db->select('name, email, phone')->
							get_where('contacts', array('uid' => $uid, 'name' => $name))->
							row_array();
	 	return $contact;
	}
	
	public function add_contact($name, $email, $phone, $uid)
	{
		$query = $this->db->get_where('contacts', array('name' => $name, 'uid' => $uid));
		if($query->num_rows == 1){
			return FALSE;
		}
		$this->db->insert('contacts', array('name' => $name, 'email' => $email, 'phone' => $phone, 'uid' => $uid));

		$this->db->set('contacts', 'contacts+1', FALSE)->
				where('uid', $uid)->
				update('users');
		return TRUE;
	}
	
	public function delete_contact($name, $uid)
	{
		$this->db->delete('contacts', array('name' => $name, 'uid' => $uid));

		$this->db->set('contacts', 'contacts-1', FALSE)->
				where('uid', $uid)->
				update('users');
	}
	
	public function update_contact($name, $email, $phone, $uid)
	{
		$this->db->update('contacts', array('email' => $email, 'phone' => $phone), array('uid' => $uid, 'name' => $name));
	}
	
	public function get_users()
	{
		$users = $this->db->select('email, contacts')->
							order_by('email')->
							get('users')->result_array();
	 	return $users;
	}
	
	public function add_user($email, $password)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		if($query->num_rows == 1){
			return FALSE;
		}
		$this->db->insert('users', array('email' => $email, 'password' => md5($password))); 
		return TRUE;
	}
	
	public function delete_user($email)
	{
		$uid = $this->db->get_where('users', array('email' => $email))->row()->uid;
		$this->db->delete('contacts', array('uid' => $uid));
		
		$this->db->delete('users', array('email' => $email));
	}
	
	public function update_user($email, $password)
	{
		$this->db->update('users', array('password' => md5($password)), array('email' => $email));
	}
}
/* End of file contacts_model.php */