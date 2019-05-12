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
		$view = [
			'pages' => 'Home',
		];
		$this->load->view('layouts/default',$view);
	}
}
