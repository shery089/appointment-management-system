<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

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
		$this->load->model('a/patient_model');
		$this->load->model('a/doctor_model');
		$this->load->model('a/appointment_model');
		$this->load->model('a/schedule_model');
	}

	public function index()
	{
		$this->layouts->set_title('Appointment');
		//$data['appointments'] = $this->appointment_lookup();
		//$this->layouts->view('templates/admin/appointments', $data);

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->appointment_model->record_count();
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

        $data["appointments"] = $this->appointment_model->fetch_appointments($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

		$this->layouts->view('templates/admin/appointments', $data);
		
	}

	public function add_appointment_lookup()
	{
		if(!empty($this->input->post('morning_shift')))
		{
			$time = $this->input->post('morning_shift');
		}
		else if(!empty($this->input->post('evening_shift')))
		{
			$time = $this->input->post('evening_shift');
		}
		else
		{
			$time = '';
		}

		// echo $time . ' time';

		if(!empty($time))
		{
			$data = array(
			    'time' => $time,
			    'patient_id' => (!empty($this->input->post('patient_id'))),
			    'doctor' => (!empty($this->input->post('doctor'))),
			    'visit_purpose' => (!empty($this->input->post('visit_purpose')))
			    // 'morning_shift' => (!empty($this->input->post('morning_shift'))),
			    // 'evening_shift' => (!empty($this->input->post('evening_shift')))
			);

		// print_r($data);
			$this->form_validation->set_data($data);		
		}


		$this->layouts->set_title('Add appointment'); 
			    	    
	    $this->form_validation->set_rules(

	    		'patient_id', 'Patient ID', 
	    		'required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'doctor', 'Doctor', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'visit_purpose', 'Visit Purpose',
	    		'trim|required|max_length[500]',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'time', 'Time',
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a Shift.'
        		)
	    );

	    if ($this->form_validation->run() === FALSE)
	    {
			$data['patients'] = $this->patient_model->get_patients();
			$data['doctors'] = $this->doctor_model->get_doctors(FALSE);
			$this->layouts->view('templates/admin/add_appointment', $data);
	    }
	    else
	    {
	    	$date = $this->input->post('submitted_date');
	    	$doctor_id = $this->input->post('doctor');
	    	if($this->input->post('evening_shift') == '')
	    	{
		    	$time = $this->input->post('morning_shift');
	    	}	    	
	    	else
	    	{
		    	$time = $this->input->post('evening_shift');
	    	}
			$data['times'] = $this->appointment_model->checkReservedAppointments($date, $doctor_id, $time);	
			if (!array_key_exists('msg', $data['times']))
			{	                            
                foreach ($data['times'] as $time)
                {
		            if($time['morning_shift'] != 0)
		            {
		                $time_array[] = $time['morning_shift'];
		            } 
		            else
		            {
		                if($time['evening_shift'] != 0)
		                {
		                    $time_array[] = $time['evening_shift']; 
		                }
		            }
		        }                                
				$this->session->set_flashdata('reserved_time_message', 'These appointment times ' . '<strong class="text-danger">' . implode(', ', $time_array) .'</strong> of <strong class="text-danger"> Dr. ' . ucwords($data["times"][0]["doctor_name"]) . '</strong> on <strong  class="text-danger">' . $data["times"][0]["date"] . '</strong> are already been reserved!<br>Please try again');
				$this->front_end_layouts->set_title('Schedule Appointment');
				$data['patients'] = $this->patient_model->get_patients();
				$_POST['visit_purpose'] = '';
				$_POST['morning_shift'] = '';
				$_POST['evening_shift'] = '';
				$this->layouts->view('templates/admin/add_appointment', $data);
	    	}
	    	else
	    	{
				if($this->appointment_model->insert_appointment())
				{
					echo '<script>localStorage.removeItem("date");</script>';
					$this->session->set_flashdata('success_message', 'Appointment ' . ucfirst($this->input->post('first_name')) . ' with email ' .$this->input->post('email') . ' has been successfully added!');
				    redirect('/a/appointment/');
		    	}
	    	}
	    }		
	}	

	public function edit_appointment_lookup($id)
	{
		$this->layouts->set_title('Edit appointment');

		if(!empty($this->input->post('morning_shift')))
		{
			$time = $this->input->post('morning_shift');
		}
		else if(!empty($this->input->post('evening_shift')))
		{
			$time = $this->input->post('evening_shift');
		}		
		else if(empty($this->input->post('morning_shift')))
		{
			$time = $this->input->post('morning_shift_hidden');
			$time = $this->input->post('evening_shift_hidden');
		}		
		else if(empty($this->input->post('evening_shift')))
		{
			$time = $this->input->post('morning_shift_hidden');
			$time = $this->input->post('evening_shift_hidden');
		}
		else
		{
			$time = '';
		}

		// echo $time . ' time';

		if(!empty($time))
		{
			$data = array(
			    'edit_time' => $time,
			    'patient_id' => (!empty($this->input->post('patient_id'))),
			    'doctor' => (!empty($this->input->post('doctor'))),
			    'visit_purpose' => (!empty($this->input->post('visit_purpose')))
			    // 'morning_shift' => (!empty($this->input->post('morning_shift'))),
			    // 'evening_shift' => (!empty($this->input->post('evening_shift')))
			);

		// print_r($data);
			$this->form_validation->set_data($data);		
		}

	    $this->form_validation->set_rules(

	    		'patient_id', 'Patient ID', 
	    		'trim',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'doctor', 'Doctor', 
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'visit_purpose', 'Visit Purpose',
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );

	    $this->form_validation->set_message('_appointment_regex', 'Only characters between [a-z] (case-insentitive), numbers, comma, dot, paranthesis and colon are allowed');


	    $this->form_validation->set_rules(

	    		'edit_time', 'Time',
	    		'trim|required',
	        	array(
                	'required'      => 'Please select a %s.'
        		)
	    );
			// die();
	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->appointment_by_id_lookup($id);

			$data['patients'] = $this->patient_model->get_patients();

			$data['doctors'] = $this->doctor_model->get_doctors(FALSE);

			$this->layouts->view('templates/admin/edit_appointment', $data);	 	
	    }
	    else
	    {
			$this->appointment_model->update_appointment($id);
			$this->session->set_flashdata('success_message', 'Appointment ' . ucfirst($this->input->post('first_name')) . ' has been successfully updated!');
		    redirect('/a/appointment/');
	    }		
	}

	public function get_modal($id = 0)
	{		
		$prescription = !empty($this->input->post('prescription')) ? $this->input->post('prescription') : '';

		if($id == 0)
		{
			$this->load->view('templates/admin/past_date_error_modal');
		}
		elseif ($prescription) 
		{
			$data['record'] = 	$this->appointment_by_id_lookup($id);
			$this->load->view('templates/admin/prescription_modal', $data);
		}
		else
		{
			$data['record'] = 	$this->appointment_by_id_lookup($id);	

			$this->load->view('templates/admin/appointment_modal', $data);
		}
	}

	public function reschedule_appointment_lookup($id)
	{		
		$date = $this->input->post('submitted_date');
		$morning_shift = $this->input->post('morning_shift');
		$evening_shift = $this->input->post('evening_shift');
		if(empty($date) && (empty($morning_shift) OR empty($evening_shift)))
		{	
			$this->load->view('templates/admin/error_date_time_modal');
			$this->session->set_userdata("reschedule_appt_modal", "error");
		}
		else
		{
			$this->appointment_model->reschedule_appointment($id);
			echo 'success';
		}
	}


	public function get_unapproved_appointments_lookup()
	{
		$appointments = $this->appointment_model->get_unapproved_appointments();
		$data['appointments'] = json_decode($appointments, TRUE);
		$this->load->view('templates/admin/unapproved_appointments_dropdown', $data);
	}	

	public function get_unapproved_appointments_count_lookup()
	{
		$appointments = $this->appointment_model->get_unapproved_appointments_count();
		$count = json_decode($appointments, TRUE);
		print_r($count);
	}	

	function _appointment_regex($appointment) 
	{
		if (preg_match("/^[a-z0-9 :(),.\n\+\-='\/]+$/i", $appointment)) 
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

	public function appointment_lookup()
	{
		$appointments = $this->appointment_model->get_appointments();
		return $appointments;
	}	

	public function appointment_by_id_lookup($id)
	{
		$appointment = $this->appointment_model->get_appointment_by_id($id, FALSE, TRUE, FALSE, TRUE);
		return $appointment;
	}	

	public function specialization_by_id_lookup($id)
	{
		$specialization = $this->appointment_model->get_appointment_specialization($id);
		return $specialization;
	}

	public function get_appointments_by_date_lookup()
	{
		if($this->schedule_model->check_schedule_change())
		{
			$this->session->set_flashdata('success_message', 'Appointment ' . ucfirst($this->input->post('first_name')) . ' has been successfully updated!');
			echo 'No Change';
		}
		else
		{
			$data['appointments'] = $this->appointment_model->get_appointments_by_date();
			$this->schedule_model->update_schedule($this->input->post('schedule_id'),TRUE);
			if(!empty($data['appointments']))
			{
				$this->load->view('templates/admin/reschedule_appointments', $data);
			}
			else
			{
				$this->session->set_flashdata('success_message', 'Appointment ' . ucfirst($this->input->post('first_name')) . ' has been successfully updated!');
				echo 'No Change';
			}
		}
	}

	public function delete_appointment_lookup($id)
	{
		if ($this->appointment_model->delete_appointment($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/a/appointment/');
		}
	}	
}

