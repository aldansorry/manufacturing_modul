<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$condition = $this->session->userdata('id_users') == null;
		if($condition){
			redirect('Login');
		}
		
		$this->load->helper('form');
	}

	public function index($thumbnail = null)
	{
		$view = [
			'c_name' => "Product",
			'pages' => 'product/show',
		];
		if($thumbnail != null){
			$view['pages'] = 'product/show_thumbnail';
			$this->db->select('*,(select name from users as u where u.id_users=product.created_by) as created_name');
			$this->db->from('product');
			$query = $this->db->get();
			$view['product'] = $query->result();
		}
		$this->load->view('layouts/default',$view);
	}

	public function get()
	{
		$this->db->select('*,(select name from users as u where u.id_users=product.created_by) as created_name');
		$this->db->from('product');
		$query = $this->db->get();
		$data['data'] = $query->result();
		echo json_encode($data);
	}

	public function insert()
	{

		$view = [
			'c_name' => "Product",
			'pages' => 'product/insert',
			'tax' => $this->db->select('tax')->group_by('tax')->get('product')->result(),
		];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('price','Price','required|trim');
		$this->form_validation->set_rules('quantity','Quantity','required|trim');
		$this->form_validation->set_error_delimiters();

		if($this->form_validation->run() == false){
			$this->load->view('layouts/default',$view);
		}else{
			$config['upload_path'] = './assets/images/product/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '2000';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image')){
				$error = $this->upload->display_errors('','');
				$this->session->set_flashdata('alert_type','warning');
				$this->session->set_flashdata('alert_message','Upload Message : '.$error);
				redirect('Product/insert');
			}
			else{
				$upload_data = $this->upload->data();
				$set = [
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'tax' => $this->input->post('tax'),
					'quantity' => $this->input->post('quantity'),
					'image' => $upload_data['file_name'],
					'type' => $this->input->post('type'),
					'category' => $this->input->post('category'),
					'created_by' => $this->session->userdata('id_users')
				];
				$insert = $this->db->insert('product',$set);
				if ($insert) {
					$this->session->set_flashdata('alert_type','success');
					$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> success');
				}else{
					$this->session->set_flashdata('alert_type','warning');
					$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> failed');
				}

				$condition = $this->input->post('submit') == "Submit";
				if($condition){
					redirect('Product');
				}else{
					redirect('Product/insert');
				}
			}
		}
	}

	public function update($id)
	{
		$view = [
			'c_name' => "Product",
			'pages' => 'product/update',
			'product' => $this->db->where('id_product',$id)->get('product')->row(0),
			'tax' => $this->db->select('tax')->group_by('tax')->get('product')->result(),
		];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|trim');
		$this->form_validation->set_rules('price','Price','required|trim');
		$this->form_validation->set_rules('quantity','Quantity','required|trim');
		$this->form_validation->set_error_delimiters();

		if($this->form_validation->run() == false){
			$this->load->view('layouts/default',$view);
		}else{
			$config['upload_path'] = './assets/images/product/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '2000';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if($_FILES['image']['name'] != ""){
				if ( ! $this->upload->do_upload('image')){
					$error = $this->upload->display_errors('','');
					$this->session->set_flashdata('alert_type','warning');
					$this->session->set_flashdata('alert_message','Upload Message : '.$error);
					redirect('Product/update');
				}
				else{
					$upload_data = $this->upload->data();
					$set = [
						'name' => $this->input->post('name'),
						'price' => $this->input->post('price'),
						'tax' => $this->input->post('tax'),
						'quantity' => $this->input->post('quantity'),
						'image' => $upload_data['file_name'],
						'type' => $this->input->post('type'),
						'category' => $this->input->post('category'),
					];
					$this->db->where('id_product',$id);
					$update = $this->db->update('product',$set);
					if ($update) {
						$this->session->set_flashdata('alert_type','success');
						$this->session->set_flashdata('alert_message','Update <b>'.$set['name'].'</b> success');
					}else{
						$this->session->set_flashdata('alert_type','warning');
						$this->session->set_flashdata('alert_message','Update <b>'.$set['name'].'</b> failed');
					}
					redirect('Product');
				}
			}else{
				$set = [
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'tax' => $this->input->post('tax'),
					'quantity' => $this->input->post('quantity'),
					'type' => $this->input->post('type'),
					'category' => $this->input->post('category'),
				];
				$this->db->where('id_product',$id);
				$update = $this->db->update('product',$set);
				if ($update) {
					$this->session->set_flashdata('alert_type','success');
					$this->session->set_flashdata('alert_message','Update <b>'.$set['name'].'</b> success');
				}else{
					$this->session->set_flashdata('alert_type','warning');
					$this->session->set_flashdata('alert_message','Update <b>'.$set['name'].'</b> failed');
				}
				redirect('Product');
			}
		}
	}


	public function delete($id)
	{
		$this->db->select('name');
		$this->db->where('id_product',$id);
		$this->db->from('product');
		$query = $this->db->get();
		$name = $query->row(0)->name;

		$db_debug = $this->db->db_debug;
		$this->db->db_debug = FALSE;
		$this->db->where('id_product',$id);
		$delete = $this->db->delete('product');
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
		redirect('Product');
	}
}
