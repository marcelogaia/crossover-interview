<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_model {
	
	public $dob;
	public $sex;
	public $blood;
	public $email;
	public $user_id;

	public function get($id = NULL) {
		$this->db->select('*')->from('patient');
		$this->db->join('user','user.id = user_id');
		$this->db->where("patient.id = {$id}");
		$this->db->where('user.active',true);
		$result = $this->db->get();
		$row = $result->row_array();

		$row['sexes'] = array(
			array('sex'=>'M', 'label'=>'Male','selected'=>""),
			array('sex'=>'F', 'label'=>'Female','selected'=>"")
		);

		if($row['sexes'][0]['sex'] == $row['sex']) 
			$row['sexes'][0]['selected'] = "selected";
		else 
			$row['sexes'][1]['selected'] = "selected";

		$row['bloods'] = array(
			array('blood'=>'O-'	, 'selected'=>""),
			array('blood'=>'AB-', 'selected'=>""),
			array('blood'=>'A-'	, 'selected'=>""),
			array('blood'=>'B-'	, 'selected'=>""),
			array('blood'=>'O+'	, 'selected'=>""),
			array('blood'=>'AB+', 'selected'=>""),
			array('blood'=>'A+'	, 'selected'=>""),
			array('blood'=>'B+'	, 'selected'=>""),
		);

		for($i = 0; $i < sizeof($row['bloods']); $i++) {

		if($row['bloods'][$i]['blood'] == $row['blood']) 
			$row['bloods'][$i]['selected'] = "selected";
		}

		$row['dob'] = date('m/d/Y',strtotime($row['dob']));

		return $row;
	}

	public function simple_get($id) {
		$row = $this->db->get_where('patient',array('id'=>$id))->row();

		$row->sex = $row->sex == 'M' ? "Male" : 'Female';
		$row->dob = date('m/d/Y',strtotime($row->dob));
		return $row;
	}

	public function list_all() {
		$this->db->select('patient.*,user.name as name, test.name as test_name');
		$this->db->from('patient');
		$this->db->join('user','user.id = patient.user_id');
		$this->db->join('report','user.id = report.user_id','LEFT');
		$this->db->join('testresult','report.id = testresult.report_id','LEFT');
		$this->db->join('test','test.id = testresult.test_id','LEFT');
		$this->db->where('user.active',true);
		$this->db->group_by('patient.id');
		$this->db->order_by('date_collected');
		$result = $this->db->get();

		$arr = $result->result_array();

		for($i = 0; $i < sizeof($arr);$i++){
			$arr[$i]['dob'] = date('m/d/Y',strtotime($arr[$i]['dob']));
		}
		return $arr;
	}

	public function get_by_user_id($user_id) {
		$result = $this->db->get_where('patient',"user_id = {$user_id}");
		return $this->get($result->row()->id);
	}

	public function get_user_id($id) {
		$result = $this->db->get_where('patient',"id = {$id}");
		return $result->row()->user_id;
	}

	public function list_names($term) {
		$this->db->select('id,name as value');
		$this->db->where('user.usertype','P');
		$this->db->where('user.active',true);
		$this->db->like('name',$term,'after');

		return $this->db->get('user')->result_array();
	}

	public function update() {
		$id = $this->input->post('id');
		$user['name'] = $this->input->post('name');
		$user['password'] = $this->input->post('password');

		$this->db->where('id',$id);
		$this->db->update('user',$user);

		$patient['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		$patient['sex'] = $this->input->post('sex');
		$patient['blood'] = $this->input->post('blood');
		$patient['email'] = $this->input->post('email');

		$this->db->where('user_id',$id);
		$this->db->update('patient',$patient);
	}

	public function insert() {
		$user['name'] = $this->input->post('name');
		$user['password'] = $this->input->post('password');
		$this->db->insert('user',$user);

		$patient['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
		$patient['sex'] = $this->input->post('sex');
		$patient['blood'] = $this->input->post('blood');
		$patient['email'] = $this->input->post('email');
		$patient['user_id'] = $this->db->insert_id();

		$this->db->insert('patient',$patient);
	}

	public function delete($id){
		$patient = $this->db->get_where('patient',array('id'=>$id))->row();
	
		$this->db->where('id',$patient->user_id);
		$this->db->update('user',array('active'=>false));
	}
}

/* End of file patient_model.php */
/* Location: ./application/models/patient_model.php */