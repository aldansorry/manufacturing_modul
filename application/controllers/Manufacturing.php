<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manufacturing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$condition = $this->session->userdata('id_users') == null;
		if($condition){
			redirect('Login');
		}
		
		$this->load->helper('form');
	}

	public function index()
	{
		$view = [
			'c_name' => "Manufacturing",
			'pages' => 'manufacturing/show',
		];
		$this->load->view('layouts/default',$view);
	}

	public function get()
	{
		$this->db->select('manufacturing.*,bom.name as bom_name, product.name as product_name');
		$this->db->from('manufacturing');
		$this->db->join('bom','manufacturing.fk_bom=bom.id_bom','left');
		$this->db->join('product','bom.fk_product=product.id_product','left');
		$query = $this->db->get();
		$data['data'] = $query->result();
		echo json_encode($data);
	}

	public function insert()
	{
		$view = [
			'c_name' => "Manufacturing",
			'pages' => 'manufacturing/insert',
			'bom' => $this->db->get('bom')->result(),
		];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('quantity','Quantity','required|trim');
		$this->form_validation->set_error_delimiters();

		if($this->form_validation->run() == false){
			$this->load->view('layouts/default',$view);
		}else{
			var_dump($_POST);
			$set = [
				'quantity' => $this->input->post('quantity'),
				'fk_bom' => $this->input->post('fk_bom'),
				'created_by' => $this->session->userdata('id_users')
			];
			$insert = $this->db->insert('manufacturing',$set);
			if ($insert) {
				$this->session->set_flashdata('alert_type','success');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> success');
			}else{
				$this->session->set_flashdata('alert_type','warning');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> failed');
			}

			$condition = $this->input->post('submit') == "Submit";
			if($condition){
				redirect('Manufacturing');
			}else{
				redirect('Manufacturing/insert');
			}
		}
	}

	public function delete($id)
	{

		$db_debug = $this->db->db_debug;
    	$this->db->db_debug = FALSE;
		$this->db->where('id_manufacturing',$id);
		$delete = $this->db->delete('manufacturing');
		$error = $this->db->error();
		$this->db->db_debug = $db_debug;
		if ($error['code'] == 0) {
			$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_message','Delete success');
		}else if($error['code'] == 1451){
			$this->session->set_flashdata('alert_type','warning');
			$this->session->set_flashdata('alert_message','Foreign key error');
		}else{
			$this->session->set_flashdata('alert_type','warning');
			$this->session->set_flashdata('alert_message','Delete failed');
		}
		redirect('Manufacturing');
	}
}
