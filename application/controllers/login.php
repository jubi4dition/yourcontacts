<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		if(!$this->is_logged_in()){
			$this->load->view('login', array('message' => FALSE));
		}
		else{
			redirect('site');
		}
	}
	
	public function check_login()
	{			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
		$this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
		if ($this->form_validation->run() == FALSE)
		{
			redirect('login/login_failed');
		}
		else{
			$isuser = $this->contacts_model->is_user($this->input->post('email'), $this->input->post('pwd'));
			if($isuser)
			{
				$email = $this->input->post('email');
				$uid = $this->contacts_model->get_uid($email);
				$data = array(
					'email' => $email,
					'uid' => $uid,
					'is_logged_in' => TRUE,
					'is_admin' => FALSE
				);
				$this->session->set_userdata($data);
				redirect('site');
			}
			else{
				redirect('login/login_failed');
			}
		}
	}
	
	public function login_failed()
	{
		$this->load->view('login', array('message' => TRUE));
	}
	
	public function logout()
	{
		if(!$this->is_logged_in()){
			redirect('login');
		}
		else{
			$this->session->set_userdata(array('is_logged_in' => FALSE));
			$this->session->sess_destroy();
			$this->load->view('login', array('message' => FALSE));
		}
	}
	
	private function is_logged_in()
	{
		return $this->session->userdata('is_logged_in');
	}
}
/*End of file login.php*/
