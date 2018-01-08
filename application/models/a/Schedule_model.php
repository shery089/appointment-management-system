<?php  
	class Schedule_model extends CI_Model {

        private $day;
        private $date;
        private $doctor;
        private $first_shift_start;
        private $first_shift_end;
        private $second_shift_start;
        private $second_shift_end;
        private $insert_date;
        private $update_date;
        private $date_errors;


            public function __construct()
        {
            parent::__construct();
            $this->load->model('a/doctor_model');              
            $this->load->model('a/appointment_model');              
        }

        public function insert_schedule()
        {

            $this->doctor = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor')), "''")));

            $this->first_shift_start = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('first_shift_start')), "''")));

            $this->first_shift_end = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('first_shift_end')), "''")));

            $this->second_shift_start = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('second_shift_start')), "''")));

            $this->second_shift_end = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('second_shift_end')), "''")));
            
            $this->date = html_escape(trim($this->db->escape($this->input->post('schedule_date')), "''"));

            date_default_timezone_set("Asia/Karachi");
                        
            $date = date("Y-m-d H:i:s");
            
            $this->insert_date = $date;

            $this->update_date = $date;

            // BEGIN;
            
            // $schedule_id = $this->db->insert_id();

            if(strrchr($this->date, ', '))
            {
                $this->date = explode(', ', $this->date);

                foreach ($this->date as $date) 
                {
                    $date = substr($date, 0, 10);

                    if($this->get_schedule_by_doctor($this->doctor, $date))
                    {

                        $data = array(

                            'day' => date('l', strtotime($date)),

                            'date' => $date,

                            'doctor_id' => $this->doctor,

                            'first_shift_start' => $this->first_shift_start,

                            'first_shift_end' => $this->first_shift_end,

                            'first_shift_end' => $this->first_shift_end,
                            
                            'second_shift_start' => $this->second_shift_start,
                            
                            'second_shift_end' => $this->second_shift_end,

                            'insert_date' => $this->insert_date,
                            
                            'update_date' => $this->update_date,          
                        );
                        
                        $this->db->insert('schedule', $data); 
                    }
                }
            }
            else
            {
                $date = substr($this->date, 0, 10);
                
                if($this->get_schedule_by_doctor($this->doctor, $date))
                {

                    $data = array(

                        'day' => date('l', strtotime($date)),

                        'date' => $date,

                        'doctor_id' => $this->doctor,

                        'first_shift_start' => $this->first_shift_start,

                        'first_shift_end' => $this->first_shift_end,

                        'first_shift_end' => $this->first_shift_end,
                        
                        'second_shift_start' => $this->second_shift_start,
                        
                        'second_shift_end' => $this->second_shift_end,

                        'insert_date' => $this->insert_date,
                        
                        'update_date' => $this->update_date,
                    );

                    $this->db->insert('schedule', $data); 
                }
            }

            // COMMIT;
            if(empty($this->date_errors))
            {
                return TRUE;
            }
            return $this->date_errors;   
        }

        public function update_schedule($schedule_id, $reschedule_apt = FALSE)
        {
            $this->doctor = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor')), "''")));

            $this->first_shift_start = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('first_shift_start')), "''")));

            $this->first_shift_end = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('first_shift_end')), "''")));

            $this->second_shift_start = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('second_shift_start')), "''")));

            $this->second_shift_end = $this->trim_time(html_escape(trim($this->db->escape($this->input->post('second_shift_end')), "''")));

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->updated_date = $date;
        
            if($reschedule_apt)
            {
                $this->date = html_escape(trim($this->db->escape($this->input->post('date')), "''"));

                $data = array(

                    'doctor_id' => $this->doctor,

                    'date' => $this->date,

                    'first_shift_start' => $this->first_shift_start,

                    'first_shift_end' => $this->first_shift_end,

                    'second_shift_start' => $this->second_shift_start,
                    
                    'second_shift_end' => $this->second_shift_end,
                    
                    'update_date' => $this->update_date,
                
                );
                
                $this->db->where(array('doctor_id' => $this->doctor, 'date' => $this->date));
            
                $this->db->update('schedule', $data);         
            
                return TRUE;
            }

            $data = array(

                'doctor_id' => $this->doctor,

                'first_shift_start' => $this->first_shift_start,

                'first_shift_end' => $this->first_shift_end,

                'second_shift_start' => $this->second_shift_start,
                
                'second_shift_end' => $this->second_shift_end,
                
                'update_date' => $this->update_date,
            
            );
     

            $this->db->where('id', $schedule_id);
            
            $this->db->update('schedule', $data);         
            
            return TRUE;
        }

        public function delete_schedule($id)
        {
            if ($this->db->delete('schedule', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       
/*
        public function get_schedule_specialization($schedule_id)
        {
            $this->db->select('schedule_specialization.id, schedule_specialization.name');
            $this->db->from('schedule_specialization');
            $this->db->where('schedule_details.schedule_id', $schedule_id);
            $this->db->join('schedule_details', 'schedule_specialization.id = schedule_details.specialization_id', 'left');
            $q = $this->db->get();
            return $q->result_array();
        }   */    

        public function get_schedule_by_id($id, $attach_specialization = FALSE)
        {
            $q = $this->db->get_where('schedule', array('id' => $id)); 
            $result = $q->result_array();
 
            if($attach_specialization)
            {
                $result[0]['doctor'] = $this->doctor_model->get_doctor_by_id($result[0]['doctor_id'], FALSE, TRUE, FALSE, TRUE);
            }

            return $result;
        }        

        public function get_schedule_by_doctor($doctor_id, $date)
        {
            $this->db->select('schedule.id, schedule.date');

            $this->db->from('schedule');

            $this->db->where(array('doctor_id' => $doctor_id, 'date' => $date)); 
            
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                $this->date_errors[] = $result;
                return FALSE;
            }
            return TRUE;
        }

        public function get_schedule_by_doc_id($doctor_id)
        {
            $this->db->select('schedule.first_shift_start, schedule.first_shift_end, schedule.second_shift_start, schedule.second_shift_end');

            $this->db->from('schedule');

            if(!empty($this->input->post('date')))
            {
                $date = $this->input->post('date');
                $this->db->where(array('doctor_id' => $doctor_id, 'date' => $this->input->post('date'))); 
            }
            // else
            // {   
            //     $date = date("Y-m-d");
            //     $this->db->where(array('doctor_id' => $doctor_id, 'date' => $date));
            // }
            $q = $this->db->get();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('error' => 'No Schedule at ' . $date);
                echo json_encode($result);
            }
        }

        public function get_schedules_by_doc_id($doctor_id)
        {

            date_default_timezone_set("Asia/Karachi");
                        
            $date = date("Y-m-d");
            
            $this->db->select('schedule.date');

            $this->db->from('schedule');

            $this->db->where(array('doctor_id' => $doctor_id, 'date >=' => $date)); 
            
            $q = $this->db->get();

            $str = $this->db->last_query();

            $result = $q->result_array();

            if(!empty($result))
            {
                echo json_encode($result);
            }
            else
            {
                $result = array('error' => 'No Schedule at this Date');
                echo json_encode([$result]);
            }
        }

        public function get_schedule_by_keys()
        {
            $day = html_escape(strtolower(trim($this->db->escape($this->input->post('day')), "''")));
            $day = trim($day);

            $doctor_name = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor')), "''")));
            $doctor_name = trim($doctor_name);
            
            $date = html_escape(strtolower(trim($this->db->escape($this->input->post('date')), "''")));
            $date = trim($date);

            // $this->db->query('SET group_concat_max_len = 2048');

            $this->db->select('schedule.id, schedule.day, schedule.date, doctor.first_name, schedule.first_shift_start, schedule.first_shift_end, schedule.second_shift_start, schedule.second_shift_end');
            
            $this->db->from('schedule');
            
            if(!empty($day) && !empty($doctor_name) && !empty($date))
            {      
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where(array('schedule.date' => $date, 'schedule.day' => $day, 'doctor.first_name' => $doctor_name));
            }       
            elseif(!empty($doctor_name) && !empty($day))
            {
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where(array('schedule.day' => $day, 'doctor.first_name' => $doctor_name));
            }            
            elseif(!empty($doctor_name) && !empty($date))
            {
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where(array('schedule.date' => $date, 'doctor.first_name' => $doctor_name));
            }            
            elseif(!empty($day) && !empty($date))
            {
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where(array('schedule.date' => $date, 'schedule.date' => $date));
            }
            elseif(!empty($doctor_name))
            {
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where('doctor.first_name', $doctor_name);
            }            
            elseif(!empty($day))
            {
                $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                
                $this->db->order_by('`schedule`.`date`', 'asc');

                $this->db->where('schedule.day', $day);
            }
            else
            {
                if(!empty($date))
                {
                    $this->db->join('doctor', 'doctor.id = schedule.doctor_id', 'inner');
                                    
                    $this->db->order_by('`schedule`.`date`', 'asc');

                    $this->db->where('schedule.date', $date);
                }
            }
                
            // echo $this->db->get_compiled_select();
            
            $q = $this->db->get();
        
            $schedule = $q->result_array();



            // print_r($doctor);

            if($schedule)
            {
                return json_encode($schedule);
            }
            else
            {
                $schedule = array('error_message' => 'No Results Found');
                return json_encode([$schedule]);
            }
        }

        
        public function get_schedule_by_doctor_name($date, $only_doc)
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

        public function get_schedules()
        {
            $data = $this->db->get('schedule');
            
            $result = $data->result_array();

            for ($i=0, $count = count($result); $i < $count; $i++) 
            { 
                if($result[$i])
                {
                    $result[$i]['doctor'] = $this->doctor_model->get_doctor_by_id($result[$i]['doctor_id'], FALSE, TRUE, FALSE, TRUE);
                }
            }
            return $result;
        }

        public function record_count() 
        {
            return $this->db->count_all("schedule");
        }

        public function fetch_schedules($limit, $start) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get('schedule');
            if ($query->num_rows() > 0) 
            {
                $result = $query->result_array();

                for ($i=0, $count = count($result); $i < $count; $i++) 
                { 
                    if($result[$i])
                    {
                        $result[$i]['doctor'] = $this->doctor_model->get_doctor_by_id($result[$i]['doctor_id'], FALSE, TRUE, TRUE, TRUE);
                    }
                }
                return $result;
            }
            return false;
        }

        public function trim_time($time)
        {
            if(!empty($time))
            {
                $time = explode(":", $time);
                $time[0] = trim($time[0]);
                $time[1] = trim($time[1]);
                $time = implode(":", $time);
                return $time;
            }
            return FALSE;
        }

        public function check_schedule_change()
        {
            $date = $this->input->post('date');
            $doctor_id = $this->input->post('doctor');
            $first_shift_start = $this->input->post('first_shift_start');
            $first_shift_end = $this->input->post('first_shift_end');
            $second_shift_start = $this->input->post('second_shift_start');
            $second_shift_end = $this->input->post('second_shift_end');

            $this->db->select('schedule.id');
            
            $this->db->from('schedule');
                    
            $this->db->where(array('schedule.date' => $date, 'schedule.doctor_id' => $doctor_id, 'schedule.first_shift_start' => $first_shift_start, 
                                    'schedule.first_shift_end' => $first_shift_end, 'schedule.second_shift_start' => $second_shift_start, 
                                    'schedule.second_shift_end' => $second_shift_end));
            $q = $this->db->get();

            $result = $q->result_array();
            if(!empty($result))
            {
                return TRUE;
            }
            return FALSE;
        }
    }