<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        if (empty($this->session->userdata('username'))){
            redirect('login');
        }

        $this->load->model(array('customer_model'));
    }

    public function index()
    {
    	$title['title'] = "Pelanggan";
    	$data["results"] = $this->customer_model->all_customers();
    	$this->load->view('menu',$title);
    	$this->load->view('top-navigation');
        $this->load->view('customer/customer_view',$data);
        $this->load->view('footer');
    }

    public function add_form(){
        $title['title'] = "Tambah Pelanggan";
        $this->load->view('menu',$title);
        $this->load->view('top-navigation');
        $this->load->view('customer/add_form');
        $this->load->view('footer');
    }

    public function add() {
        $data['customer_name'] = $this->input->post('name');
        $data['address'] = $this->input->post('address');
        $data['company'] = $this->input->post('company');
        $this->customer_model->add($data);
        redirect('customer');
    }

    public function edit_form($customer_id){
        $title['title'] = "Edit Pelanggan";
        $data["results"] = $this->customer_model->customer_by_id($customer_id);
        $this->load->view('menu',$title);
        $this->load->view('top-navigation');
        $this->load->view('customer/edit_form',$data);
        $this->load->view('footer');
    }

    public function edit() {
        $data['customer_id'] = $this->input->post('customer_id');
        $data['customer_name'] = $this->input->post('name');
        $data['address'] = $this->input->post('address');
        $data['company'] = $this->input->post('company');
        $this->customer_model->edit($data);
        redirect('customer');
    }

  
    public function delete($customer_id) {         
        if($this->customer_model->delete($customer_id)==TRUE){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Pelanggan berhasil dihapus.</div>');
            redirect('customer/');
        }     
    }

}
