<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '../vendor/autoload.php';
use \Firebase\JWT\JWT;

class MY_Controller extends CI_Controller {

	private $secretkey = '123456789'; //ubah dengan kode rahasia apapun

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_login','login');
	}

	public function check_token()
	{
		$jwt = $this->input->get_request_header('Authorization');

		try {
            $decode = JWT::decode($jwt, $this->secretkey, array('HS256'));

            //decode isi token jwt
            if ($this->login->get_users($decode->username)->num_rows() > 0) {
                return true;
            }

        } catch (Exception $e) {
            exit(json_encode(array('status' => '001', 'message' => 'Invalid Token')));
        }
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */