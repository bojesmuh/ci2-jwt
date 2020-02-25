<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	function get_users($username)
	{

		$this->db->from('users');
		$this->db->where('email',$username);
		$query = $this->db->get();
		return $query;
	}

	function get_all()
	{
		$this->db->from('users');
		$query = $this->db->get();
		return $query;
	}


	
}

/* End of file m_login.php */
/* Location: ./application/models/m_login.php */