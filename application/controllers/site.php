<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->is_logged_in()){
			redirect('login');
		}
	}
	
	public function index()
	{
		$contacts = $this->contacts_model->get_contacts($this->session->userdata('uid'));
		
		$this->load->view('contacts', array(
			'contacts' => $contacts, 
		));
	}
	
	public function add()
	{
		$this->load->view('add');
	}
	
	public function add_contact()
	{
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Adding</strong> failed!"
			));
			echo $json;
		}
		else{
			$is_added = $this->contacts_model->add_contact($this->input->post('name'), $this->input->post('email'), 
								$this->input->post('phone'), $this->session->userdata('uid'));
			if($is_added)
			{
				$message = "<strong>".$this->input->post('name')."</strong> has been added!";
				$json = json_encode(array(
					'isSuccessful' => TRUE,
					'message' => $message
				));
				echo $json;
			}
			else{
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
		$contacts = $this->contacts_model->get_contact_names($this->session->userdata('uid'));
		
		$this->load->view('delete', array(
			'contacts' => $contacts, 
		));
	}
	
	public function delete_contact()
	{
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Deletion</strong> failed!"
			));
			echo $json;
		}
		else{
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
		$contacts = $this->contacts_model->get_contact_names($this->session->userdata('uid'));
		if(count($contacts) > 0){
			$firstcontact = $this->contacts_model->get_contact_data(
						$this->session->userdata('uid'), $contacts[0]['name']);
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
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Editing</strong> failed!"
			));
			echo $json;
		}
		else{
			$this->contacts_model->update_contact($this->input->post('name'), $this->input->post('email'),
							$this->input->post('phone'), $this->session->userdata('uid'));
			
			$message = "Editing for <strong>".$this->input->post('name')."</strong> has been done!";
			$json = json_encode(array(
				'isSuccessful' => TRUE,
				'message' => $message
			));
			echo $json;
		}
	}
	
	public function get_contact_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|alpha_name');
		if ($this->form_validation->run() == FALSE){
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "No <strong>Data</strong> for contact!"
			));
			echo $json;
		}
		else{
			$contact = $this->contacts_model->get_contact_data(
					$this->session->userdata('uid'), $this->input->post('name'));
			if(count($contact) == 0){
				$json = json_encode(array(
					'isSuccessful' => FALSE,
					'message' => "No <strong>Data</strong> for contact!"
				));
				echo $json;
			}
			else{
				$json = json_encode(array(
					'isSuccessful' => TRUE,
					'email' => $contact['email'],
					'phone' => $contact['phone']
				));
				echo $json;
			}
		}
	}
	
	public function profile()
	{
		$this->load->view('profile');
	}
	
	public function change_password()
	{
		sleep(2);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('curpwd', 'Current Password', 'required|max_length[20]|alpha_numeric');
		$this->form_validation->set_rules('newpwd', 'New Password', 'required|max_length[20]|alpha_numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$json = json_encode(array(
				'isSuccessful' => FALSE,
				'message' => "<strong>Changing</strong> failed!"
			));
			echo $json;
		}
		else{
			$pwd_valid = $this->contacts_model->validate_password($this->session->userdata('uid'), 
										$this->input->post('curpwd'));
			if($pwd_valid)
			{	
				$this->contacts_model->update_password($this->session->userdata('uid'), 
									$this->input->post('newpwd'));
			
				$message = "<strong>Password</strong> has been changed!";
				$json = json_encode(array(
					'isSuccessful' => TRUE,
					'message' => $message
				));
				echo $json;
			}
			else{
				$message = "<strong>Current Password</strong> is wrong!";
				$json = json_encode(array(
					'isSuccessful' => FALSE,
					'message' => $message
				));
				echo $json;
			}
		}
	}
	
	private function is_logged_in()
	{
		return $this->session->userdata('is_logged_in');
	}
}
/* End of file site.php */