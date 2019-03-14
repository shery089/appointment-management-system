<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_specialization extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/doctor_specialization
	 *	- or -
	 *		http://localhost/index.php/doctor_specialization/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/dailyshop/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/home/<method_name>
	 */	

	private $specialization;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('a/doctor_specialization_model');		
	}

	public function index()
	{
		$this->layouts->set_title('Doctor Specialization'); 

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->doctor_specialization_model->record_count();
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
		//$data['doctors'] = $this->doctor_lookup();
        $data["specializations"] = $this->doctor_specialization_model->fetch_doctor_specializations($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$this->layouts->view('templates/admin/specializations', $data);
	}

	public function add_doctor_specialization()
	{
		$this->layouts->set_title('Add Doctor Specialization'); 
			    	    
	    $this->form_validation->set_rules(
	    		'specialization', 'Specialization', 
	    		'is_unique[doctor_specialization.name]|trim|required|min_length[7]|max_length[60]|callback__specialization_regex',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_message('_specialization_regex', 'Only characters between [a-z] (case-insentitive) are allowed');

	    $this->form_validation->set_rules(
	    		'detail', 'Detail', 
	    		'trim|min_length[7]|required|callback__detail_regex'
	    );

	    $this->form_validation->set_message('_detail_regex', 'Only characters between [a-z] (case-insentitive) are allowed');

	    $this->input->post('detail');

	    
	    if ($this->form_validation->run() === FALSE)
	    {
			$this->layouts->view('templates/admin/add_doctor_specialization');	 	
	    }
	    else
	    {
			$this->doctor_specialization_model->insert_specialization();
			$this->session->set_flashdata('success_message', $this->input->post('specialization') . ' has been successfully added!');
		    redirect('/a/doctor_specialization/');
	    }		
	}	

	public function edit_doctor_specialization($id)
	{		
		$this->layouts->set_title('Edit Doctor Specialization'); 
			    
	    $this->load->library('form_validation');
	    
	    $this->form_validation->set_rules(
	    		'specialization', 'Specialization', 
	    		'trim|required|min_length[7]|max_length[60]|callback__specialization_regex',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_rules(
	    		'detail', 'Detail', 
	    		'trim|min_length[7]|required|callback__detail_regex'
	    );

	    $this->form_validation->set_message('_detail_regex', 'Only characters between [a-z] (case-insentitive) comma and dot are allowed');

	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['specialization'] = $this->specialization_by_id_lookup($id);
		
			$this->layouts->view('templates/admin/edit_doctor_specialization', $data);	 	
	    }
	    else
	    {
			$this->doctor_specialization_model->update_specialization($id);
		
			$this->session->set_flashdata('success_message', $this->input->post('specialization') . ' has been successfully updated!');
		
		    redirect('/a/doctor_specialization/');
	    }		
	}

	public function get_modal($id)
	{		
		$data['record'] = 	$this->specialization_by_id_lookup($id);	

		$this->load->view('templates/admin/specialization_modal', $data);
	}

	function _specialization_regex($specialization) 
	{
		if (preg_match('/^[a-z ()]+$/i', $specialization)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}
	function _detail_regex($detail) 
	{
   		$detail = strip_tags($detail);
		if (preg_match('/^[a-z,\. ]+$/i', $detail)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function specialization_lookup()
	{
		$specializations = $this->doctor_specialization_model->get_all_specialization();
		
		return $specializations;
	}	

	public function specialization_by_id_lookup($id)
	{
		$this->specialization = $this->doctor_specialization_model->get_specialization_by_id($id);
		
		return $this->specialization;
	}

	public function delete_doctor_specialization($id)
	{
		if ($this->doctor_specialization_model->delete_specialization($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    
		    redirect('/a/doctor_specialization/');
		}
	}
}