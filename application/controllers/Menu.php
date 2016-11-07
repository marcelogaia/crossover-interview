<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	public function index()
	{
		if(!$this->is_logged()) $this->patientLogin();
		else{
			$this->template('menu');
		}
	}

	public function patientLogin() {
		parent::login();
	}

	public function operatorLogin() {
		parent::login(true);
	}

}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */