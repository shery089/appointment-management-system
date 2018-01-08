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
	
		$this->load->model('f/appointment_model');
		$this->load->model('a/doctor_model');
		$this->load->model('f/schedule_model');
		$this->load->model('f/patient_model', 'patient');

	}

	public function index()
	{
		$this->front_end_layouts->set_title('Schedule Appointment');
		$this->front_end_layouts->view('templates/front_end/appointment');		
	}

	public function reschedule_appointment_lookup($id)
	{		
		$date = $this->input->post('submitted_date');
		$morning_shift = $this->input->post('morning_shift');
		$evening_shift = $this->input->post('evening_shift');
		if(empty($date) && empty($morning_shift) OR empty($evening_shift))
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

	public function appointment_lookup()
	{
		$appointments = $this->appointment_model->get_appointments();
		return $appointments;
	}

	public function get_doctors_by_date_lookup($date)
	{
		$data['doctors'] = $this->doctor_model->get_doctors_by_date($date);
		$this->load->view('templates/front_end/doctors-dropdown', $data);
	}	

	public function add_appointment_lookup()
	{
		if(isset($_POST['book1']))
		{
			$date = $this->input->post('submitted_date_1');
            
            $doctor_id = $this->input->post('doctor');
            
            $time = (!empty($this->input->post('morning_shift'))) ? $this->input->post('morning_shift') : $this->input->post('evening_shift');
            			
			$data['times'] = $this->appointment_model->checkReservedAppointments($date, $doctor_id, $time);	

			if (array_key_exists('msg', $data['times']))
			{	
				if($this->patient_model->insert_patient())
				{
					$this->appointment_model->insert_appointment();
					unset($_POST);
					$id = $this->db->insert_id();
					$data['result'] = $this->appointment_model->get_appointment_by_id($id);
					$this->front_end_layouts->view('templates/front_end/thankyou', $data);
				}
				else
				{
					$this->front_end_layouts->view('templates/front_end/appointment');
				}
			}
			else
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
				$data['doctors'] = $this->doctor_model->get_doctors();
				$this->load->view('templates/admin/add_appointment', $data);
			}
		}
		else
		{
			$this->front_end_layouts->set_title('Schedule Appointment');
			$data['doctors'] = $this->doctor_model->get_doctors();
			$this->front_end_layouts->view('templates/front_end/appointment', $data);
		}
	}

	public function add_appointment_old_lookup()
	{
		if(isset($_POST['book2']))
		{
			$patient = $this->patient_model->get_patient_by_keys();
			$patient = json_decode($patient, TRUE);

			$_POST['patient_id'] = $patient[0]['id'];
			$_POST['cnic'] = $this->input->post('old_cnic');
			$_POST['visit_purpose'] = $this->input->post('visit_purpose_2');
			$_POST['submitted_date'] = $this->input->post('submitted_date_2');

			$date = $this->input->post('submitted_date_2');
            
            $doctor_id = $this->input->post('doctor_old');
            
            $time = (!empty($this->input->post('morning_shift_2'))) ? $this->input->post('morning_shift_2') : $this->input->post('evening_shift_2');

			$data['times'] = $this->appointment_model->checkReservedAppointments($date, $doctor_id, $time);	

			if (array_key_exists('msg', $data['times']))
			{	
				if($this->appointment_model->insert_appointment())
				{
					unset($_POST);
					$id = $this->db->insert_id();
					$data['result'] = $this->appointment_model->get_appointment_by_id($id);
					$this->front_end_layouts->view('templates/front_end/thankyou', $data);
				}
				else
				{
					$this->front_end_layouts->set_title('Schedule Appointment');
					$data['doctors'] = $this->doctor_model->get_doctors();
					$this->front_end_layouts->view('templates/front_end/appointment', $data);
				}
			}			
			else
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
				$this->session->set_flashdata('success_message_2', 'These appointment times ' . '<strong class="text-danger">' . implode(', ', $time_array) .'</strong> of <strong class="text-danger"> Dr. ' . ucwords($data["times"][0]["doctor_name"]) . '</strong> on <strong class="text-danger">' . $data["times"][0]["date"] . '</strong> are already been reserved!<br>Please try again');
				$this->front_end_layouts->set_title('Schedule Appointment');
				$data['doctors'] = $this->doctor_model->get_doctors();
				$this->front_end_layouts->view('templates/front_end/appointment', $data);
			}

		}
		else
		{
			$this->front_end_layouts->set_title('Schedule Appointment');
			$data['doctors'] = $this->doctor_model->get_doctors();
			$this->front_end_layouts->view('templates/front_end/appointment', $data);
		}
	}

	public function appointment_by_id_lookup($id)
	{
		$this->front_end_layouts->set_title('Schedule Appointment');
		$data['selected_id'] = $id;
		$data['doctors'] = $this->doctor_model->get_doctors();
		$this->front_end_layouts->view('templates/front_end/appointment', $data);
	}

	public function specialization_by_id_lookup($id)
	{
		$specialization = $this->appointment_model->get_appointment_specialization($id);
		return $specialization;
	}

	function check_avaiable_schedule()
	{
		$date = $this->input->post('date');
        $doctor_id = $this->input->post('doctor_id');
        $time = $this->input->post('time');

		$data['times'] = $this->appointment_model->checkReservedAppointments($date, $doctor_id, $time);	

		if(!array_key_exists('msg', $data['times']))
		{	
			$this->load->view('templates/front_end/reserved_days_modal', $data);
		}
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
}