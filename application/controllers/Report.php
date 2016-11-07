<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Report_model');
	}
	// List all your items
	public function index( $offset = 0 ) {

		if($this->is_operator())
			$data = $this->Report_model->list_all();
		else
			$data = $this->Report_model->list_all($this->session->user_id);

		$this->template('report_list',$data);
	}

	public function get( $id = NULL ) {
		if($id == NULL) redirect('/','refresh');

		$data = $this->Report_model->get($id);

		$this->template('report_get',$data);
	}

	// Add a new item
	public function add() {
		if(!$this->is_operator()) redirect('/','refresh');

		$this->load->model('Patient_model');
		$patients = $this->Patient_model->list_all();

		$data = $this->Report_model->get(1);

		$data = array(
			'case_number'	=> '',
			'user_id' 		=> '',
			'doctor' 		=> '',
			'date' 			=> '',
			'gross' 		=> '',
			'user_name' 	=> '',
			'user_dob' 		=> '',
			'user_sex' 		=> '',
  		);
  				
		$data['tests'] = $this->Test_model->list_all();

  		$data['testResults'] = array(
  			array(
  				'tests' 			=> $data['tests'],
				'id' 				=> 'new',
				'test_id' 			=> '',
				'result' 			=> '',
				'report_id' 		=> '',
				'date_collected' 	=> '',
				'name' 				=> '',
				'expected_result' 	=> '',
			)
		);

		$data['patients'] = $patients;

		$this->template('report_edit',$data);
	}

	// Renders the edit form of one report
	public function edit( $id = NULL ) {
		if(!$this->is_operator()) redirect('/','refresh');

		$this->load->model('Patient_model');
		$patients = $this->Patient_model->list_all();

		$data = $this->Report_model->get($id);

		$currPatient = $this->Patient_model->get_by_user_id($data['user_id']);

		for($i = 0; $i < sizeof($patients);$i++){;
			if($patients[$i]['user_id'] == $currPatient['id'])
				$patients[$i]['selected'] = 'selected';
			else
				$patients[$i]['selected'] = '';	
		}

		$data['patients'] = $patients;

		$this->template('report_edit',$data);
	}

	// Update one report
	public function save() {
		if(!$this->is_operator()) redirect('/','refresh');

		if(is_numeric($this->input->post('id')))
			$this->Report_model->update($this->input->post());
		else
			$this->Report_model->insert($this->input->post());

		redirect('/reports','refresh');
	}

	// Delete one report
	public function delete( $id = NULL ) {
		if(!$this->is_operator()) redirect('/','refresh');

		$this->Report_model->delete($id);
	}

	public function export($id){
		if($id == NULL) redirect('/','refresh');

		$data = $this->Report_model->get($id);
		$html = $this->load->view('report_get',$data,true);

		$this->load->library("Pdf");
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		// Add a page
		$pdf->AddPage();
		//$html = "<h1>Test Page</h1>";
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_clean();
		$pdf->Output('test.pdf','I');
    }
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
