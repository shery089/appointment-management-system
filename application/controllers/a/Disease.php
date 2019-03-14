<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disease extends CI_Controller {

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

	private $disease;

	public function __construct()
	{
		parent::__construct();	

		$ci =& get_instance();
		
		$this->load->library('layouts');

		$this->load->model('a/disease_model');
		
	}

	public function index()
	{
		$this->layouts->set_title('Diseases'); 

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->disease_model->record_count();
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
		//$data['diseases'] = $this->disease_lookup();
        $data["diseases"] = $this->disease_model->fetch_diseases($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$this->layouts->view('templates/admin/diseases', $data);
	}

	public function add_disease_lookup()
	{
		$this->layouts->set_title('Add Disease'); 
			    
	    $this->load->library('form_validation');
	    
	    $this->form_validation->set_rules(
	    		'disease', 'Disease', 
	    		'is_unique[disease.name]|trim|required|min_length[3]|max_length[100]|callback__disease_regex',
	        	array(
                	'required'      => 'Please provide a %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_message('_disease_regex', 'Only characters between [a-z] (case-insentitive) are allowed');

	    $this->form_validation->set_rules(
	    		'detail', 'Detail', 
	    		'trim|min_length[7]|required|callback__details_regex',
	        	array(
                	'required'      => 'Please provide a %s.'
        		)
	    );

	    $this->form_validation->set_message('_details_regex', 'Only characters between [a-z] (case-insentitive) comma and dot are allowed');
	    
	    if ($this->form_validation->run() === FALSE)
	    {
			$this->layouts->view('templates/admin/add_disease');	 	
	    }
	    else
	    {
			$this->disease_model->insert_disease();
			$this->session->set_flashdata('success_message', $this->input->post('disease') . ' has been successfully added!');
		    redirect('/a/disease/');
	    }		
	}	

	public function edit_disease_lookup($id)
	{		
		$this->layouts->set_title('Edit Disease'); 
			    
	    $this->load->library('form_validation');
	    
	    $this->form_validation->set_rules(
	    		'disease', 'Disease', 
	    		'trim|required|min_length[3]|max_length[100]|callback__disease_regex',
	        	array(
                	'required'      => 'Please provide a %s.'
        		)
	    );

	    $this->form_validation->set_rules(
	    		'detail', 'Detail', 
	    		'trim|min_length[7]|required|callback__details_regex',
	        	array(
                	'required'      => 'Please provide a %s.'
        		)
	    );

	    $this->form_validation->set_message('_details_regex', 'Only characters between [a-z] (case-insentitive) comma and dot are allowed');
	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['specialization'] = $this->disease_by_id_lookup($id);
			$this->layouts->view('templates/admin/edit_disease', $data);	 	
	    }
	    else
	    {
			$this->disease_model->update_disease($id);
			$this->session->set_flashdata('success_message', $this->input->post('disease') . ' has been successfully updated!');
		    redirect('/a/disease/');
	    }		
	}

	public function get_modal($id)
	{		

		$data['record'] = 	$this->disease_by_id_lookup($id);	

		$this->load->view('templates/admin/disease_modal', $data);
		
	}

	function _disease_regex($disease) 
	{
		if (preg_match('/^[a-z ]+$/i', $disease)) 
		{
			return TRUE;
		}	 
		else 
		{
			return FALSE;
		}
	}
	function _details_regex($detail) 
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

	public function disease_lookup()
	{
		$diseases = $this->disease_model->get_all_diseases();
		$config = array();
        $config["base_url"] = base_url() . $this->router->fetch_class() . '/' . $this->router->fetch_method();;
	    $config["total_rows"] = $this->disease_model->record_count();
		$config['per_page'] = 5;
        $config["uri_segment"] = 3;
		
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Countries->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		return $diseases;
	}	

	public function disease_by_id_lookup($id)
	{
		$this->disease = $this->disease_model->get_disease_by_id($id);
		return $this->disease;
	}

	public function delete_disease_lookup($id)
	{
		if ($this->disease_model->delete_disease($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/a/disease/');
		}
	}

}