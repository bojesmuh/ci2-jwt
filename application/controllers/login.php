<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '../vendor/autoload.php';
use \Firebase\JWT\JWT;

class Login extends MY_Controller {

	private $secretkey = '123456789'; //ubah dengan kode rahasia apapun

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_login','login');
	}

	public function action_login()
	{
		$date      = new DateTime();

        $username  = $this->input->post('username', true); 
        $pass      = $this->input->post('password', true);

        $data_users = $this->login->get_users($username)->row();

        if ($data_users) {

        	if (password_verify($pass, $data_users->password)) {
        		$payload['id']       = $data_users->id;
        		$payload['username'] = $data_users->username;
                $payload['iat']      = $date->getTimestamp(); //waktu di buat
                $payload['exp']      = $date->getTimestamp() + 3600; //satu jam
                $token     = JWT::encode($payload, $this->secretkey);

                $result = array(
                	'code' => '000',
                	'token' => $token
                );
                echo json_encode($result);

            } else {
            	$this->token_fail($username);
            }
        } else {
        	$this->token_fail($username);
        }
        
    }

    // method untuk jika generate token diatas salah
    public function token_fail($username)
    {
        $result = array(
            'code'   => '001',
            'username' => $username,
            'message'  => 'Invalid Username Or Password',
        );

        echo json_encode($result);
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */