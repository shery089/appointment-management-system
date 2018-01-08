<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

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
		$this->load->model('a/schedule_model');	
		$this->load->model('a/doctor_model');
	}

	public function index()
	{
		$this->layouts->set_title('Schedule');
		/*$data['schedules'] = $this->schedule_lookup();
		$this->layouts->view('templates/admin/schedules', $data);
	*/

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->schedule_model->record_count();
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

        $data["schedules"] = $this->schedule_model->fetch_schedules($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

		$this->layouts->view('templates/admin/schedules', $data);
	}

	public function add_schedule_lookup($ajax = FALSE)
	{
		$this->layouts->set_title('Add Schedule');

		if($ajax)
		{
			$data = array(
			        'schedule_date' => $this->input->post('schedule_date'),
			        'doctor' => $this->input->post('doctor'),
			        'first_shift_start' => $this->input->post('first_shift_start'),
			        'first_shift_end' => $this->input->post('first_shift_end'),
			        'second_shift_start' => $this->input->post('second_shift_start'),
			        'second_shift_end' => $this->input->post('second_shift_end')
			);

			$this->form_validation->set_data($data);
		}

	    $this->form_validation->set_rules(

	    		'doctor', 'Doctor', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    
	    $this->form_validation->set_rules(

	    		'schedule_date', 'Schedule Date', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'first_shift_start', 'First Shift Start', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'first_shift_end', 'First Shift End', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'second_shift_start', 'Second Shift Start', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'second_shift_end', 'Second Shift End', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    
	    if ($this->form_validation->run() === FALSE)
	    {	
			$data['doctors'] = $this->doctor_model->get_doctors(FALSE);
			
			if(!$ajax)
			{
				$this->layouts->view('templates/admin/add_schedule', $data);
	    	}
	    
	    }
	    else
	    {
	    	$result = $this->schedule_model->insert_schedule();
			if($result === TRUE)
			{
				// $data['date_errors'] = $result;
				
				$this->load->view('templates/admin/inserted_schedule_modal');
				$this->session->set_userdata("modal", "edit");
				// $this->session->set_flashdata('success_message', 'schedule ' . ucfirst($this->input->post('first_name')) . ' with email ' .$this->input->post('email') . ' has been successfully added!');
			    // redirect('/schedule/');
	    	}
	    	else
	    	{	
	    		//redirect('/schedule/');
	    		// $this->load->model('schedule_model');
		    	// $this->load->model('doctor_model');
				//$data['doctors'] = $this->doctor_model->get_doctors(FALSE);
				// print_r($result);
				// echo json_encode($result);
				$data['date_errors'] = $result;
				
				$this->load->view('templates/admin/edit_schedule_modal', $data);
				$this->session->set_userdata("modal", "insert");				

				// $this->load->view('templates/admin/edit_schedule_modal', $data);
				//$this->layouts->view('templates/admin/add_schedule', $data);
/*	    		echo '<pre>';
	    			print_r($result);
	    		echo '</pre>';
	    		die();*/
	    	}
	    }		
	}	

	public function edit_schedule_lookup($id)
	{		
		$this->layouts->set_title('Edit schedule');

		$ajax = $this->input->post('ajax');

		if($ajax)
		{
			$data = array(

			        'first_shift_start' => $this->input->post('first_shift_start_modal'),
			        'first_shift_end' => $this->input->post('first_shift_end_modal'),
			        'second_shift_start' => $this->input->post('second_shift_start_modal'),
			        'second_shift_end' => $this->input->post('second_shift_end_modal')
			);

			$this->form_validation->set_data($data);
		}

		if(!$ajax)
		{

		    $this->form_validation->set_rules(

		    		'doctor', 'Doctor', 
		    		'trim|required',
		        	array(
	                	'required'      => 'You have not selected any %s.'
	        		)
	    );
	    }

	    $this->form_validation->set_rules(

	    		'first_shift_start', 'First Shift Start', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'first_shift_end', 'First Shift End', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'second_shift_start', 'Second Shift Start', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
	    $this->form_validation->set_rules(

	    		'second_shift_end', 'Second Shift End', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->schedule_by_id_lookup($id, TRUE);

	    	$data['schedules'] = $this->schedule_model->get_schedules();
			
			$data['all_doctors'] = $this->doctor_model->get_doctors(FALSE);

			$this->layouts->view('templates/admin/edit_schedule', $data);	 	
	    }
	    else
	    {
			if($this->schedule_model->update_schedule($id))
			{
			}


			$this->session->set_flashdata('success_message', 'Schedule has been successfully updated!');
			if(!$ajax)
			{
		    	redirect('/a/schedule/');
	    	}
	    }		
	}

	public function get_modal($id)
	{		
		if($id == 'edit_popup')
		{
			$this->add_schedule_lookup(TRUE);
		}		
		else if($id == 'second_popup')
		{
			$id = $this->input->post('id');
			$data['record'] = $this->schedule_by_id_lookup($id, TRUE);	
			$this->load->view('templates/admin/edit_schedule_form_modal', $data);
		}		
		else if($id == 'save_apt_popup')
		{
			$id = $this->input->post('id');
			$data['record'] = $this->schedule_by_id_lookup($id, TRUE);	
			$this->load->view('templates/admin/edit_schedule_form_modal', $data);
		}
		else
		{
			$data['record'] = $this->schedule_by_id_lookup($id, TRUE);	
			$this->load->view('templates/admin/schedule_modal', $data);
		}
	}

	function _schedule_regex($schedule) 
	{
		if (preg_match('/^[a-z ]+$/i', $schedule)) 
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

	public function schedule_lookup()
	{
		$schedules = $this->schedule_model->get_schedules();
		return $schedules;
	}	

	public function schedule_by_id_lookup($id, $attach_specialization = FALSE)
	{
		$schedule = $this->schedule_model->get_schedule_by_id($id, $attach_specialization);
		return $schedule;
	}	
	
	public function get_schedule_by_doc_id_lookup($id)
	{
		$schedule = $this->schedule_model->get_schedule_by_doc_id($id);
		return $schedule;
	}	

	public function delete_schedule_lookup($id)
	{
		if ($this->schedule_model->delete_schedule($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/a/schedule/');
		}
	}	
}

