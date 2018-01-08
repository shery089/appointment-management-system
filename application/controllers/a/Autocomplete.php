<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

	private $date;
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
		
		$this->load->model('a/autocomplete_model');
		$this->load->model('a/patient_model');
		$this->load->model('a/doctor_model');
		$this->load->model('a/prescription_model');
		$this->load->model('a/schedule_model');
		$this->load->library('layouts');	
	}

	public function index()
	{
		if(!empty($this->input->post('mr_number')))
		{
			$this->autocomplete_model->get_values();
		}		
	}
	
	public function father_autocomplete()
	{
		if(!empty($this->input->post('father_name')))
		{
			$this->autocomplete_model->get_patient_father();
		}		
	}	
	
	public function mr_number_autocomplete()
	{
		if(!empty($this->input->post('old_cnic')))
		{
			$this->autocomplete_model->get_mr_number_by_cnic();
		}		
	}	

	public function cnic_autocomplete()
	{
		if(!empty($this->input->post('search_cnic')) || !empty($this->input->post('old_cnic')))
		{
			$this->autocomplete_model->get_patient_cnic();
		}		
	}	
	
	public function doctor_autocomplete()
	{
		if(!empty($this->input->post('search_doctor_name')))
		{
			$this->doctor_model->get_doctor_name();
		}		
	}	

	public function mobile_number_autocomplete()
	{
		if(!empty($this->input->post('search_mobile_number')))
		{
			$this->autocomplete_model->get_patient_mobile_number();
		}		
	}

	public function doctor_mobile_number_autocomplete()
	{
		if(!empty($this->input->post('search_doc_mobile_number')))
		{
			$this->autocomplete_model->get_doctor_mobile_number();
		}		
	}
	
	public function doctor_specialization_autocomplete()
	{
		if(!empty($this->input->post('search_doc_specialization')))
		{
			$this->autocomplete_model->get_doctor_specialization();
		}		
	}
	
	public function display_patients()
	{		
		$data['appointments'] = $this->autocomplete_model->get_appointments();
		$this->load->view('templates/admin/appointment_search', $data);
	}
	
	public function display_schedules()
	{		
		$data['schedules'] = $this->schedule_model->get_schedule_by_keys();
		$this->load->view('templates/admin/schedules_search', $data);
	}

	public function display_patient_by_keys()
	{	
		if(!empty($this->input->post('mr_number')) || !empty($this->input->post('father_name')) || !empty($this->input->post('mobile_number')))
		{
			$data['patients'] = $this->patient_model->get_patient_by_keys();
			$this->load->view('templates/admin/patient_search', $data);
		}
	}	

	public function display_doctor_by_keys()
	{	
		if(!empty($this->input->post('specialization')) || !empty($this->input->post('doctor_name')) || !empty($this->input->post('mobile_number')))
		{
			$data['doctors'] = $this->doctor_model->get_doctor_by_keys();
			$this->load->view('templates/admin/doctor_search', $data);
		}
	}

	public function get_prescription_by_keys()
	{
		if(!empty($this->input->post('date')) || !empty($this->input->post('time')) || !empty($this->input->post('mr_number')) || !empty($this->input->post('doctor_name')))
		{
			$data['prescriptions'] = $this->prescription_model->get_prescription_by_keys();
			$this->load->view('templates/admin/prescription_search', $data);
		}
	}
	
	public function display_appointments()
	{		
		$data['appointments'] = $this->autocomplete_model->get_appointments_by_doctor();
		$this->load->view('templates/admin/appointment_search_modal', $data);
	}

	public function get_modal($date)
	{		
		$data['date'] = $date;
		$this->load->view('templates/admin/dashboard_modal', $data);
	}

	public function get_doctors_lookup($date)
	{
		$this->doctor_model->get_doctor_by_name($date, TRUE);
	}
}

