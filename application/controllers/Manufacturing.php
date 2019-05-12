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
		$this->db->select('manufacturing.*,bom.name as bom_name, product.name as product_name,,(select name from users as u where u.id_users=manufacturing.created_by) as created_name');
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
			$set = [
				'quantity' => $this->input->post('quantity'),
				'fk_bom' => $this->input->post('fk_bom'),
				'created_by' => $this->session->userdata('id_users')
			];
			$insert = $this->db->insert('manufacturing',$set);
			$insert_id = $this->db->insert_id();
			if ($insert) {
				$this->session->set_flashdata('alert_type','success');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> success');
			}else{
				$this->session->set_flashdata('alert_type','warning');
				$this->session->set_flashdata('alert_message','Insert <b>'.$set['name'].'</b> failed');
			}

			redirect('Manufacturing/detail/'.$insert_id);	
		}
	}

	public function detail($id)
	{
		$this->db->select('manufacturing.*,(select name from bom where id_bom=manufacturing.fk_bom) as bom_name');
		$this->db->from('manufacturing');
		$this->db->where('id_manufacturing',$id);
		$manufacturing = $this->db->get()->row(0);

		

		$view = [
			'c_name' => "Manufacturing",
			'pages' => 'manufacturing/detail',
			'manufacturing' => $manufacturing
		];

		if ($manufacturing->status == 1) {
			$this->db->select('product.name as product_name,(bom_component.quantity*manufacturing.quantity) quantity_need,product.quantity as quantity_stock');
		$this->db->from('bom_component');
		$this->db->join('product','bom_component.fk_product=product.id_product');
		$this->db->join('bom','bom_component.fk_bom=bom.id_bom');
		$this->db->join('manufacturing','bom.id_bom=manufacturing.fk_bom');
		$this->db->where('bom_component.fk_bom',$manufacturing->fk_bom);
		$component = $this->db->get()->result();
		$view['component'] = $component;
		}
		$this->load->view('layouts/default',$view);
	}

	public function confirm($id)
	{
		$set = [
			'status' => 2,
		];
		$this->db->where('id_manufacturing',$id);
		$this->db->update('manufacturing',$set);

		$this->db->select('bom_component.fk_product,(bom_component.quantity*manufacturing.quantity) quantity_need');
		$this->db->from('bom_component');
		$this->db->join('bom','bom_component.fk_bom=bom.id_bom');
		$this->db->join('manufacturing','bom.id_bom=manufacturing.fk_bom');
		$this->db->where('manufacturing.id_manufacturing',$id);
		$query = $this->db->get();

		foreach ($query->result() as $key => $value) {
			$old = $this->db->where('id_product',$value->fk_product)->get('product')->row(0)->quantity;
			$new = $old - $value->quantity_need;
			$set_product['quantity'] = $new;
			$this->db->where('id_product',$value->fk_product);
			$this->db->update('product',$set_product);
		}

		redirect('Manufacturing/detail/'.$id);	
	}

	public function progress($id)
	{
		$set = [
			'status' => 3,
		];
		$this->db->where('id_manufacturing',$id);
		$this->db->update('manufacturing',$set);
		redirect('Manufacturing/detail/'.$id);	
	}

	public function done($id)
	{
		$set = [
			'status' => 4,
		];
		$this->db->where('id_manufacturing',$id);
		$this->db->update('manufacturing',$set);

		$this->db->select('manufacturing.*, (select fk_product from bom where id_bom = manufacturing.fk_bom) as fk_product');
		$manufacturing = $this->db->where('id_manufacturing',$id)->get('manufacturing')->row(0);

		$old = $this->db->where('id_product',$manufacturing->fk_product)->get('product')->row(0)->quantity;
		$new = $old + $manufacturing->quantity;
		$set_product['quantity'] = $new;
		$this->db->where('id_product',$manufacturing->fk_product)->update('product',$set_product);

		redirect('Manufacturing');	
	}

	public function cancel($id)
	{
		$set = [
			'status' => 0,
		];
		$this->db->where('id_manufacturing',$id);
		$this->db->update('manufacturing',$set);
		redirect('Manufacturing');	
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
