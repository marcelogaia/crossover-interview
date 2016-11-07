<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestResult_model extends CI_Model {
	public $id;
	public $test_id;
	public $result;
	public $report_id;

	public function list_all() {
		$this->db->select("*,'' as selected");
		$this->db->order_by('date_collected','ASC');
		$result = $this->db->get('testresult');
		return $result->result_array();
	}
}

/* End of file TestResult_model.php */
/* Location: ./application/models/TestResult_model.php */