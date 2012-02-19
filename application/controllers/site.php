<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller 
{
	public function index()
	{
		if(!$this->is_logged_in()){
			$this->load->view('login', array('message' => FALSE));
			return;
		}
		
		$contacts = $this->contacts_model->get_contacts($this->session->userdata('uid'));
		
		$this->load->view('index', array(
			'contacts' => $contacts, 
		));
	}
	
	public function add()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$this->load->view('add');
	}
	
	public function add_contact()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Add</strong> failed, bad input!"
			));
			echo $json;
		}
		else
		{
			if($this->contacts_model->add_contact($this->input->post('name'), $this->input->post('email'), 
				$this->input->post('phone'), $this->session->userdata('uid')))
			{
				$message = "<strong>".$this->input->post('name')."</strong> has been added!";
				$json = json_encode(array(
					'isSuccessful' => TRUE,
					'message' => $message
				));
				echo $json;
			}
			else
			{
				$message = "<strong>".$this->input->post('name')."</strong> already exists!";
				$json = json_encode(array(
					'isSuccessful' => FALSE,
					'message' => $message
				));
				echo $json;
			}
		}
	}
	
	public function delete()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$contacts = $this->contacts_model->get_contact_names($this->session->userdata('uid'));
		
		$this->load->view('delete', array(
			'contacts' => $contacts, 
		));
	}
	
	public function delete_contact()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Delete</strong> failed, bad input!"
			));
			echo $json;
		}
		else
		{
			$name = $this->input->post('name');
			$this->contacts_model->delete_contact($name, $this->session->userdata('uid'));
			
			$message = "<strong>".$name."</strong> has been deleted!";
			$json = json_encode(array(
				'isSuccessful' => TRUE,
				'message' => $message,
				'name' => $name
			));
			echo $json;
		}
	}
	
	public function edit()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$contacts = $this->contacts_model->get_contact_names($this->session->userdata('uid'));
		if(count($contacts) > 0){
			$firstcontact = $this->contacts_model->get_contact_data($this->session->userdata('uid'), $contacts[0]['name']);
		}else{
			$firstcontact = array('email' => '', 'phone' => '');
		}
		
		$this->load->view('edit', array(
			'contacts' => $contacts,
			'firstcontact' => $firstcontact
		));
	}
	
	public function edit_contact()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Edit</strong> failed!"
			));
			echo $json;
		}
		else
		{
			$this->contacts_model->update_contact($this->input->post('name'), $this->input->post('email'),
									$this->input->post('phone'), $this->session->userdata('uid'));
			
			$message = "<strong>Edit</strong> has been done!";
			$json = json_encode(array(
				'isSuccessful' => TRUE,
				'message' => $message
			));
			echo $json;
		}
	}
	
	public function get_contact_data()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else
		{
			$contact = $this->contacts_model->get_contact_data($this->session->userdata('uid'), $this->input->post('name'));
			
			$json = json_encode(array(
				'name' => $contact['name'],
				'email' => $contact['email'],
				'phone' => $contact['phone']
			));
		echo $json;
		}
	}
	
	public function profile()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$this->load->view('profile');
	}
	
	public function change_password()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|max_length[20]|alpha_numeric');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|max_length[20]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Change</strong>Password failed!"
			));
			echo $json;
		}
		else
		{
			if($this->contacts_model->validate_password($this->session->userdata('uid'), $this->input->post('oldpassword')))
			{	
				$this->contacts_model->update_password($this->session->userdata('uid'), $this->input->post('newpassword'));
			
				$message = "<strong>Password</strong> has been changed!";
				$json = json_encode(array(
					'isSuccessful' => TRUE,
					'message' => $message
				));
				echo $json;
			}
			else
			{
				$message = "<strong>Old Password</strong> is wrong!";
				$json = json_encode(array(
					'isSuccessful' => FALSE,
					'message' => $message
				));
				echo $json;
			}
		}
	}
	
	public function check_login()
	{			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[20]|alpha_numeric');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('login', array('message' => TRUE));
			return;
		}
		
		$isuser = $this->contacts_model->is_user($this->input->post('email'),  $this->input->post('password'));
		if($isuser)
		{
			$email = $this->input->post('email');
			$uid = $this->contacts_model->get_uid($email);
			$data = array(
				'email' => $email,
				'uid' => $uid,
				'is_logged_in' => TRUE
			);
			$this->session->set_userdata($data);
			redirect('site');
		}else
		{
			$this->load->view('login', array('message' => TRUE));
		}
	}
	
	public function logout()
	{
		if(!$this->is_logged_in()){
			redirect('site');
		}
		
		$this->session->set_userdata(array('is_logged_in' => FALSE));
		$this->session->sess_destroy();
		redirect('site');
	}
	
	private function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			return false;
		}
		return true;
	}
}
/* End of file site.php */