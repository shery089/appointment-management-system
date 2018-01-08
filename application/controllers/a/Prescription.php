<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prescription extends CI_Controller 
{

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
		$this->load->model('a/prescription_model');
		$this->load->model('a/appointment_model');
	}

	public function index()
	{
		$this->layouts->set_title('Prescription');
		// $data['prescriptions'] = $this->prescription_lookup();
		// $this->layouts->view('templates/admin/prescriptions', $data);

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->prescription_model->record_count();
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
		//$data['prescriptions'] = $this->prescription_lookup();
        $data["prescriptions"] = $this->prescription_model->fetch_prescriptions($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$this->layouts->view('templates/admin/prescriptions', $data);
		
	}

	public function add_prescription_lookup()
	{
		$this->layouts->set_title('Add Prescription'); 

		$data = array(
		        'prescription' => $this->input->post('prescription'),
		        'food' => $this->input->post('food'),
		        'next_visit_date' => $this->input->post('next_visit_date')
		);

		$this->form_validation->set_data($data);

	    $this->form_validation->set_rules(

	    		"prescription", 'Prescription', 
	    		'trim|required|min_length[10]|callback__prescription_regex',
	        	array(
                	'required'      => 'You have not selected any %s.'
        		)
	    );

	    $this->form_validation->set_message('_prescription_regex', 'Only characters between [a-z] (case-insentitive), numbers, comma, dot, paranthesis and colon are allowed');	    
	    $this->form_validation->set_message('_prescription_length_regex', 'Minimum 4 are required');	    

	    $this->form_validation->set_rules(

	    		"food", 'Food', 
	    		'trim|required|min_length[10]|callback__prescription_regex',
	        	array(
                	'required'      => 'You have not selected any %s.'
        		)
	    );


	    $this->form_validation->set_message('_prescription_regex', 'Only characters between [a-z] (case-insentitive), numbers, comma, dot, paranthesis and colon are allowed');
	    $this->form_validation->set_rules(

	    		"next_visit_date", 'Next Visit Date',
	    		'trim'
	    );

	    if ($this->form_validation->run() === FALSE)
	    {

	    	//echo validation_errors();
	    	$errors = array();
	    	$errors['food'] = (!empty(form_error('food')) ? form_error('food') : '');
	    	$errors['prescription'] = (!empty(form_error('prescription')) ? form_error('prescription') : '');
	    	$errors['next_visit_date'] = (!empty(form_error('next_visit_date')) ? form_error('next_visit_date') : '');

	    	// print_r($errors);

	    	echo json_encode($errors);
	    }
	    else
	    {
	    	$data = array(
		        'prescription' => $this->input->post('prescription'),
		        'food' => $this->input->post('food'),
		        'next_visit_date' => $this->input->post('next_visit_date'),
		        'presc_mr_number' => $this->input->post('presc_mr_number'),
		        'presc_doctor' => $this->input->post('presc_doctor'),
		        'presc_date' => $this->input->post('presc_date'),
		        'presc_time' => $this->input->post('presc_time'),
		);

		$this->prescription_model->insert_prescription($data);
	  }		
	}	

	public function edit_prescription_lookup($id)
	{
		$this->layouts->set_title('Edit Prescription'); 

	    $this->form_validation->set_rules(

	    		"edit_prescription", 'Prescription', 
	    		'trim|required|min_length[10]|callback__prescription_regex',
	        	array(
                	'required'      => 'You have not selected any %s.'
        		)
	    );

	    $this->form_validation->set_message('_prescription_regex', 'Only characters between [a-z] (case-insentitive), numbers, comma, dot, paranthesis and colon are allowed');	    
	    
	    $this->form_validation->set_message('_prescription_length_regex', 'Minimum 4 are required');	    

	    $this->form_validation->set_rules(

	    		"edit_food", 'Food', 
	    		'trim|required|min_length[10]|callback__prescription_regex',
	        	array(
                	'required'      => 'You have not selected any %s.'
        		)
	    );


	    $this->form_validation->set_message('_prescription_regex', 'Only characters between [a-z] (case-insentitive), numbers, comma, dot, paranthesis and colon are allowed');
	    $this->form_validation->set_rules(

	    		"edit_next_visit_date", 'Next Visit Date',
	    		'trim'
	    );

	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->prescription_model->get_prescription_by_id($id);
	    	$this->layouts->view('templates/admin/edit_prescription', $data);
	    }
	    else
	    {
			$this->prescription_model->update_prescription($id);
			$this->session->set_flashdata('success_message', 'Prescription has been successfully updated!');
		    redirect('/a/prescription/');
	  }		
	}

	function _prescription_regex($prescription) 
	{
		if (preg_match("/^[a-z0-9 :(),.\n\+\-='\/]+$/i", $prescription)) 
		{	    	
			return TRUE;
		}
		else
		{ 
			return FALSE;
		}
	}

	function _prescription_length_regex($prescription) 
	{
		if(preg_match('/^[\w\d]{4,}$/',$prescription))
		{
			return TRUE;
		}
		else
		{ 
			return FALSE;
		}
	}
	
	public function get_modal($id)
	{		
		if(!empty($id))
		{
			$record = $this->appointment_model->get_appointment_by_id($id, FALSE, TRUE);
		}

		if($id = $this->prescription_model->already_exists($record))
		{
			$data['id'] = $id;
			$this->load->view('templates/admin/prescription_already_modal', $data);
		}
		elseif(!empty($this->input->post('del_view')))
		{
			$record = $this->prescription_model->get_prescription_by_id($this->input->post('id'), FALSE, TRUE);
			$data['record'] = $record;
			$this->load->view('templates/admin/main_prescription_modal', $data);
		}
		else
		{
			$data['record'] = $record;
			$this->load->view('templates/admin/prescription_modal', $data);
		}
	}
	public function prescription_by_id_lookup($id)
	{
		$data['print_prescription'] = json_encode($this->prescription_model->get_prescription_by_id($id, TRUE));
		$this->load->view('templates/admin/print_prescription', $data);
	}
}