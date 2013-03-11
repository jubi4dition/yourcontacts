<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller
{
    public function index()
    {
        $this->load->view('signup');
    }
    
    public function check()
    {           
        sleep(1);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('email2', 'Email2', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('pwd2', 'Password2', 'required|max_length[20]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Registration</strong> failed! Incorrect input!";
            $this->json_response(FALSE, $message);
        } else {   
            $email = $this->input->post('email');
            $pwd = $this->input->post('pwd');
            
            if ($email != $this->input->post('email2')) {
                $message = "<strong>Emails</strong> do not match!";
                $this->json_response(FALSE, $message);
            } elseif ($pwd != $this->input->post('pwd2')) {
                $message = "<strong>Passwords</strong> do not match!";
                $this->json_response(FALSE, $message);
            
            } elseif ($this->user_model->add($email, $pwd)) {
                $message = "<strong>Registration</strong> successful!";
                $this->json_response(TRUE, $message);
            } else {
                $message = "<strong>Email</strong> already exists!";
                $this->json_response(FALSE, $message);
            }
        }
    }

    private function json_response($successful, $message)
    {
        echo json_encode(array(
            'isSuccessful' => $successful,
            'message' => $message
        )); 
    }
}
/*End of file signup.php*/
