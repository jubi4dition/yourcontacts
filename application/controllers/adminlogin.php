<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlogin extends CI_Controller
{
	public function index()
	{
		if(!$this->is_logged_in()){
			$this->load->view('admin_login', array('message' => FALSE));
		}
		else{
			redirect('admin');
		}
	}
	
	public function check_login()
	{			
		$this->load->library('form_validation');
		$this->form_validation->set_rules('admin', 'Admin', 'required|max_length[40]|alpha_numeric');
		$this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
		if ($this->form_validation->run() == FALSE)
		{
			redirect('login/login_failed');
		}
		else{
			$admin = $this->input->post('admin');
			$is_admin = $this->contacts_model->is_admin($admin,  $this->input->post('pwd'));
			if($is_admin)
			{
				$data = array(
					'is_logged_in' => FALSE,
					'is_admin' => TRUE,
					'admin' => $admin
				);
				$this->session->set_userdata($data);
				redirect('admin');
			}
			else{
				redirect('adminlogin/login_failed');
			}
		}
	}
	
	public function login_failed()
	{
		$this->load->view('admin_login', array('message' => TRUE));
	}
	
	public function logout()
	{
		if(!$this->is_logged_in()){
			redirect('login');
		}
		else{
			$this->session->set_userdata(array('is_admin' => FALSE));
			$this->session->sess_destroy();
			$this->load->view('admin_login', array('message' => FALSE));
		}
	}
	
	private function is_logged_in()
	{
		return $this->session->userdata('is_admin');
	}
}
/*End of file adminlogin.php*/