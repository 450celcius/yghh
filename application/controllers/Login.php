<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('html','email'));
        $this->load->library(array('form_validation','email'));
                    
        $this->form_validation->set_error_delimiters('<div id="form_error">', '</div>');
        $this->load->model(array('user_model'));
    }

	public function index() {
        if ($this->session->userdata('username')){
            redirect('dashboard');
        }
		else {
            $this->load->view('login');
        }
	}
	
	public function cek_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            
            if ($this->user_model->cek_login($username, $password) == TRUE) {
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error_message', 'Maaf,  username atau password salah');
                redirect('login/');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Maaf,  username atau password salah');
            redirect('login/');
        }
    }

   function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('error_message', 'Anda sudah logout');    
        redirect('login/');   
        
    }


}
