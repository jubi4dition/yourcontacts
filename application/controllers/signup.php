<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller
{
    public function index()
    {
        $this->load->view('signup');
    }
    
    public function sign_up()
    {           
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('email2', 'Email2', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('pwd', 'Password', 'required|max_length[20]|alpha_numeric');
        $this->form_validation->set_rules('pwd2', 'Password2', 'required|max_length[20]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $json = json_encode(array(
                'isSuccessful' => FALSE,
                'message' => "<strong>Registration</strong> failed! Incorrect input."
            ));
            echo $json;
        } else {   
            $email = $this->input->post('email');
            $pwd = $this->input->post('pwd');
            
            if ($email != $this->input->post('email2')) {
                $message = "<strong>Emails</strong> do not match!";
                $json = json_encode(array(
                    'isSuccessful' => FALSE,
                    'message' => $message
                ));
                echo $json;
            } elseif ($pwd != $this->input->post('pwd2')) {
                $message = "<strong>Passwords</strong> do not match!";
                $json = json_encode(array(
                    'isSuccessful' => FALSE,
                    'message' => $message
                ));
                echo $json;
            } elseif($this->contacts_model->add_user($email,  $pwd)) {
                $message = "<strong>Registration</strong> successful!";
                $json = json_encode(array(
                    'isSuccessful' => TRUE,
                    'message' => $message
                ));
                echo $json;
            } else {
                $message = "<strong>Email</strong> already exists!";
                $json = json_encode(array(
                    'isSuccessful' => FALSE,
                    'message' => $message
                ));
                echo $json;
            }
        }
    }//end sign_up
}
/*End of file signup.php*/
