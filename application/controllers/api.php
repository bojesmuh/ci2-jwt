<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->check_token();
		$this->load->model('m_login','login');

	}

	public function get_user()
	{

		$enroll_user = $this->login->get_all();
		$data_array = array();
		if ($enroll_user->num_rows() > 0) {
			foreach ($enroll_user->result() as $row) {
				$data_array[] = array(
					'id' => $row->id,
					'username' => $row->username,
					'email' => $row->email,
				);
			}

			$result = array(
				'code' => '000',
				'message' => 'success',
				'result' => $data_array
			);
			echo json_encode($result);	
		} else {
			$result = array(
				'code' => '001',
				'message' => 'failed',
				'result' => $data_array
			);
			echo json_encode($result);	

		}
		
		
	}

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */