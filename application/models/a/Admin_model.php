<?php  
	class Admin_model extends CI_Model {

        private $first_name;
        private $middle_name;
        private $last_name;
        private $salt;
        private $password;
        private $confirm_password;
        private $email;
        private $mobile_number;
        private $address;
        private $joined_date;
        private $updated_date;
        private $permissions;

        public function __construct()
        {
            parent::__construct();        		
        }

        public function insert_admin()
        {
            $this->first_name = html_escape(strtolower(trim($this->db->escape($this->input->post('first_name')), "''")));

            $this->middle_name = html_escape(strtolower(trim($this->db->escape($this->input->post('middle_name')), "''")));

            $this->last_name = html_escape(strtolower(trim($this->db->escape($this->input->post('last_name')), "''")));

            $this->password = html_escape(trim($this->db->escape($this->input->post('password')), "''"));

            // $this->salt = mcrypt_create_iv(32);
            $this->salt = openssl_random_pseudo_bytes(32, $cstrong);
            $this->salt = uniqid('', TRUE);
            //$this->salt = openssl_random_pseudo_bytes(32, $cstrong);
            //$this->salt = bin2hex($this->salt);
        
            $this->password = hash('sha512', $this->password . $this->salt);

            $this->email = html_escape(strtolower(trim($this->db->escape($this->input->post('email')), "''")));

            $this->mobile_number = html_escape(trim($this->db->escape($this->input->post('mobile_number')), "''"));

            $this->address = html_escape(strtolower(trim($this->db->escape($this->input->post('address')), "''")));
        
            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->joined_date = $date;

            $this->updated_date = $date;
            
            $this->permissions = '{"admin": 1}';

            $data = array(

                'first_name' => $this->first_name,

                'middle_name' => $this->middle_name,

                'last_name' => $this->last_name,

                'password' => $this->password,

                'salt' => $this->salt,

                'email' => $this->email,

                'mobile_number' => $this->mobile_number,
                
                'address' => $this->address,

                'joined_date' => $this->joined_date,

                'updated_date' => $this->updated_date,

                'permissions' => $this->permissions

            );

            //$this->db->set_charset('utf8');

            return $this->db->insert('admin', $data);       
        }

        public function update_admin($id)
        {

            $this->first_name = html_escape(strtolower(trim($this->db->escape($this->input->post('first_name')), "''")));

            $this->middle_name = html_escape(strtolower(trim($this->db->escape($this->input->post('middle_name')), "''")));
         
            $this->last_name = html_escape(strtolower(trim($this->db->escape($this->input->post('last_name')), "''")));
                              
            $this->email = html_escape(strtolower(trim($this->db->escape($this->input->post('email')), "''")));
            
            $this->mobile_number = html_escape(strtolower(trim($this->db->escape($this->input->post('mobile_number')), "''")));

            $this->address = html_escape(strtolower(trim($this->db->escape($this->input->post('address')), "''")));

            date_default_timezone_set("Asia/Karachi");
            
            $date = date("Y-m-d H:i:s");
            
            $this->updated_date = $date;

            $sql = "SELECT * FROM admin WHERE (email = ? OR mobile_number = ?) AND id != ?";
        
            $q = $this->db->query($sql, array($this->email, $this->mobile_numer, $id));

            if($q->num_rows() > 0)
            {
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

                    'address' => $this->address,

                    'updated_date' => $this->updated_date
      		    
                );

                $this->db->where('id', $id);
                
                $this->db->update('admin', $data);         
                
                return TRUE;
            }
        }

        public function get_admin_by_id($id)
        {
            $q = $this->db->get_where('admin', array('id' => $id)); 
            
            return $q->result();
        }

        public function update_password($token)
        {
            $this->salt = openssl_random_pseudo_bytes(32, $cstrong);
            $this->salt = uniqid('', TRUE);        
            $this->password = hash('sha512', $this->password . $this->salt);
            $data = array('password' => $this->password, 'salt' => $this->salt);
            $this->db->where('token', $token);            
            $this->db->update('admin', $data);
            return TRUE;
        }

        public function update_token($email, $token)
        {
            $data = array('token' => $token);
            $this->db->where('email', $email);            
            
            if($this->db->update('admin', $data));
            return TRUE;
        }

        public function match_token($token)
        {
            $q = $this->db->get_where('admin', array('token' => $token));            
            $result = $q->result();
            if($result)
            {
                return TRUE;
            }
                return FALSE;
        }

        public function delete_admin($id)
        {
            if ($this->db->delete('admin', array('id' => $id))) 
            {
                return TRUE;
            }
            return FALSE;
        } 

        public function email_exists($email)
        {
            $q = $this->db->get_where('admin', array('email' => $email));
            
            $result = $q->result();

            if(!empty($result))
            {
                return TRUE;
            }
                return FALSE;
        }       

        public function get_admins()
        {
            $q = $this->db->get('admin'); 
            
            return $q->result();
        }	
	}	
?>