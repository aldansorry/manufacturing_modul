<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$condition = $this->session->userdata('id_users') == null;
		if($condition){
			redirect('Login');
		}
	}

	public function index()
	{
		$this->db->select('status,count(*) as jumlah');
		$this->db->order_by('status');
		$this->db->group_by('status');
		$query = $this->db->get('manufacturing');
		$data_status = $query->result();

		$this->db->select('month(date_start) as month,count(*) as jumlah');
		$this->db->order_by('month(date_start)');
		$this->db->group_by('month(date_start)');
		$query = $this->db->get('manufacturing');
		$data_manufacturing = $query->result();

		$this->db->select('(select count(*) from product) product,(select count(*) from bom) bom,(select count(*) from manufacturing) manufactur,(select count(*) from users) users');
		$datas = $this->db->get()->row(0);

		$view = [
			'pages' => 'Home',
			'status' => $data_status,
			'manufacturing' => $data_manufacturing,
			'data' => $datas
		];
		$this->load->view('layouts/default',$view);
	}
}
