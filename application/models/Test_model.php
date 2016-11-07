<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {
	public $id;
	public $name;
	public $expected_result;

	public function list_all() {
		$this->db->select("*,'' as selected");
		$result = $this->db->get('test');
		return $result->result_array();
	}
}

/* End of file Test_model.php */
/* Location: ./application/models/Test_model.php */