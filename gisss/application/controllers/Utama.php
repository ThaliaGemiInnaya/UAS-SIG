<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {
	function __construct()
	{
		parent::__construct();
                $this->load->model('m_model');
           
	}
	
	public function index()
	{


		$data =array(

			'pertanian' => $this->m_model->data_pertanian(),
			
		);
		$this->load->view('utama',$data, FALSE);
	}
}
