<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {



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
		$this->load->model('f/doctor_model');	
		$this->load->model('f/doctor_specialization_model');	
	}

	public function index()
	{
		$this->layouts->set_title('Doctor'); 

		$config = array();
        $config["base_url"] = base_url('f/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    	
	    $config["total_rows"] = $this->doctor_model->record_count();
		$config['per_page'] = 6;
        $config["uri_segment"] = 4;
		//$choice = $config["total_rows"] / $config["per_page"];
		// $config["num_links"] = round($choice);
		// $config['use_page_numbers'] = TRUE;
		$config["num_links"] = 1;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // By clicking on performing NEXT pagination.
		//$config['next_link'] = 'Next';

		// By clicking on performing PREVIOUS pagination.
		//$config['prev_link'] = 'Previous';
        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["doctors"] = $this->doctor_model->fetch_doctors($config["per_page"], $page);
        
        $data["specializations"] = $this->doctor_specialization_model->get_all_specialization();

        $data["links"] = $this->pagination->create_links();

		$this->front_end_layouts->view('templates/front_end/doctors-lists', $data);
	}

	public function doctor_lookup()
	{
		$doctors = $this->doctor_model->get_doctors();
		print_r($doctors);
	}	

	public function doctor_details($id, $attach_specialization = TRUE)
	{
		$data['record'] = $this->doctor_model->get_doctor_by_id($id, $attach_specialization);
		$this->front_end_layouts->view('templates/front_end/doctors-single', $data);
	}	

	public function specialization_by_id_lookup($id)
	{
		$specialization = $this->doctor_model->get_doctor_specialization($id);
		return $specialization;
	}

	public function display_doctor_by_keys()
	{	
		$data['doctors'] = $this->doctor_model->get_doctor_by_specialization();
		$this->load->view('templates/front_end/doctors-search', $data);	
	}
}