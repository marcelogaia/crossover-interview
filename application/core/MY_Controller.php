<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		if(!$this->is_logged() && $this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'admin'){
			redirect('/login','refresh');
		}
		// TODO: Session management + user type
	}

	public function template($content,$data = array()) {
		$data['current_name'] = $this->session->name;
		$data['user_type'] = $this->session->user_type;
		$data['template'] = str_replace('_','-',$content);

		$this->load->library('parser');
		$this->parser->parse('header',$data);
		$this->parser->parse($content,$data);
		$this->parser->parse('footer',$data);
	}

	public function is_operator() {
		if(!$this->is_logged()) return false;

		return $this->session->user_type == 'Operator';
	}

	public function is_logged(){
		return $this->session->is_logged === true;
	}

	public function login($operator = FALSE) {
		// TODO: Login
		$user_type = $this->input->post('user_type');

		if($user_type != null) {
			// TODO: Search the Database for information and save in the session
			$data['user_type'] 	= $user_type;
			$data['user_id'] 	= $this->input->post('user_id');
			$data['username'] 	= $this->input->post('username');
			$data['password'] 	= $this->input->post('password');

			$this->load->model('User_model');
			$this->load->model('Patient_model');
			$this->load->model('Operator_model');

			$is_user = $this->User_model->check_user($data);

			if($is_user) {
				$userData = array();

				if($user_type == 'P')
					$userData = $this->Patient_model->get_by_user_id($data['user_id']);

				if($user_type == 'O') {
					$userData = $this->Operator_model->get_by_username($data['username']);
				}

				if($userData) { // TODO: Found in the database
					$this->session->is_logged = true;
					$this->session->name = $userData['name'];
					$this->session->user_id = $userData['user_id'];
					$this->session->user_type = $user_type == 'P' ? 'Patient' : 'Operator';
				}
			}
		 	
		 	redirect('/','refresh');
		} else {
			if($operator)
				$this->load->view('operator_login');
			else
				$this->load->view('login');			
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/','refresh');
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */