<?php  
	class Disease_model extends CI_Model {

        private $disease;
        private $detail;

        public function __construct()
        {
            parent::__construct();        		
        }

        public function insert_disease()
        {
            $this->disease = html_escape(trim($this->db->escape($this->input->post('disease')), "''"));
        
            $this->detail = trim($this->db->escape($this->input->post('detail')), "''");
            
            $this->detail = html_escape(addslashes($this->detail));

            $data = array(
                'name' => $this->disease,

                'detail' => $this->detail
            );

            return $this->db->insert('disease', $data);       
        }

        public function update_disease($id)
        {
            $disease = $this->input->post('disease');

            $detail = html_escape(addslashes($this->input->post('detail')));

            $sql = "SELECT * FROM disease WHERE name = ? AND id != ?";
        
            $q = $this->db->query($sql, array($disease, $id));

            if($q->num_rows() > 0)
            {
                return FALSE;
            }
            else
            {
    		    $data = array(
                    'name' => $disease,

    		        'detail' => $detail
    		    );

                $this->db->where('id', $id);
                
                $this->db->update('disease', $data);         
                
                return TRUE;
            }
        }

        public function get_disease_by_id($id)
        {
            $q = $this->db->get_where('disease', array('id' => $id)); 
            
            return $q->result();
        }


        public function record_count() 
        {
            return $this->db->count_all("disease");
        }

        public function fetch_diseases($limit, $start) 
        {
            $this->db->limit($limit, $start);
            $query = $this->db->get("disease");

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

        public function delete_disease($id)
        {
            if ($this->db->delete('disease', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        }       

        public function get_all_diseases()
        {
            $q = $this->db->get('disease'); 
            
            return $q->result();
        }	
	}	
?>