<?php  
	class Patient_model extends CI_Model {

        private $first_name;
        private $middle_name;
        private $last_name;
        private $email;
        private $disease;
        private $registeration_number;
        private $mobile_number;
        private $father_name;
        private $joined_date;
        private $updated_date;

        public function __construct()
        {
            parent::__construct();        		
        }

        public function insert_patient()
        {
            $this->first_name = strtolower(trim($this->db->escape($this->input->post('first_name')), "''"));

            $this->middle_name = strtolower(trim($this->db->escape($this->input->post('middle_name')), "''"));

            $this->last_name = strtolower(trim($this->db->escape($this->input->post('last_name')), "''"));

            $this->mobile_number = trim($this->db->escape($this->input->post('mobile_number')), "''");
            
            $this->email = strtolower(trim($this->db->escape($this->input->post('email')), "''"));

            $this->disease = strtolower(trim($this->db->escape($this->input->post('submitted_diseases')), "''"));
            
            $this->father_name = strtolower(trim($this->db->escape($this->input->post('father_name')), "''"));

            $this->birthday = trim($this->db->escape($this->input->post('birthday')), "''");

            $this->cnic = trim($this->db->escape($this->input->post('cnic')), "''");

            $this->gender = strtolower(trim($this->db->escape($this->input->post('gender')), "''"));

            $time = time();

            $pre_char = substr($time, 0, 4);
            
            $post_char = substr($time, 4);

            $this->registeration_number =  $pre_char . chr(rand(97,122)) . $post_char . chr(rand(97,122));
        
            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->joined_date = $date;

            $this->updated_date = $date;

            $id = $this->db->insert_id();

            $sql = "SELECT * FROM patient WHERE (cnic = ?) AND id != ?";
        
            $q = $this->db->query($sql, array($this->cnic , $id));

            if($q->num_rows() > 0)
            {
                $this->session->set_flashdata('failure_message', 'Please provide a unique CNIC number this CNIC ' . $this->input->post('cnic') . ' is not Unique!');
                return FALSE;
            }
            else
            {            
                $data = array(

                    'first_name' => $this->first_name,

                    'middle_name' => $this->middle_name,

                    'last_name' => $this->last_name,

                    'mr_number' => $this->registeration_number,

                    'mobile_number' => $this->mobile_number,

                    'email' => $this->email,

                    'father_name' => $this->father_name,

                    'gender' => $this->gender,

                    'cnic' => $this->cnic,
                    
                    'birthday' => $this->birthday,
                    
                    'joined_date' => $this->joined_date,

                    'updated_date' => $this->updated_date

                );

                if($this->db->insert('patient', $data))
                {
                    return TRUE;       
                } 
                    return FALSE;            
            }
        }

        public function update_patient($id)
        {

            $this->first_name = strtolower(trim($this->db->escape($this->input->post('first_name')), "''"));

            $this->middle_name = strtolower(trim($this->db->escape($this->input->post('middle_name')), "''"));

            $this->last_name = strtolower(trim($this->db->escape($this->input->post('last_name')), "''"));

            $this->mobile_number = trim($this->db->escape($this->input->post('mobile_number')), "''");
            
            $this->email = strtolower(trim($this->db->escape($this->input->post('email')), "''"));
            
            $this->father_name = strtolower(trim($this->db->escape($this->input->post('father_name')), "''"));
            
            $this->birthday = trim($this->db->escape($this->input->post('birthday')), "''");

            $this->gender = strtolower(trim($this->db->escape($this->input->post('gender')), "''"));
            
            $this->cnic = trim($this->db->escape($this->input->post('cnic')), "''");

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->updated_date = $date;

            $sql = "SELECT * FROM patient WHERE (cnic = ?) AND id != ?";
        
            $q = $this->db->query($sql, array($this->cnic , $id));

            if($q->num_rows() > 0)
            {
                $this->session->set_flashdata('failure_message', 'Please provide a unique CNIC number this CNIC ' . $this->input->post('cnic') . ' is not Unique!');                
                return FALSE;
            }
            
            else
            {
                $data = array(

                'first_name' => $this->first_name,

                'middle_name' => $this->middle_name,

                'last_name' => $this->last_name,

                'email' => $this->email,

                'mobile_number' => $this->mobile_number,
                
                'father_name'   => $this->father_name,

                'gender' => $this->gender,

                'cnic' => $this->cnic,
                
                'birthday' => $this->birthday,
                
                'updated_date' => $this->updated_date
  		    
                );

                $this->db->where('id', $id);
                
                if($this->db->update('patient', $data))
                {
                    return TRUE;
                }
                    return FALSE;
            }
        }

        public function delete_patient($id)
        {
            if ($this->db->delete('patient', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       

        public function get_patient_disease($patient_id)
        {
            $this->db->select('disease.id, disease.name');
            $this->db->from('disease');
            $this->db->where('patient_details.patient_id', $patient_id);
            $this->db->join('patient_details', 'disease.id = patient_details.disease_id', 'left');
            $q = $this->db->get();
            return $q->result_array();
        }       

        public function get_patient_by_id($patient_id, $attach_disease = FALSE, $mr_number = FALSE, $print_prescription = FALSE)
        {   
            if($mr_number)
            {
                if($print_prescription)
                {
                    $this->db->select('patient.id, patient.mr_number, CONCAT(patient.first_name, " ", patient.middle_name, " ", patient.last_name) AS full_name, patient.email, patient.mobile_number, patient.email, patient.father_name, patient.gender, patient.birthday');
                }
                else
                {
                    $this->db->select('patient.id, patient.mr_number');
                }
                $this->db->from('patient');
                $this->db->where('appointment.patient_id', $patient_id);
                $this->db->join('appointment', 'patient.id = appointment.patient_id', 'left');
                $q = $this->db->get();
                $mr_number = $q->result_array()[0];
                return $mr_number;
            }

            $q = $this->db->get_where('patient', array('id' => $patient_id)); 
            $result = $q->result_array();
            if($attach_disease)
            {
                //$result['disease'] = $this->get_patient_disease($id);
                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['disease'] = $this->get_patient_disease($result[$i]['id']);
                    }
                }
            }

            return $result;
        }

        public function get_patient_by_keys()
        {   
            $mr_number = $this->input->post('mr_number');
            $father_name = $this->input->post('father_name');
            $mobile_number = $this->input->post('mobile_number');
            $cnic = $this->input->post('cnic');

            $this->db->select('patient.id, patient.mr_number, patient.cnic, patient.first_name, patient.middle_name, patient.last_name, patient.email, patient.mobile_number, patient.father_name');
            
            $this->db->from('patient');
            
            if(!empty($father_name) && !empty($mr_number) && !empty($mobile_number) && !empty($cnic))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where(array('patient.mr_number' => $mr_number, 'patient.mobile_number' => $mobile_number, 'patient.cnic' => $cnic));
            }              
            elseif(!empty($father_name) && !empty($mr_number) && !empty($mobile_number))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where(array('patient.mr_number' => $mr_number, 'patient.mobile_number' => $mobile_number));
            }
            elseif(!empty($father_name) && !empty($mr_number) && !empty($cnic))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where(array('patient.mr_number' => $mr_number, 'patient.cnic' => $cnic));
            }
            elseif(!empty($mobile_number) && !empty($mr_number) && !empty($cnic))
            {
                $this->db->where(array('patient.mobile_number' => $mobile_number,'patient.mr_number' => $mr_number, 'patient.cnic' => $cnic));
            }       
            elseif(!empty($father_name) && !empty($mr_number))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where('patient.mr_number', $mr_number);
            }            
            elseif(!empty($father_name) && !empty($mobile_number))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where('patient.mobile_number', $mobile_number);
            }            
            elseif(!empty($father_name) && !empty($cnic))
            {
                $this->db->like('patient.father_name', $father_name);
                $this->db->where('patient.cnic', $cnic);
            }            
            elseif(!empty($mobile_number) && !empty($mr_number))
            {
                $this->db->where(array('patient.mobile_number' => $mobile_number, 'patient.mr_number' => $mr_number));
            }            
            elseif(!empty($mobile_number) && !empty($cnic))
            {
                $this->db->where(array('patient.mobile_number' => $mobile_number, 'patient.cnic' => $cnic));
            }
            elseif(!empty($mr_number) && !empty($cnic))
            {
                $this->db->where(array('patient.mr_number' => $mr_number, 'patient.cnic' => $cnic));
            }
            elseif(!empty($father_name))
            {
                $this->db->like('patient.father_name', $father_name);
            }            
            elseif(!empty($mobile_number))
            {
                $this->db->where('patient.mobile_number', $mobile_number);
            }
            elseif(!empty($cnic))
            {
                $this->db->where('patient.cnic', $cnic);
            }
            else
            {
                if(!empty($mr_number))
                {
                    $this->db->where('patient.mr_number', $mr_number);
                }
            }
                
            $q = $this->db->get();

            $patient = $q->result_array();

            if($patient)
            {
                return json_encode($patient);
            }
            else
            {
                $patient = array('error_message' => 'No Results Found');
                return json_encode([$patient]);
            }
        }

        public function get_patients()
        {
            $data = $this->db->get('patient');
            $result = $data->result_array();
            
            for ($i=0, $count = count($result); $i < $count; $i++) 
            { 
                if($result[$i])
                {
                    $result[$i]['disease'] = $this->get_patient_disease($result[$i]['id']);
                }
            }
            return $result;
        }

        public function record_count() 
        {
            return $this->db->count_all("patient");
        }

        public function fetch_patients($limit, $start) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get('patient');

            if ($query->num_rows() > 0) 
            {

                $result = $query->result_array();
                
                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['disease'] = $this->get_patient_disease($result[$i]['id']);
                    }
                }
                return $result;
            }
            return false;
        }
    }