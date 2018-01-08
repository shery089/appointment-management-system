<?php  
	class Doctor_specialization_model extends CI_Model {

        private $specialization;
        private $detail;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        		
        }

        public function insert_specialization()
        {
            $this->specialization = html_escape(trim(strtolower($this->db->escape($this->input->post('specialization'))), "''"));
            $this->detail = html_escape(trim(strtolower($this->db->escape($this->input->post('detail'))), "''"));
            
            //$this->detail = addslashes($this->detail);

            //$specialization = $this->db->escape($this->input->post('specialization'));

            //$specialization = strip_quotes($specialization);

            $data = array(
                'name' => $this->specialization,
                'detail' => $this->detail
            );

            return $this->db->insert('doctor_specialization', $data);       
        }

        public function update_specialization($id)
        {
            
            $detail = html_escape(trim(strtolower(addslashes($this->input->post('detail')))));

            $specialization = html_escape(trim(strtolower($this->input->post('specialization'))));

            $sql = "SELECT * FROM doctor_specialization WHERE name = ? AND id != ?";
        
            $q = $this->db->query($sql, array($specialization, $id));

            if($q->num_rows() > 0)
            {
                return FALSE;
            }
            else
            {
    		    $data = array(
                    'name' => $specialization,
    		        'detail' => $detail
    		    );
                $this->db->where('id', $id);
                $this->db->update('doctor_specialization', $data);         
                return TRUE;
            }
        }

        public function get_specialization_by_id($id)
        {
            $q = $this->db->get_where('doctor_specialization', array('id' => $id)); 
            return $q->result();
        }

        public function delete_specialization($id)
        {
            if ($this->db->delete('doctor_specialization', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       

        public function get_all_specialization($array = FALSE)
        {
            $q = $this->db->get('doctor_specialization'); 
            if(!$array)
            {
                return $q->result();
            }
            $result = $q->result_array();
            for ($i=0, $count = count($result); $i < $count; $i++) 
            { 
                if($result[$i])
                {
                    $result['id'] = $result[$i]['name'];
                }
            }
            return $result;
        }

        public function record_count() 
        {
            return $this->db->count_all("doctor_specialization");
        }

        public function fetch_doctor_specializations($limit, $start) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get("doctor_specialization");

            if ($query->num_rows() > 0) 
            {
                foreach ($query->result() as $row) 
                {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
       }
	
	}	
?>