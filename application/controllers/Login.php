<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|trim|callback_authentication');
		$this->form_validation->set_rules('password','Password','required|trim');
		if($this->form_validation->run() == false){
			$this->load->view('layouts/login');
		}else{
			redirect('Home');
		}
	}

	public function authentication($username)
	{
		$password = $this->input->post('password');

		$this->db->where([
			'username' => $username,
			'password' => md5($password)
		]);
		$this->db->from('users');
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$data = $query->row(0);
			$set_userdata = [
				'id_users' => $data->id_users,
				'name' => $data->name,
				'username' => $data->username,
				'role' => $data->role,
			];
			$this->session->set_userdata($set_userdata);
			return true;
		}else{
			$this->form_validation->set_message('authentication','Username and password doesnt exist');
			return false;
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
