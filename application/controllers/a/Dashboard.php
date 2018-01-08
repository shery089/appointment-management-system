<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/dailyshop/
	 *	- or -
	 *		http://localhost/dailyshop/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/dailyshop/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 */	

	public function __construct()
	{
		parent::__construct();
	
		$this->load->library('layouts');	
		$this->load->model('a/admin_model');	
	}

	public function index()
	{
		$this->layouts->set_title('Dashboard'); 	
		//finally calling the view
		$this->layouts->view('templates/admin/index');
	}

	public function dashboard()
	{		
		$this->layouts->set_title('Dashboard'); 
		
		$this->layouts->view('templates/admin/index');
	}
}

