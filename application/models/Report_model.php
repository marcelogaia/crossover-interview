<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	public $id;
	public $case_number;
	public $user_id;
	public $doctor;
	public $date;

	public function get($id = NULL) {
		$this->db->where('id',$id);
		$result = $this->db->get('report');

		$data = $result->row_array();

		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('patient','user.id = patient.user_id');
		$this->db->where("user.id = {$data['user_id']}");
		$userinfo = $this->db->get()->row();
		
		$data['user_name'] = $userinfo->name;
		$data['user_dob'] = date('m/d/Y',strtotime($userinfo->dob));
		$data['user_sex'] = $userinfo->sex == 'M' ? 'Male' : 'Female';

		$data['date'] = date('m/d/Y',strtotime($data['date']));

		$this->db->select('testresult.*, test.name, test.expected_result');
		$this->db->from('testresult');
		$this->db->join('test','test_id = test.id');
		$this->db->where('report_id',$id);
		$this->db->order_by('date_collected','ASC');
		$result = $this->db->get();

		$testArr = array();
		foreach($result->result_array() as $entry){
			$entry['date_collected'] = date('m/d/Y',strtotime($entry['date_collected']));
			$testArr[] = $entry;
		}

		$this->load->model('Test_model');
		$data['tests'] = $this->Test_model->list_all();
		$data['testResults'] = $testArr;

		for($i = 0; $i < sizeof($data['testResults']); $i++) {
			
			foreach($data['tests'] as $tests) {

				if($tests['id'] == $data['testResults'][$i]['test_id'])
					$tests['selected'] = 'selected';

				$data['testResults'][$i]['tests'][] = $tests;
			}
		}

		return $data;
	}

	public function list_all( $userID = NULL ){
		$data = array();
		$this->db->select('report.*, user.name as patient_name');
		$this->db->from('report');
		$this->db->join('user','user.id = report.user_id');
		if(!is_null($userID)) $this->db->where('user.id',$userID);
		$result = $this->db->get();

		$data['report_entries'] = $result->result_array();

		$newArray = array();

		foreach($data['report_entries'] as $entry) {
			if($this->session->user_type == 'Operator')
				$entry['link'] = 'edit/';
			else
				$entry['link'] = '';

			$entry['date'] = date('m/d/Y',strtotime($entry['date']));

			$newArray['report_entries'][] = $entry;
		}

		return $newArray;
	}

	public function update($data){
		$id = $data['id'];

		$inputData['case_number'] = $data['case_number'];
		$inputData['doctor'] = $data['doctor'];

		$inputData['date'] = date('Y-m-d',strtotime($data['date']));
		$inputData['gross'] = $data['gross'];
		
		$this->db->where('id',$id);
		$this->db->update('report',$inputData);

		foreach($data['testResults'] as $key=>$result) {
			if($key != 'x') {
				if(is_numeric($key)) {
					$resultData = array();
					$resultData['report_id'] = $id;
					$resultData['test_id'] = $result['test_id'];
					$resultData['result'] = $result['result'];
					$resultData['date_collected'] = date('Y-m-d',strtotime($result['date_collected']));

					$this->db->where('id',$key);
					$this->db->update('testresult',$resultData);
				} else {
					$resultData = array();
					$resultData['report_id'] = $id;
					$resultData['test_id'] = $result['test_id'];
					$resultData['result'] = $result['result'];
					$resultData['date_collected'] = date('Y-m-d',strtotime($result['date_collected']));

					$this->db->insert('testresult',$resultData);
				}
			}
		}
	}

	public function insert($data){


		$this->load->model('Patient_model');

		$inputData['case_number'] = $data['case_number'];
		$inputData['doctor'] = $data['doctor'];

		$inputData['user_id'] = $this->Patient_model->get_user_id($data['patient']);;

		$inputData['date'] = date('Y-m-d',strtotime($data['date']));
		$inputData['gross'] = $data['gross'];
		
		$this->db->insert('report',$inputData);

		$id = $this->db->insert_id();

		foreach($data['testResults'] as $key=>$result) {
			if($key != 'x') {
				$resultData = array();
				$resultData['report_id'] = $id;
				$resultData['test_id'] = $result['test_id'];
				$resultData['result'] = $result['result'];
				$resultData['date_collected'] = date('Y-m-d',strtotime($result['date_collected']));

				$this->db->insert('testresult',$resultData);
			}
		}
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('report');
	}
}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */