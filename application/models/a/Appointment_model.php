<?php  
	class Appointment_model extends CI_Model {

        private $admin_id,
                $doctor_id,
                $patient_mr_number,
                $visit_purpose,
                $date,
                $time,
                $morning_shift,
                $evening_shift,
                $insert_date,
                $update_date;

        public function __construct()
        {
            parent::__construct();
            $this->load->model('a/patient_model');              
            $this->load->model('a/doctor_model');              
        }

        public function insert_appointment()
        {

            if(empty($this->session->admin_id))
            {
                $this->admin_id = 0;
            }
            else
            {
                $this->admin_id = html_escape($this->session->admin_id);
            }

            if(empty($this->input->post('doctor')))
            {
                $this->doctor_id = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor_id')), "'' ")));
            }
            else
            {
                $this->doctor_id = html_escape(strtolower(trim($this->db->escape($this->input->post('doctor')), "'' ")));
            }  

            if(!empty($this->input->post('patient_id')))
            {
                $this->patient_id = html_escape(trim($this->db->escape($this->input->post('patient_id')), "'' "));
            }            
            else
            {
                $this->patient_id = $this->db->insert_id(); 
            }

            $this->morning_shift = $this->trim_time(html_escape(trim($this->input->post('morning_shift'))), "'' ");
           
            $this->evening_shift = $this->trim_time(html_escape(trim($this->input->post('evening_shift'))), "'' ");

            $this->visit_purpose = html_escape(trim($this->db->escape($this->input->post('visit_purpose')), "'' "));

            $this->date = html_escape(trim($this->db->escape($this->input->post('submitted_date')), "'' "));
        
            if(empty($this->date))
            {
                $this->date = date("Y-m-d");
            }

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->insert_date = $date;

            $this->update_date = $date;

            $data = array(

                'admin_id' => $this->admin_id,

                'doctor_id' => $this->doctor_id,

                'patient_id' => $this->patient_id,

                'date' => $this->date,

                'morning_shift' => $this->morning_shift,

                'evening_shift' => $this->evening_shift,

                'visit_purpose' => $this->visit_purpose,

                'inserted_date' => $this->insert_date,
                                
                'updated_date' => $this->update_date

            );



            $this->db->insert('appointment', $data);

?>
    <script>
        window.onbeforeunload = function() {
            localStorage.removeItem('date');
        return '';
    };
    </script>
<?php

    return TRUE;
            }

/*            $appointment_id = $this->db->insert_id();

            if(strrchr($this->specialization, ','))
            {
                $this->specialization = explode(',', $this->specialization);

                foreach ($this->specialization as $specialization) 
                {
                    $this->db->query("INSERT INTO appointment_details (appointment_id, specialization_id) 
                                        VALUES($appointment_id, $specialization)");                
                }
            }
            else
            {
                $this->db->query("INSERT INTO appointment_details (appointment_id, specialization_id) 
                                    VALUES($appointment_id, $this->specialization)");
            }

            COMMIT;
*/          


        public function update_appointment($appointment_id)
        {

            if(!empty($this->input->post('morning_shift')))
            {
                $this->morning_shift = $this->trim_time(html_escape(trim($this->input->post('morning_shift'))), "'' ");
            }
            else if(!empty($this->input->post('evening_shift')))
            {
                $this->evening_shift = $this->trim_time(html_escape(trim($this->input->post('evening_shift'))), "'' ");
            }   
            else
            {
                $this->morning_shift = $this->trim_time(html_escape(trim($this->input->post('morning_shift_hidden'))), "'' ");
                $this->evening_shift = $this->trim_time(html_escape(trim($this->input->post('evening_shift_hidden'))), "'' ");
            }

            $this->admin_id = html_escape($this->session->admin_id);

            $this->doctor_id = html_escape(trim($this->db->escape($this->input->post('doctor')), "'' "));

            $this->patient_id = html_escape(trim($this->db->escape($this->input->post('patient_id')), "'' "));

            $this->status = trim($this->db->escape($this->input->post('status')), "'' ");

            $this->visit_purpose = html_escape(trim($this->db->escape($this->input->post('visit_purpose')), "'' "));

            $this->date = html_escape(trim($this->db->escape($this->input->post('submitted_date')), "'' "));

            if(empty($this->date))
            {
                $this->date = html_escape(trim($this->db->escape($this->input->post('edit_appt_date')), "'' "));
            }        

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->insert_date = $date;

            $this->update_date = $date;
            
            $data = array(

                'admin_id' => $this->admin_id,

                'doctor_id' => $this->doctor_id,

                'patient_id' => $this->patient_id,

                'date' => $this->date,

                'morning_shift' => $this->morning_shift,
                
                'status' => $this->status,

                'evening_shift' => $this->evening_shift,

                'visit_purpose' => $this->visit_purpose,

                'inserted_date' => $this->insert_date,
                
                'updated_date' => $this->update_date,

                'updated_admin' => $this->admin_id

            );

            $this->db->where('id', $appointment_id);
            
            $this->db->update('appointment', $data);         
            
            return TRUE;
        }

        public function reschedule_appointment($appointment_id)
        {
            if(!empty($this->input->post('morning_shift')))
            {
                $this->morning_shift = $this->trim_time(html_escape(trim($this->input->post('morning_shift'))), "''");
            }
            else if(!empty($this->input->post('evening_shift')))
            {
                $this->evening_shift = $this->trim_time(html_escape(trim($this->input->post('evening_shift'))), "''");
            }   
            else
            {
                $this->morning_shift = $this->trim_time(html_escape(trim($this->input->post('morning_shift_hidden'))), "''");
                $this->evening_shift = $this->trim_time(html_escape(trim($this->input->post('evening_shift_hidden'))), "''");
            }

            $this->admin_id = html_escape($this->session->admin_id);

            $this->date = html_escape(trim($this->db->escape($this->input->post('submitted_date')), "''"));

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->update_date = $date;
            
            $data = array(

                'admin_id' => $this->admin_id,

                'date' => $this->date,

                'morning_shift' => $this->morning_shift,

                'evening_shift' => $this->evening_shift,
                
                'updated_date' => $this->update_date,

                'updated_admin' => $this->admin_id

            );

            $this->db->where('id', $appointment_id);
            
            $this->db->update('appointment', $data);         
            
            return TRUE;
        }

        public function delete_appointment($id)
        {
            if ($this->db->delete('appointment', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       
/*

        public function record_count() 
        {
            return $this->db->count_all("appointment");
        }

        public function fetch_appointment($limit, $start) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get("appointment");

            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
       }*/

        public function get_appointment_by_id($id, $only_doc = FALSE, $attach_doc_id = FALSE)
        {
            $q = $this->db->get_where('appointment', array('id' => $id)); 
            
            $result = $q->result_array();

            $result = $this->get_attachments($result, $only_doc, $attach_doc_id);

            return $result;
        }

        public function get_appointments()
        {
            $data = $this->db->get('appointment');
            
            $result = $data->result_array();

            $result = $this->get_attachments($result);

            return $result;
        }

        public function get_unapproved_appointments()
        {        
            $data = $this->db->get_where('appointment', array('status' => 0));
            
            $result = $data->result_array();

            $result = $this->get_attachments($result);

            return json_encode($result);
        }

        public function get_unapproved_appointments_count()
        {        
            $data = $this->db->get_where('appointment', array('status' => 0));
            
            $result = $data->result_array();

            $result = count($result);

            return json_encode($result);
        }

        public function get_attachments($attachments, $only_doc=FALSE, $attach_doc_id = FALSE)
        {
            for ($i=0, $count = count($attachments); $i < $count; $i++) 
            { 
                if($attachments[$i])
                {
                    if($only_doc)
                    {
                        $attachments[$i]['doctor'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['id'], FALSE, TRUE, $only_doc);
                    }
                    elseif($attach_doc_id)
                    {
                        $attachments[$i]['patient_id'] = $this->patient_model->get_patient_by_id($attachments[$i]['patient_id'], FALSE, TRUE);

                        $attachments[$i]['doctor_id'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['doctor_id'], FALSE, TRUE, $only_doc);
                    }
                    else
                    {
                        $attachments[$i]['patient_id'] = $this->patient_model->get_patient_by_id($attachments[$i]['patient_id'], FALSE, TRUE);

                        $attachments[$i]['doctor_id'] = $this->doctor_model->get_doctor_by_id($attachments[$i]['doctor_id'], FALSE, TRUE, TRUE);
                    }
                }
            }
            return $attachments;
        }

        public function record_count() 
        {
            return $this->db->count_all("appointment");
        }

        public function fetch_appointments($limit, $start, $attach_specialization = TRUE) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get('appointment');

            if ($query->num_rows() > 0) 
            {

                $result = $query->result_array();

                $result = $this->get_attachments($result);
                
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

        public function get_appointments_by_date()
        {
            $date = $this->input->post('date');
            $doctor_id = $this->input->post('doctor');
            if(!empty($date))
            {
                $this->db->select('appointment.id, patient.mr_number, appointment.morning_shift, appointment.evening_shift, appointment.date');
                $this->db->from('appointment');
                $this->db->where(array('appointment.date' => $date, 'appointment.doctor_id' => $doctor_id));
                $this->db->join('patient', 'patient.id = appointment.patient_id', 'inner');
                $q = $this->db->get();
                $result = $q->result_array();
                if(!empty($result))
                {
                    return json_encode($result);
                }
                return FALSE;
            }
            return FALSE;

        }        

        public function checkReservedAppointments($date, $doctor_id, $time)
        {
            $time = $this->trim_time($time);
            $this->db->select('appointment.morning_shift, appointment.evening_shift');
            $this->db->from('appointment');
            $where = "appointment.date = '$date' AND appointment.doctor_id = '$doctor_id' AND ( appointment.morning_shift = '$time' OR appointment.evening_shift = '$time')";

            $this->db->where($where);
            
            $q = $this->db->get();

            $result = $q->result_array();
            
            // echo $this->db->last_query();

            $q->free_result();
            
            if(!empty($result))
            {
                // $date = $this->input->post('date');
                // $doctor_id = $this->input->post('doctor_id');
                $this->db->select('appointment.morning_shift, appointment.evening_shift, appointment.date, CONCAT(doctor.first_name, " ", doctor.middle_name, " ", doctor.last_name) AS doctor_name');
                $this->db->from('appointment');
                $this->db->join('doctor', 'doctor.id = appointment.doctor_id', 'inner');
                $this->db->where(array('appointment.date' => $date, 'appointment.doctor_id' => $doctor_id));
                $q = $this->db->get();
            // echo $this->db->last_query();
                return $q->result_array();   
            }
            return array('msg' => 'success');
        }
    }