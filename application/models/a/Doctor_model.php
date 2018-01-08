<?php  
	class Doctor_model extends CI_Model {

        private $first_name;
        private $middle_name;
        private $last_name;
        private $image;
        private $fee;
        private $specialization;
        private $mobile_number;
        private $joined_date;
        private $updated_date;

        public function __construct()
        {
            parent::__construct();
            $this->load->model('a/appointment_model');       		
        }

        public function insert_doctor($image)
        {
            $this->first_name = strtolower(trim($this->db->escape($this->input->post('first_name')), "''"));

            $this->middle_name = strtolower(trim($this->db->escape($this->input->post('middle_name')), "''"));

            $this->last_name = strtolower(trim($this->db->escape($this->input->post('last_name')), "''"));
            
            $this->description = strtolower(trim($this->db->escape($this->input->post('description')), "''"));

            $this->mobile_number = trim($this->db->escape($this->input->post('mobile_number')), "''");

            $this->specialization = trim($this->db->escape($this->input->post('submitted_specializations')), "''");

            $this->fee = trim($this->db->escape($this->input->post('fee')), "''");
            
            $this->image = trim($this->db->escape($image), "''");
            
            $this->password = trim($this->db->escape($this->input->post('password')), "''");

            $this->salt = openssl_random_pseudo_bytes(32, $cstrong);

            $this->salt = uniqid('', TRUE);
            
            $this->password = hash('sha512', $this->password . $this->salt);
        
            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->joined_date = $date;

            $this->updated_date = $date;
            
            $data = array(

                'first_name' => $this->first_name,

                'middle_name' => $this->middle_name,

                'last_name' => $this->last_name,

                'mobile_number' => $this->mobile_number,

                'fee' => $this->fee,

                'description' => $this->description,

                'image' => $this->image,

                'password' => $this->password,

                'salt' => $this->salt,
                
                'joined_date' => $this->joined_date,

                'updated_date' => $this->updated_date

            );

                $this->db->insert('doctor', $data);
                
                $doctor_id = $this->db->insert_id();

                if(strrchr($this->specialization, ','))
                {
                    $this->specialization = explode(',', $this->specialization);

                    foreach ($this->specialization as $specialization) 
                    {
                        $this->db->query("INSERT INTO doctor_details (doctor_id, specialization_id) 
                                            VALUES($doctor_id, $specialization)");                
                    }
                }
                else
                {
                    $this->db->query("INSERT INTO doctor_details (doctor_id, specialization_id) 
                                        VALUES($doctor_id, $this->specialization)");
                }

            return TRUE;       
        }

        public function update_doctor($doctor_id, $image)
        {

            $this->first_name = html_escape(strtolower(trim($this->db->escape($this->input->post('first_name')), "''")));

            $this->middle_name = html_escape(strtolower(trim($this->db->escape($this->input->post('middle_name')), "''")));
         
            $this->last_name = html_escape(strtolower(trim($this->db->escape($this->input->post('last_name')), "''")));
                              
            $this->specialization = html_escape(trim($this->db->escape($this->input->post('submitted_specializations')), "''"));

            if(!empty($image))
            {
                $this->image = html_escape(trim($this->db->escape($image), "''"));
            }

            $this->mobile_number = html_escape(trim($this->db->escape($this->input->post('mobile_number')), "''"));
            
            $this->description = strtolower(trim($this->db->escape($this->input->post('description')), "''"));

            $this->fee = html_escape(strtolower(trim($this->db->escape($this->input->post('fee')), "''")));

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->updated_date = $date;
        
            if(!empty($image))
            {
                $data = array(

                    'first_name' => $this->first_name,

                    'middle_name' => $this->middle_name,

                    'last_name' => $this->last_name,

                    'mobile_number' => $this->mobile_number,

                    'description' => $this->description,

                    'image' => $this->image,

                    'fee' => $this->fee,

                    'updated_date' => $this->updated_date
                
                );
            }
            else
            {
                $data = array(

                    'first_name' => $this->first_name,

                    'middle_name' => $this->middle_name,

                    'last_name' => $this->last_name,

                    'mobile_number' => $this->mobile_number,
                 
                    'description' => $this->description,
                    
                    'fee' => $this->fee,

                    'updated_date' => $this->updated_date
                
                ); 
            }

            // BEGIN;

                $this->db->where('id', $doctor_id);
                
                $this->db->update('doctor', $data);   

                $q = $this->db->get_where('doctor_details', array('doctor_id' => $doctor_id));
                    
                $existing_specializations = $q->result_array();

                $existing_specializations = array_column($q->result_array(), 'specialization_id');
   
                if(strrchr($this->specialization, ','))
                {
                
                    $this->specialization = explode(',', $this->specialization);
                    $specialization_string = implode(',', $this->specialization);

                    //$matched_values = array_intersect($this->specialization, $existing_specializations);
                /*            echo '<pre>';
                        print_r($this->specialization);
                        print_r($existing_specializations);
                        print_r($specialization_string);
                    echo '</pre>';*/

                    $record_to_insert = array_diff($this->specialization, $existing_specializations);
                    // $to_insert_string = implode(',', $to_insert);

                    $q = $this->db->query("SELECT * FROM doctor_details WHERE doctor_id = $doctor_id AND specialization_id NOT IN ($specialization_string)");

                    $to_delete = array_column($q->result_array(), 'id');
                    $to_delete_string = implode(',', $to_delete);

                    if(!empty($to_delete))
                    {
                        $q = $this->db->query("DELETE FROM doctor_details WHERE id IN ($to_delete_string)");
                    }


                    //$q = $this->db->query("SELECT * FROM doctor_details WHERE doctor_id = $doctor_id AND specialization_id IN ($specialization_string)");
                
                    // $q = $this->db->query("INSERT INTO doctor_details (doctor_id, specialization_id) 
                    //                         VALUES($doctor_id, IN ($to_insert_string))");

                    if(!empty($record_to_insert))
                    {
                        foreach ($record_to_insert as $to_insert) 
                        {
                            $this->db->query("INSERT INTO doctor_details (doctor_id, specialization_id) 
                                                VALUES($doctor_id, $to_insert)");                
                        }
                    }

                    // COMMIT;

                    return TRUE;                          
                }
                else
                {
                    if(count($this->specialization) == 1)
                    {
                        $specialization_string = $this->specialization;
                        $this->specialization = array($this->specialization);
                    }

                    $record_to_insert = array_diff($this->specialization, $existing_specializations);

                    if(!empty($record_to_insert))
                    {
                        $this->db->query("INSERT INTO doctor_details (doctor_id, specialization_id) 
                            VALUES($doctor_id, $record_to_insert[0])");                         
                    }

                    $q = $this->db->query("SELECT * FROM doctor_details WHERE doctor_id = $doctor_id AND specialization_id NOT IN ($specialization_string)");

                    $to_delete = array_column($q->result_array(), 'id');
                    if(count($to_delete) > 1)
                    {
                        $to_delete_string = implode(',', $to_delete);
                        if(!empty($to_delete))
                        {
                            $q = $this->db->query("DELETE FROM doctor_details WHERE id IN ($to_delete_string)");
                        }
                    }
                    else
                    {
                        if(!empty($to_delete))
                        {
                            $q = $this->db->query("DELETE FROM doctor_details WHERE id IN ($to_delete[0])");
                        }
                    }
                }
            }

        public function delete_doctor($id)
        {
            if ($this->db->delete('doctor', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       

        public function get_doctor_specialization($doctor_id)
        {
            $this->db->select('doctor_specialization.id, doctor_specialization.name');
            $this->db->from('doctor_specialization');
            $this->db->where('doctor_details.doctor_id', $doctor_id);
            $this->db->join('doctor_details', 'doctor_specialization.id = doctor_details.specialization_id', 'left');
            $q = $this->db->get();
            return $q->result_array();
        }       

        public function get_doctor_by_id($doctor_id, $attach_specialization = FALSE, $doctor = FALSE, $onlydoc = FALSE, $schedule_doc = FALSE)
        {
            if($doctor)
            {
                if($onlydoc)
                {
                    $this->db->select('doctor.first_name');
                }
                else
                {
                    $this->db->select('doctor.id, doctor.first_name, CONCAT(doctor.first_name, " ", doctor.middle_name, " ", doctor.last_name) AS full_name');
                }

                $this->db->from('doctor');
                
                if($schedule_doc)
                {
                    $this->db->where('schedule.doctor_id', $doctor_id);
               
                    $this->db->join('schedule', 'doctor.id = schedule.doctor_id', 'left');
                }
                else
                {
                    $this->db->where('appointment.doctor_id', $doctor_id);
               
                    $this->db->join('appointment', 'doctor.id = appointment.doctor_id', 'left');
                }

                $q = $this->db->get();
            
                if($schedule_doc)
                {
                    return $q->result_array()[0];
                }
               else  
                {

                    if(!empty($q->result_array()))
                    {
                        if(!$attach_specialization)
                        {
                            return $q->result_array()[0];
                        }
                    }
                }
            }

            $q = $this->db->get_where('doctor', array('id' => $doctor_id)); 
            
            $result = $q->result_array();

            // print_r($result);

            if($attach_specialization)
            {
                //$result['specialization'] = $this->get_doctor_specialization($id);
                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['specialization'] = $this->get_doctor_specialization($result[$i]['id']);
                    }
                }
            }

            return $result;
        }

        
        public function get_doctor_by_name($date, $only_doc)
        {
            $doctor_name = html_escape(strtolower(trim($this->db->escape($this->input->post('appt_doctor')), "''")));
            $this->db->distinct();
            $this->db->select('doctor.id');
            $this->db->from('doctor');
            $this->db->like('doctor.first_name', $doctor_name);
            $this->db->where('appointment.date', $date);            
            // $this->db->where(array('appointment.date' => $date, 'appointment.time' => $time));            
            $this->db->join('appointment', 'doctor.id = appointment.doctor_id', 'left');
            $this->db->order_by('doctor.first_name', 'asc');
            $q = $this->db->get();
            $result = $q->result_array();

            $result = $this->appointment_model->get_attachments($result, $only_doc);

            if(($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('doctor' => array('first_name' => 'No Results Found'));
                echo json_encode([$result]);
            }
        }


        public function get_doctor_name()
        {
            $doctor_name = html_escape(strtolower(trim($this->db->escape($this->input->post('search_doctor_name')), "''")));
            $this->db->distinct();
            $this->db->select('doctor.first_name');
            $this->db->from('doctor');
            $this->db->like('doctor.first_name', $doctor_name);
            $this->db->order_by('doctor.first_name', 'asc');
            $q = $this->db->get();
            $result = $q->result_array();

            if(($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('first_name' => 'No Results Found');
                echo json_encode([$result]);
            }
        }

            public function get_doctor_by_keys()
            {   
                $specialization = html_escape(strtolower(trim($this->db->escape($this->input->post('specialization')), "''")));
                $specialization = trim($specialization);

                $doctor_name = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor_name')), "''")));
                $doctor_name = trim($doctor_name);
                
                $mobile_number = html_escape(strtolower(trim($this->db->escape($this->input->post('mobile_number')), "''")));
                $mobile_number = trim($mobile_number);

                $this->db->query('SET group_concat_max_len = 2048');

                $this->db->select('doctor.id, doctor.first_name, doctor.middle_name, doctor.last_name, doctor.mobile_number, doctor.fee, GROUP_CONCAT(`doctor_specialization`.`name` SEPARATOR ", " ) AS specialization');
                
                $this->db->from('doctor');
                
                if(!empty($specialization) && !empty($doctor_name) && !empty($mobile_number))
                {      
                    $this->db->like('doctor_specialization.name', $specialization);

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');

                    $this->db->group_by('`doctor`.`first_name`');
                    
                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where(array('doctor.first_name' => $doctor_name, 'doctor.mobile_number' => $mobile_number));
                }       
                elseif(!empty($doctor_name) && !empty($mobile_number))
                {

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');
                
                    $this->db->group_by('`doctor`.`first_name`');

                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where(array('doctor.first_name' => $doctor_name, 'doctor.mobile_number' => $mobile_number));
                }            
                elseif(!empty($specialization) && !empty($mobile_number))
                {

                    $this->db->like('doctor_specialization.name', $specialization);

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');

                    $this->db->group_by('`doctor`.`first_name`');
                    
                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where('doctor.mobile_number', $mobile_number);
                }            
                elseif(!empty($specialization) && !empty($doctor_name))
                {

                    $this->db->like('doctor_specialization.name', $specialization);

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');

                    $this->db->group_by('`doctor`.`first_name`');

                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where('doctor.first_name' , $doctor_name);
                }
                elseif(!empty($doctor_name))
                {

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');
                
                    $this->db->group_by('`doctor`.`first_name`');

                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where('doctor.first_name', $doctor_name);
                }            
                elseif(!empty($mobile_number))
                {

                    $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                    
                    $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');
                
                    $this->db->group_by('`doctor`.`first_name`');

                    $this->db->order_by('`doctor`.`first_name`', 'asc');

                    $this->db->where('doctor.mobile_number', $mobile_number);
                }
                else
                {
                    if(!empty($specialization))
                    {
                        $this->db->like('doctor_specialization.name', $specialization);

                        $this->db->join('doctor_details', 'doctor.id = doctor_details.doctor_id', 'inner');
                        
                        $this->db->join('doctor_specialization', 'doctor_specialization.id = doctor_details.specialization_id', 'inner');
                   
                        $this->db->group_by('`doctor`.`first_name`');

                        $this->db->order_by('`doctor`.`first_name`', 'asc');                        
                    }
                }
                                    
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

        public function get_doctors($attach_specialization = TRUE)
        {
            $data = $this->db->get('doctor');
            if($attach_specialization)
            {
                $result = $data->result_array();
            }
            else
            {
                $result = $data->result();
            }

            if($attach_specialization)
            {
                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['specialization'] = $this->get_doctor_specialization($result[$i]['id']);
                    }
                }
            }
            return $result;
        }

        public function get_doctors_by_schedule($attach_specialization = TRUE)
        {
            date_default_timezone_set("Asia/Karachi");
                        
            $date = date("Y-m-d H:i:s");
            
            $this->db->join('schedule', 'schedule.doctor_id = doctor.id', 'inner');
            
            $this->db->where('schedule.date >= ', $date);
            
            $data = $this->db->get('doctor');
            
            if($attach_specialization)
            {
                $result = $data->result_array();
            }
            else
            {
                $result = $data->result();
            }

            if($attach_specialization)
            {
                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['specialization'] = $this->get_doctor_specialization($result[$i]['id']);
                    }
                }
            }
            return $result;
        }

        public function get_doctors_by_date($date)
        {              
            $this->db->select('doctor.id, CONCAT(doctor.first_name, " ", doctor.middle_name, " ", doctor.last_name) AS full_name');
            
            $this->db->from('doctor');

            $this->db->join('schedule', 'schedule.doctor_id = doctor.id', 'inner');
            
            $this->db->where('schedule.date', $date);
            
            $this->db->order_by('full_name');
            
            $data = $this->db->get();
            
            $result = $data->result_array();
           
            if($result)
            {
                return json_encode($result);
            }
            else
            {
                $result = array('error_message' => 'No Doctors at ' . $date);
                return json_encode($result);
            }

            return $result;
        }

        public function record_count() 
        {
            return $this->db->count_all("doctor");
        }

        public function fetch_doctors($limit, $start, $attach_specialization = TRUE) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get('doctor');

            if ($query->num_rows() > 0) 
            {

                if($attach_specialization)
                {
                    $result = $query->result_array();
                }
                else
                {
                    $result = $query->result();
                }

                if($attach_specialization)
                {
                    for ($i=0, $count = count($result); $i < $count; $i++) 
                    { 
                        if($result[$i])
                        {
                            $result[$i]['specialization'] = $this->get_doctor_specialization($result[$i]['id']);
                        }
                    }
                }
                return $result;
            }
            return false;
        }
    }