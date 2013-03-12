<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        
        if (!$this->is_logged_in()) {
            redirect('login');
        }
    }
    
    public function index()
    {
        $contacts = $this->contact_model->get_all($this->session->userdata('uid'));
        
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
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|callback_alpha_dash_space');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Adding</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $is_added = $this->contact_model->add($this->input->post('name'), $this->input->post('email'), 
                $this->input->post('phone'), $this->session->userdata('uid'));
            
            if ($is_added) {
                $message = "<strong>".$this->input->post('name')."</strong> has been added!";
                $this->json_response(TRUE, $message);
            } else {
                $message = "<strong>".$this->input->post('name')."</strong> already exists!";
                $this->json_response(FALSE, $message);
            }
        }
    }
    
    public function delete()
    {
        $contacts = $this->contact_model->get_names($this->session->userdata('uid'));
        
        $this->load->view('delete', array(
            'contacts' => $contacts, 
        ));
    }
    
    public function delete_contact()
    {
        sleep(2);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|callback_alpha_dash_space');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Deletion</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $name = $this->input->post('name');
            $this->contact_model->delete($name, $this->session->userdata('uid'));
            
            $message = "<strong>".$name."</strong> has been deleted!";
            echo json_encode(array(
                'isSuccessful' => TRUE,
                'message' => $message,
                'name' => $name
            ));
        }
    }
    
    public function edit()
    {
        $contacts = $this->contact_model->get_names($this->session->userdata('uid'));
        
        if (count($contacts) > 0) {
            $firstcontact = $this->contact_model->get_data(
                $this->session->userdata('uid'), $contacts[0]['name']);
        } else {
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
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|callback_alpha_dash_space');
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[40]|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[15]|alpha_numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Editing</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $this->contact_model->update($this->input->post('name'), $this->input->post('email'),
                $this->input->post('phone'), $this->session->userdata('uid'));
            
            $message = "<strong>".$this->input->post('name')."</strong> has been edited!";      
            $this->json_response(TRUE, $message);
        }
    }
    
    public function get_contact_data()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[40]|callback_alpha_dash_space');

        if ($this->form_validation->run() == FALSE) {
            $message = "No <strong>Data</strong> for contact!";
            $this->json_response(FALSE, $message);
        } else {
            $contact = $this->contact_model->get_data(
                $this->session->userdata('uid'), $this->input->post('name'));
            
            if (count($contact) == 0) {
                $message = "No <strong>Data</strong> for contact!";
                $this->json_response(FALSE, $message);
            } else {
                echo json_encode(array(
                    'isSuccessful' => TRUE,
                    'email' => $contact['email'],
                    'phone' => $contact['phone']
                ));
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
        
        if ($this->form_validation->run() == FALSE) {
            $message = "<strong>Changing</strong> failed!";
            $this->json_response(FALSE, $message);
        } else {
            $pwd_valid = $this->user_model->check_password(
                $this->session->userdata('uid'), $this->input->post('curpwd'));
            
            if ($pwd_valid) {
                $this->user_model->update_password(
                    $this->session->userdata('uid'), $this->input->post('newpwd'));

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
        return $this->session->userdata('is_logged_in');
    }

    private function json_response($successful, $message)
    {
        echo json_encode(array(
            'isSuccessful' => $successful,
            'message' => $message
        )); 
    }

    public function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
    }
}
/* End of file site.php */
