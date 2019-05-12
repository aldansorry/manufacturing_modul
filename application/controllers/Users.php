<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}

	public function index()
	{
		$view = [
			'c_name' => "Users",
			'pages' => 'users/show',
		];
		$this->load->view('layouts/default',$view);
	}

	public function get()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		$data['data'] = $query->result();
		echo json_encode($data);
	}

	public function insert()
	{
		$view = [
			'c_name' => "Users",
			'pages' => 'users/insert',
		];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[users.username]');
		$this->form_validation->set_rules('password','Password','required|trim|matches[cpassword]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim');
		$this->form_validation->set_error_delimiters();

		if($this->form_validation->run() == false){
			$this->load->view('layouts/default',$view);
		}else{
			var_dump($_POST);
			$set = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'role' => $this->input->post('role'),
				'created_by' => $this->session->userdata('id_users')
			];
			$insert = $this->db->insert('users',$set);
			if ($insert) {
				$this->session->set_flashdata('alert_type','success');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> success');
			}else{
				$this->session->set_flashdata('alert_type','warning');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> failed');
			}

			$condition = $this->input->post('submit') == "Submit";
			if($condition){
				redirect('Users');
			}else{
				redirect('Users/insert');
			}
		}
	}

	public function delete($id)
	{
		$this->db->select('name');
		$this->db->where('id_users',$id);
		$this->db->from('users');
		$query = $this->db->get();
		$name = $query->row(0)->name;

		$db_debug = $this->db->db_debug;
    	$this->db->db_debug = FALSE;
		$this->db->where('id_users',$id);
		$delete = $this->db->delete('users');
		$error = $this->db->error();
		$this->db->db_debug = $db_debug;
		if ($error['code'] == 0) {
			$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_message','Delete <b>'.$name.'</b> success');
		}else if($error['code'] == 1451){
			$this->session->set_flashdata('alert_type','warning');
			$this->session->set_flashdata('alert_message','Foreign key error');
		}else{
			$this->session->set_flashdata('alert_type','warning');
			$this->session->set_flashdata('alert_message','Delete <b>'.$name.'</b> failed');
		}
		redirect('Users');
	}
}
