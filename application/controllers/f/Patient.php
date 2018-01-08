<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

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
		$this->load->model('f/patient_model');	
		$this->load->model('f/disease_model');	
	}

	public function index()
	{
		$this->layouts->set_title('Patient');
//		$data['patients'] = $this->patient_lookup();
//		$this->layouts->view('templates/admin/patients', $data);

		$config = array();
        $config["base_url"] = base_url('f/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->patient_model->record_count();
		$config['per_page'] = 5;
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

        $data["patients"] = $this->patient_model->fetch_patients($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

		$this->layouts->view('templates/admin/patients', $data);
	}

	public function add_patient_lookup()
	{
		$submitted_specializations = $this->input->post('specializations');

		$this->layouts->set_title('Add Patient'); 
			    	    
	    $this->form_validation->set_rules(

	    		'first_name', 'First Name', 
	    		'trim|required|min_length[4]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_rules(

    		'middle_name', 'Middle Name', 
    		'trim|min_length[1]|max_length[50]|alpha'	    
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'email', 'Email', 
	    		'trim|required|min_length[15]|max_length[70]|valid_email|is_unique[patient.email]',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'father_name', 'Father Name', 
	    		'trim|required|min_length[4]|max_length[70]',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

		$this->form_validation->set_rules(

				'mobile_number', 'Mobile Number',
				'trim|required|is_natural|min_length[11]|max_length[11]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    );  
		
		$this->form_validation->set_rules(

				'birthday', 'Birthday',
				'trim|required',
		    	array(
		        	'required'      => 'You have not provided any %s.'
				)
	    ); 

		$this->form_validation->set_rules(

				'gender', 'Gender',
				'trim|required',
		    	array(
		        	'required'      => 'You have not provided any %s.'
				)
	    );  
		
	    if ($this->form_validation->run() === FALSE)
	    {
	    	// $this->load->model('patient_model');
	    	// $this->load->model('disease_model');
			// $data['diseases'] = $this->disease_model->get_all_diseases();
			$this->layouts->view('templates/admin/add_patient');
	    }
	    else
	    {
			if($this->patient_model->insert_patient())
			{
				$this->session->set_flashdata('success_message', 'Patient ' . ucfirst($this->input->post('first_name')) . ' with email ' .$this->input->post('email') . ' has been successfully added!');
			    redirect('/f/patient/');
	    	}
	    }		
	}	

	public function edit_patient_lookup($id)
	{		
		$this->layouts->set_title('Edit patient');
			    	    
		$this->form_validation->set_rules(

	    		'first_name', 'First Name',
	    		'trim|required|min_length[4]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_rules(

    		'middle_name', 'Middle Name',
    		'trim|min_length[1]|max_length[50]|alpha'
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'email', 'Email', 
	    		'trim|required|min_length[15]|max_length[70]|valid_email',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

		$this->form_validation->set_rules(

				'mobile_number', 'Mobile Number',
				'trim|required|is_natural|min_length[11]|max_length[11]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    );  
	    
	    $this->form_validation->set_rules(

				'birthday', 'Birthday',
				'trim|required',
		    	array(
		        	'required'      => 'You have not provided any %s.'
				)
	    ); 

		$this->form_validation->set_rules(

				'gender', 'Gender',
				'trim|required',
		    	array(
		        	'required'      => 'You have not provided any %s.'
				)
	    );  
	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->patient_by_id_lookup($id, TRUE);

	    	// $data['specializations'] = $this->patient_specialization_model->get_all_specialization(TRUE);

			$this->layouts->view('templates/admin/edit_patient', $data);	 	
	    }
	    else
	    {
			$this->patient_model->update_patient($id);
			$this->session->set_flashdata('success_message', 'Patient ' . ucfirst($this->input->post('first_name')) . ' has been successfully updated!');
		    redirect('/f/patient/');
	    }		
	}

	public function get_modal($id)
	{		

		$data['record'] = $this->patient_by_id_lookup($id, TRUE);	

		$this->load->view('templates/admin/patient_modal', $data);
		
	}

	function _patient_regex($patient) 
	{
		if (preg_match('/^[a-z ]+$/i', $patient)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}

	function _address_regex($address) 
	{
		if (preg_match('/^[a-z \-\/0-9#.,]+$/i', $address)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function patient_lookup()
	{
		$patients = $this->patient_model->get_patients();
		return $patients;
	}	

	public function patient_by_id_lookup($id, $attach_specialization = FALSE)
	{
		$patient = $this->patient_model->get_patient_by_id($id, $attach_specialization);
		return $patient;
	}	

	public function specialization_by_id_lookup($id)
	{
		$specialization = $this->patient_model->get_patient_specialization($id);
		return $specialization;
	}

	public function delete_patient_lookup($id)
	{
		if ($this->patient_model->delete_patient($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/f/patient/');
		}
	}	
}

