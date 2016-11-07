<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Patient_model');
		if(!$this->is_operator() && !$this->uri->segment(3) == 'list_ajax') 
			redirect('/','refresh');
	}
	// List all your items
	public function index( $offset = 0 ) {

		$data = array(
			'patient_entries' => $this->Patient_model->list_all()	
		);

		$this->template('patient_list',$data);
	}

	public function get( $id = NULL ) {
		if($id == NULL) redirect('/','refresh');

		$data = $this->Patient_model->get($id);

		$this->template('patient_edit',$data);
	}

	// Add a new item
	public function add() {
		if(!$this->is_operator()) redirect('/','refresh');

		$data = array(
			'id'=>'',
			'name'=>'',
			'dob'=>'',
			'email'=>'',
			'password'=>'',
			'sexes' => array(
				array('sex'=>'M', 'label'=>'Male','selected'=>""),
				array('sex'=>'F', 'label'=>'Female','selected'=>"")
			),
			'bloods' => array(
				array('id'=> 1, 'blood'=>'O-'	, 'selected'=>""),
				array('id'=> 2, 'blood'=>'AB-'	, 'selected'=>""),
				array('id'=> 3, 'blood'=>'A-'	, 'selected'=>""),
				array('id'=> 4, 'blood'=>'B-'	, 'selected'=>""),
				array('id'=> 5, 'blood'=>'O+'	, 'selected'=>""),
				array('id'=> 6, 'blood'=>'AB+'	, 'selected'=>""),
				array('id'=> 7, 'blood'=>'A+'	, 'selected'=>""),
				array('id'=> 8, 'blood'=>'B+'	, 'selected'=>""),
			)
		);

		$this->template('patient_edit',$data);
	}

	public function edit( $id = NULL ) {
		if(!$this->is_operator()) redirect('/','refresh');

		$data = $this->Patient_model->get($id);

		$this->template('patient_edit',$data);
	}

	public function list_ajax(){
		$term = $this->input->get('term');
		
		header('Content-Type: application/json');
		echo json_encode($this->Patient_model->list_names($term));
	}

	public function get_ajax($id) {

		header('Content-Type: application/json');
		echo json_encode($this->Patient_model->simple_get($id));
	}

	public function save( $id = NULL ) {
		if(!$this->is_operator()) redirect('/','refresh');

		if(is_numeric($this->input->post('id')))
			$this->Patient_model->update($this->input->post());
		else
			$this->Patient_model->insert($this->input->post());

		redirect('/patients','refresh');
	}

	// Delete one patient
	public function delete( $id = NULL ) {
		if(!$this->is_operator()) redirect('/','refresh');
		$this->Patient_model->delete($id);
	}
}

/* End of file Patient.php */
/* Location: ./application/controllers/Patient.php */
