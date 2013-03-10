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
            $json = json_encode(array(
                'isSuccessful' => FALSE,
                'message' => "<strong>Adding</strong> failed!"
            ));
            echo $json;
        } else {
            $is_added = $this->user_model->add($this->input->post('email'), $this->input->post('pwd'));
            
            if ($is_added) {
                $message = "<strong>".$this->input->post('email')."</strong> has been added!";
                $json = json_encode(array(
                    'isSuccessful' => TRUE,
                    'message' => $message
                ));
                echo $json;
            } else {
                $message = "<strong>".$this->input->post('email')."</strong> already exists!";
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
            $json = json_encode(array(
                'isSuccessful' => FALSE,
                'message' => "<strong>Deletion</strong> failed!"
            ));
            echo $json;
        } else {
            $email = $this->input->post('email');
            $this->user_model->delete($email);
            
            $message = "<strong>".$email."</strong> has been deleted!";
            $json = json_encode(array(
                'isSuccessful' => TRUE,
                'message' => $message,
                'email' => $email
            ));
            echo $json;
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
            $json = json_encode(array(
                'isSuccessful' => FALSE,
                'message' => "<strong>Editing</strong> failed!"
            ));
            echo $json;
        } else {
            $this->user_model->update($this->input->post('email'), $this->input->post('pwd'));
            
            $message = "Editing for <strong>".$this->input->post('email')."</strong> has been done!";
            $json = json_encode(array(
                'isSuccessful' => TRUE,
                'message' => $message
            ));
            echo $json;
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
            $json = json_encode(array(
                'isSuccessful' => FALSE,
                'message' => "<strong>Changing</strong> failed!"
            ));
            echo $json;
        } else {
            $pwd_valid = $this->admin_model->check_password(
                $this->session->userdata('admin'), $this->input->post('curpwd'));
            
            if ($pwd_valid) {   
                $this->admin_model->update_password(
                    $this->session->userdata('admin'), $this->input->post('newpwd'));
            
                $message = "<strong>Password</strong> has been changed!";
                $json = json_encode(array(
                    'isSuccessful' => TRUE,
                    'message' => $message
                ));
                echo $json;
            } else {
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
        return $this->session->userdata('is_admin');
    }
}
/* End of file admin.php */
