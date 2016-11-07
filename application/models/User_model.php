<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public $id;
	public $password;
	public $name;
	public $user_type;

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function check_user($data) {
		if($data['user_type'] == 'O'){
			$user = $data['username'];
			$pass = $data['password'];

			$this->db->select("*")->from('user');
			$this->db->join('operator','user.id = operator.user_id');
			$this->db->where(array('operator.username' => $user,'user.password' => $pass));
		} else {
			$user = $data['user_id'];
			$pass = $data['password'];

			$this->db->select("*")->from('user');
			$this->db->join('patient','user.id = patient.user_id');
			$this->db->where(array('user.id' => $user,'user.password' => $pass));
		}
		
		return $this->db->get()->num_rows() == TRUE;
	}

	public function insert($data){
		// Basic validation
		if(!$this->validate($data,"insert")) return false;
		if($this->session->user_type != 'Operator') return false;

		// TODO: insert user
	}

	public function update($data){
		// Basic validation
		if(!$this->validate($data)) return false;

		if(isset($data->username) && !is_null($data->username))
			$this->db->set('username', $data->username);
		
		if(isset($data->password) && !is_null($data->password))
			$this->db->set('password', $data->password);

		if(isset($data->name) && !is_null($data->name))
			$this->db->set('name', $data->name);

		$this->db->where('id',$data->id);

		$this->db->update('user');
	}

	public function get( $id = NULL ){ // TODO: Implement get. Return an user array
		$this->db->where('id',$id);
		$result = $this->db->get('user');
		$data['user'] = $result->row();

		$user_type = $data['user']->usertype == 'O' ? 'operator' : 'patient';

		$this->db->where('user_id',$id);
		$result = $this->db->get($user_type);
		$data[$user_type] = $result->row();

		return $data;
	}

	public function get_id_by_username( $username = NULL ){ // TODO: Implement get. Return an user array
		$this->db->where('username',$username);
		$result = $this->db->get('operator')->row();

		return $result->user_id;
	}

	private function validate($data, $mode = 'update'){
		// If ID not set and mode is update
		if((!isset($data->id) || is_null($data->id) || $data->id = 0) && $mode == 'update')
			return false;

		// If username already exists
		$whereUserID = array('username'=>$data->username, 'id !='=>$data->id);
		$this->db->where($whereUserID);
		if($this->db->count_all_rows('user') > 0)
			return false;

		return true;
	}
}
/* End of file User_model.php */
/* Location: ./application/models/User_model.php */