<?php  
	class Prescription_model extends CI_Model {

        private $admin_id,
                $doctor_id,
                $patient_id,
                $prescription,
                $food,
                $next_visit_date,
                $visited_date,
                $visited_time;

        public function __construct()
        {
            parent::__construct();
            $this->load->model('a/patient_model');              
            $this->load->model('a/doctor_model');              
        }

        public function insert_prescription($data)
        {
            $this->admin_id = html_escape($this->session->admin_id);

            $this->doctor_id = html_escape(trim($this->db->escape($data['presc_doctor']), "''"));

            $this->patient_id = html_escape(trim($this->db->escape($data['presc_mr_number']), "''"));

            $this->prescription = html_escape(strtolower(trim($this->db->escape($data['prescription']), "''")));

            $this->food = html_escape(strtolower(trim($this->db->escape($data['food']), "''")));;

            $this->next_visit_date = html_escape(trim($this->db->escape($data['next_visit_date']), "''"));

            $this->visited_date = html_escape(trim($this->db->escape($data['presc_date']), "''"));

            $this->visited_time = html_escape(trim($this->db->escape($data['presc_time']), "''"));
            
            $data = array(

                'admin_id' => $this->admin_id,

                'doctor_id' => $this->doctor_id,

                'patient_id' => $this->patient_id,

                'prescription' => $this->prescription,

                'food' => $this->food,

                'next_visit_date' => $this->next_visit_date,

                'visited_date' => $this->visited_date,
                                
                'visited_time' => $this->visited_time

            );

                $this->db->insert('prescription', $data);       
        }

    public function already_exists($record)
    {
        foreach($record as $appointment)
        {
            $patient_id = $appointment['patient_id']['id'];
            $doctor_id = $appointment['doctor_id']['id'];
            $date = $appointment['date'];
            $time = $appointment['time'];
            $this->db->select('prescription.id');
            $this->db->from('prescription');
            $this->db->where(array('patient_id' => $patient_id, 'doctor_id' => $doctor_id, 'visited_date' => $date,'visited_time' => $time));
            $q = $this->db->get();
            if($this->db->affected_rows())
            {
                return $q->result_array();
            }
                return FALSE;
        }
    }

    public function update_prescription($prescription_id)
    {

        $this->prescription = html_escape(strtolower(trim($this->db->escape($this->input->post('edit_prescription')), "''")));
        
        $this->food = html_escape(strtolower(trim($this->db->escape($this->input->post('edit_food')), "''")));
        
        $this->next_visit_date = html_escape(trim($this->db->escape($this->input->post('edit_next_visit_date')), "''"));
        
        $data = array(

            'prescription' => $this->prescription,

            'food' => $this->food,

            'next_visit_date' => $this->next_visit_date

        );

        $this->db->where('id', $prescription_id);
        
        $this->db->update('prescription', $data);         
        
        return TRUE;
    }

    public function delete_prescription($id)
    {
        if ($this->db->delete('prescription', array('id' => $id))) 
        {
            return TRUE;
        }
        return FALSE;
    }   

    public function record_count() 
    {
        return $this->db->count_all("prescription");
    }

    public function fetch_prescriptions($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('prescription');
        if ($query->num_rows() > 0) 
        {
            $result = $query->result_array();

            for ($i=0, $count = count($result); $i < $count; $i++) 
            { 
                if($result[$i])
                {
                    $result[$i]['patient_id'] = $this->patient_model->get_patient_by_id($result[$i]['patient_id'], FALSE, TRUE);

                    $result[$i]['doctor_id'] = $this->doctor_model->get_doctor_by_id($result[$i]['doctor_id'], FALSE, TRUE, FALSE);
                }
            }
            return $result;
        }
        return false;
   }

        public function get_prescription_by_keys()
        {    
            $date = html_escape(strtolower(trim($this->db->escape($this->input->post('date')), "''")));
            $date = trim($date);

            $doctor_name = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor_name')), "''")));
            $doctor_name = trim($doctor_name);
            
            $mr_number = html_escape(strtolower(trim($this->db->escape($this->input->post('mr_number')), "''")));
            $mr_number = trim($mr_number);

            $time = html_escape(strtolower(trim($this->db->escape($this->input->post('time')), "''")));
            $time = trim($time);

            if(!empty($time))
            {
                $time = explode(":", $time);
                $time[0] = trim($time[0]);
                $time[1] = trim($time[1]);
                $time = implode(":", $time);
            }

            $this->db->select('prescription.id, doctor.first_name AS doctor, patient.mr_number, prescription.visited_date, prescription.visited_time,prescription.prescription, prescription.next_visit_date, prescription.food');
            
            $this->db->from('prescription');
            
            if(!empty($date) && !empty($doctor_name) && !empty($mr_number)  && !empty($time))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc, prescription.visited_time asc');

                $this->db->where(array('prescription.visited_date' => $date, 'prescription.visited_time' => $time, 'patient.mr_number' => $mr_number));
            }       
            
            else if(!empty($date) && !empty($doctor_name) && !empty($mr_number))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc');

                $this->db->where(array('prescription.visited_date' => $date, 'patient.mr_number' => $mr_number));
            }       
            
            else if(!empty($date) && !empty($doctor_name) && !empty($time))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc, prescription.visited_time asc');

                $this->db->where(array('prescription.visited_time' => $time, 'prescription.visited_date' => $date));
            }       
                          
            else if(!empty($date) && !empty($mr_number) && !empty($time))
            {      
                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc, prescription.visited_time asc');

                $this->db->where(array('patient.mr_number' => $mr_number, 'prescription.visited_time' => $time, 'prescription.visited_date' => $date));
            }       
              
            else if(!empty($date) && !empty($doctor_name))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc');

                $this->db->where('prescription.visited_date', $date);
            }       
            
            else if(!empty($date) && !empty($time))
            {      
                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc, prescription.visited_time asc');

                $this->db->where(array('prescription.visited_time' => $time, 'prescription.visited_date' => $date));
            }       
            
            else if(!empty($date) && !empty($mr_number))
            {      
                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc');

                $this->db->where(array('patient.mr_number' => $mr_number, 'prescription.visited_date' => $date));
            }     

            else if(!empty($doctor_name) && !empty($time))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_time asc');

                $this->db->where('prescription.visited_time', $time);
            }       
            
            else if(!empty($doctor_name) && !empty($mr_number))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('doctor.first_name asc');

                $this->db->where('patient.mr_number', $mr_number);
            }

            else if(!empty($doctor_name))
            {      
                $this->db->like('doctor.first_name', $doctor_name);

                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('doctor.first_name asc');
            }       
            
            else if(!empty($mr_number))
            {      
                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('patient.mr_number asc');

                $this->db->where('patient.mr_number', $mr_number);
            }    

            else if(!empty($date))
            {      
                $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                
                $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                
                $this->db->order_by('prescription.visited_date asc');

                $this->db->where('prescription.visited_date', $date);
            }       

            else
            {
                if(!empty($time))
                {      
                    $this->db->join('doctor', 'doctor.id = prescription.doctor_id', 'inner');
                    
                    $this->db->join('patient', 'patient.id = prescription.patient_id', 'inner');
                    
                    $this->db->order_by('prescription.visited_date asc');

                    $this->db->where('prescription.visited_time', $time);
                }
            }
                
            // echo $this->db->get_compiled_select();
            
            $q = $this->db->get();
        
            $doctor = $q->result_array();

            if($doctor)
            {
                return json_encode($doctor);
            }
            else
            {
                $doctor = array('error_message' => 'No Results Found');
                return json_encode([$doctor]);
            }
        }

        public function get_prescription_by_id($id, $print_prescription)
        {
            $q = $this->db->get_where('prescription', array('id' => $id)); 
            
            $result = $q->result_array();

            $result = $this->get_attachments($result, FALSE, $print_prescription);
            
            // print_r($result);

            // die();

            return $result;
        }

        public function get_attachments($attachments, $only_doc=FALSE, $print_prescription = FALSE)
        {
            for ($i=0, $count = count($attachments); $i < $count; $i++) 
            { 
                if($attachments[$i])
                {
                    if($only_doc)
                    {
                        $attachments[$i]['doctor'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['id'], FALSE, TRUE, $only_doc);
                    }
                    if($print_prescription)
                    {
                        $attachments[$i]['patient_id'] = $this->patient_model->get_patient_by_id($attachments[$i]['patient_id'], FALSE, TRUE, $print_prescription);

                        $attachments[$i]['doctor_id'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['doctor_id'], $print_prescription, TRUE, FALSE);
                    }
                    else
                    {
                        $attachments[$i]['patient_id'] = $this->patient_model->get_patient_by_id($attachments[$i]['patient_id'], FALSE, TRUE);

                        $attachments[$i]['doctor_id'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['doctor_id'], FALSE, TRUE, FALSE);
                    }
                }
            }   
            return $attachments;
        }
    }