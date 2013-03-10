<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        
        if (!$this->is_logged_in()) {
            redirect('adminlogin');
        }
    }
    
    public function index()
    {
        $users = $this->user_model->get_all();
        
        $this->load->view('admin', array(
            'users' => $users
        ));
    }
    
    public function add()
    {
        $this->load->view('admin_add');
    }
    
    public function add_user()
    {
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Adding</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $is_added = $this->user_model->add($this->input->post('email'), $this->input->post('pwd'));
            
            if ($is_added) {
                $message = "<strong>".$this->input->post('email')."</strong> has been added!";
                $this->json_response(TRUE, $message);
            } else {
                $message = "<strong>".$this->input->post('email')."</strong> already exists!";
                $this->json_response(FALSE, $message);
            }
        }
    }
    
    public function delete()
    {
        $users = $this->user_model->get_emails();
        
        $this->load->view('admin_delete', array(
            'users' => $users
        ));
    }
    
    public function delete_user()
    {
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Deletion</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $email = $this->input->post('email');
            $this->user_model->delete($email);
            
            $message = "<strong>".$email."</strong> has been deleted!";
            echo json_encode(array(
                'isSuccessful' => TRUE,
                'message' => $message,
                'email' => $email
            ));
        }
    }
    
    public function edit()
    {
        $users = $this->user_model->get_emails();
        
        $this->load->view('admin_edit', array(
            'users' => $users 
        ));
    }
    
    public function edit_user()
    {
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Editing</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $this->user_model->update($this->input->post('email'), $this->input->post('pwd'));
            
            $message = "Editing for <strong>".$this->input->post('email')."</strong> has been done!";
            $this->json_response(TRUE, $message);
        }
    }
    
    public function profile()
    {
        $this->load->view('admin_profile');
    }
    
    public function change_password()
    {
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('curpwd', 'Current Password', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('newpwd', 'New Password', 'required|max_length[20]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Changing</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $pwd_valid = $this->admin_model->check_password(
                $this->session->userdata('admin'), $this->input->post('curpwd'));
            
            if ($pwd_valid) {   
                $this->admin_model->update_password(
                    $this->session->userdata('admin'), $this->input->post('newpwd'));
            
                $message = "<strong>Password</strong> has been changed!";
                $this->json_response(TRUE, $message);
            } else {
                $message = "<strong>Current Password</strong> is wrong!";
                $this->json_response(FALSE, $message);
            }
        }
    }
    
    private function is_logged_in()
    {
        return $this->session->userdata('is_admin');
    }

    private function json_response($successful, $message)
    {
        echo json_encode(array(
            'isSuccessful' => $successful,
            'message' => $message
        )); 
    }
}
/* End of file admin.php */
