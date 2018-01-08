<?php  
	class Autocomplete_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();

            $this->load->model('a/appointment_model');
        }

        public function get_values()
        {
            $mr_number = html_escape(trim($this->db->escape($this->input->post('mr_number')), "'' "));
 
            $this->db->distinct();

            $this->db->select('patient.id, patient.mr_number');
            
            $this->db->from('patient');      
            
            $this->db->like('patient.mr_number', $mr_number);
            
            $this->db->join('appointment', 'patient.id = appointment.patient_id', 'left');

            $this->db->order_by("patient.mr_number", "asc");
        
            $q = $this->db->get();

            $result = $q->result_array();
 
            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('mr_number' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_mr_number_by_cnic()
        {
            $old_cnic = html_escape(trim($this->db->escape($this->input->post('old_cnic')), "'' "));
 
            $this->db->distinct();

            $this->db->select('patient.id, patient.mr_number');
            
            $this->db->from('patient');      
            
            $this->db->where('patient.cnic', $old_cnic);
                    
            $q = $this->db->get();

            $result = $q->result_array();
 
            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('mr_number' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_patient_father()
        {
            $father_name = html_escape(trim($this->db->escape($this->input->post('father_name')), "'' "));   

            $this->db->select('patient.id, patient.father_name');
            
            $this->db->from('patient');      
            
            $this->db->like('patient.father_name', $father_name);

            $this->db->order_by("patient.father_name", "asc");
        
            $this->db->group_by('patient.father_name');  
            
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('father_name' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_patient_cnic()
        {
            $cnic = trim($this->db->escape($this->input->post('search_cnic')), "'' ");   
            $cnic = trim($this->db->escape($this->input->post('old_cnic')), "'' ");   

            $this->db->select('patient.id, patient.cnic');
            
            $this->db->from('patient');      
            
            $this->db->like('patient.cnic', $cnic);

            $this->db->order_by("patient.first_name", "asc");
        
            $this->db->group_by('patient.cnic');  
            
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('cnic' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_patient_mobile_number()
        {
            $mobile_number = html_escape(trim($this->db->escape($this->input->post('search_mobile_number')), "'' "));   

            $this->db->select('patient.id, patient.mobile_number');
            
            $this->db->from('patient');      
            
            $this->db->like('patient.mobile_number', $mobile_number);

            $this->db->order_by("patient.mobile_number", "asc");
        
            $this->db->group_by('patient.mobile_number');  
            
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('mobile_number' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_doctor_mobile_number()
        {
            $mobile_number = html_escape(trim($this->db->escape($this->input->post('search_doc_mobile_number')), "'' "));   

            $this->db->select('doctor.id, doctor.mobile_number');
            
            $this->db->from('doctor');      
            
            $this->db->like('doctor.mobile_number', $mobile_number);

            $this->db->order_by("doctor.mobile_number", "asc");
        
            $this->db->group_by('doctor.mobile_number');  
            
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('mobile_number' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_doctor_specialization()
        {
            $specialization = html_escape(trim($this->db->escape($this->input->post('search_doc_specialization')), "'' "));   

            $this->db->distinct();

            $this->db->select('doctor_specialization.id, doctor_specialization.name');
            
            $this->db->from('doctor_specialization');
            
            $this->db->like('doctor_specialization.name', $specialization);

            $this->db->join('doctor_details', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');
                        
            $q = $this->db->get();
            
            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('name' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

        public function get_appointments()
        {
            $mr_number = html_escape(trim($this->db->escape($this->input->post('mr_number')), "'' "));

            $date = html_escape(trim($this->db->escape($this->input->post('date')), "''"));

            $time = html_escape(trim($this->db->escape($this->input->post('time')), "''"));
            
            if(!empty($time))
            {
                $time = explode(":", $time);
                $time[0] = trim($time[0]);
                $time[1] = trim($time[1]);
                $time = implode(":", $time);
            }

            $this->db->distinct();

            $this->db->select('appointment.*');
            
            $this->db->from('patient');      
                       
            if(!empty($mr_number) && !empty($date) && !empty($time))
            {
                $where = "appointment.date = '$date' AND 'patient.mr_number', $mr_number AND ( appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";
                $this->db->where($where);
                // $this->db->where(array('appointment.date' => $date, 'appointment.time' => $time));
            }            
            elseif(!empty($mr_number) && !empty($date))
            {
                $this->db->where(array('appointment.date' => $date, 'patient.mr_number', $mr_number));
            }
            elseif(!empty($time) && !empty($date))
            {
                $where = "appointment.date = '$date' AND ( appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";
                $this->db->where($where);            }            
            elseif(!empty($time) && !empty($mr_number))
            {
                $where = "patient.mr_number = '$mr_number' AND (appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";
                $this->db->where($where);
            }
            elseif(!empty($date))
            {
                // $this->db->like(array('patient.mr_number' => $mr_number, 'appointment.date' => $date));
                $this->db->where('appointment.date', $date);
            }
            elseif(!empty($time))
            {
                $where = "appointment.morning_shift = '$time' OR appointment.evening_shift = '$time'";
                $this->db->where($where);
                // $this->db->like(array('patient.mr_number' => $mr_number, 'appointment.date' => $date));
            }            
            else
            {   
                $this->db->where('patient.mr_number', $mr_number);
            }
            
            $this->db->join('appointment', 'patient.id = appointment.patient_id', 'inner');

            $this->db->order_by('appointment.date', 'desc');
        
            $q = $this->db->get();

            $result = $q->result_array();

            $result = $this->appointment_model->get_attachments($result);

            if(($result))
            {
                return json_encode($result);
            }
            else
            {
                $result = array('error_message' => 'No Results Found');
                return json_encode([$result]);
            }
        }        

        public function get_appointments_by_doctor()
        {
            $doctor = html_escape(trim($this->db->escape($this->input->post('doctor')), "'' "));
            $date = $this->input->post('date');
            $time = html_escape(trim($this->db->escape($this->input->post('time')), "'' "));
            
            if(!empty($time))
            {
                $time = explode(":", $time);
                $time[0] = trim($time[0]);
                $time[1] = trim($time[1]);
                $time = implode(":", $time);
            }

            $this->db->distinct();

            $this->db->select('appointment.*');
            
            $this->db->from('doctor');      
                       
            if(!empty($doctor) && !empty($time))
            {
                $this->db->like('doctor.first_name', $doctor);
                // $this->db->where(array('doctor.first_name' => $doctor, 'appointment.time' => $time));
                $where = "doctor.first_name = '$doctor' AND ( appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";
                $this->db->where($where);
            }            
            elseif(!empty($doctor))
            {
                // $this->db->like(array('patient.mr_number' => $mr_number, 'appointment.date' => $date));
                $this->db->where('doctor.first_name', $doctor);
            }
            else
            {
                if(!empty($time))
                {
                    // $this->db->where(array('appointment.date' => $date, 'appointment.time' => $time));
                    $where = "appointment.date = '$date' AND ( appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";
                    $this->db->where($where);
                }            
            }
            
            $this->db->join('appointment', 'doctor.id = appointment.doctor_id', 'left');

            // $this->db->order_by('appointment.date', 'desc');
        
            $q = $this->db->get();

            $result = $q->result_array();

            $result = $this->appointment_model->get_attachments($result);

            if(($result))
            {
                return json_encode($result);
            }
            else
            {
                $result = array('error_message' => 'No Results Found');
                return json_encode([$result]);
            }
        }
	}