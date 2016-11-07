<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator_model extends CI_model {
	public $username;
	public $user_id;

	public function get($id = NULL) {
		$this->db->select('*')->from('operator');
		$this->db->join('user','user.id = user_id');
		$this->db->where("operator.id = {$id}");
		return $this->db->get()->row_array();
	}

	public function get_by_username($username) {
		$result = $this->db->get_where('operator',"username = '{$username}'");
		return $this->get($result->row()->id);
	}
}

/* End of file operator.php */
/* Location: ./application/models/operator.php */