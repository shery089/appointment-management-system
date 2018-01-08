<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	
		$this->load->library('layouts');	
		$this->load->model('a/admin_model');	
	}

	public function index()
	{
		$this->layouts->set_title('Admin'); 
		$data['admins'] = $this->admin_lookup();
		$this->layouts->view('templates/admin/admins', $data);
	}

	public function dashboard()
	{		
		$this->layouts->set_title('Dashboard'); 
		
		$this->layouts->view('templates/admin/index');
	}

	public function add_admin_lookup()
	{
		$this->layouts->set_title('Add Admin'); 
			    	    
	    $this->form_validation->set_rules(

	    		'first_name', 'First Name', 
	    		'trim|required|min_length[3]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_rules(

    		'middle_name', 'Middle Name', 
    		'trim|min_length[1]|max_length[50]|alpha'	    
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

		$this->form_validation->set_rules(

	    		'address', 'Address', 
	    		'trim|required|min_length[15]|max_length[500]|callback__address_regex',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_message('_address_regex', '%s should only contain characters (case-insentitive), spaces, numbers and ( # , . /)');
  
	    $this->form_validation->set_rules(

	    		'email', 'Email', 
	    		'trim|required|min_length[15]|max_length[70]|valid_email|is_unique[admin.email]',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );
		
		$this->form_validation->set_rules(

	    		'mobile_number', 'Mobile Number',
	    		'trim|required|min_length[11]|max_length[15]|is_natural|is_unique[admin.mobile_number]',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_natural'		=> '%s should only contain numbers'
        		)
	    );
	    
		
		$this->form_validation->set_rules(

	    		'password', 'Password',
	    		'trim|required|min_length[5]|max_length[15]|alpha_dash',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'alpha_dash'		=> '%s should only contain characters (case-insentitive), spaces, underscores and hypens'
        		)
	    );
	    
		$this->form_validation->set_rules(

	    		'confirm_password', 'Confirm Password',
	    		'trim|required|min_length[5]|max_length[15]|alpha_dash|matches[password]',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'alpha_dash'		=> '%s should only contain characters (case-insentitive), spaces, underscores and hypens'
        		)
	    );
	    
		
	    if ($this->form_validation->run() === FALSE)
	    {
			$this->layouts->view('templates/admin/add_admin');	 	
	    }
	    else
	    {
			$this->admin_model->insert_admin();
			$this->session->set_flashdata('success_message', 'Admin ' . ucfirst($this->input->post('first_name')) . ' with email ' .$this->input->post('email') . ' has been successfully added!');
		    redirect('/a/admin/');
	    }		
	}	

	public function edit_admin_lookup($id)
	{		
		$this->layouts->set_title('Edit admin'); 
			    	    
	    $this->form_validation->set_rules(

	    		'first_name', 'First Name', 
	    		'trim|required|min_length[3]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_unique'     => 'This %s already exists.'
        		)
	    );

	    $this->form_validation->set_rules(

    		'middle_name', 'Middle Name', 
    		'trim|min_length[1]|max_length[50]|alpha'	    
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_rules(

	    		'last_name', 'Last Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

		$this->form_validation->set_rules(

	    		'address', 'Address', 
	    		'trim|required|min_length[15]|max_length[100]|callback__address_regex',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    $this->form_validation->set_message('_address_regex', '%s should only contain characters (case-insentitive), spaces, numbers and ( # , . /)');
  
	    $this->form_validation->set_rules(

	    		'email', 'Email', 
	    		'trim|required|min_length[15]|max_length[70]|valid_email',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );
		
		$this->form_validation->set_rules(

	    		'mobile_number', 'Mobile Number',
	    		'trim|required|min_length[11]|max_length[15]|is_natural',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_natural'		=> '%s should only contain numbers'
        		)
	    );

	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->admin_by_id_lookup($id);
			$this->layouts->view('templates/admin/edit_admin', $data);	 	
	    }
	    else
	    {
			$this->admin_model->update_admin($id);
			$this->session->set_flashdata('success_message', 'Admin ' . ucfirst($this->input->post('first_name')) . ' with email ' . $this->input->post('email') . ' has been successfully updated!');
		    redirect('/a/admin');
	    }		
	}

	public function forgot_password()
	{
		$this->load->view('templates/admin/forgot_password_email');
	}

	public function mail_send_message()
	{
		$this->load->view('templates/admin/mail_send_message');
	}

	public function recover_password()
	{
		$email = $this->input->post('email');
	    
	    $this->form_validation->set_rules(

	    		'email', 'Email', 
	    		'trim|required|valid_email',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

	    if ($this->form_validation->run() === FALSE)
	    {
	    	$this->load->view('templates/admin/forgot_password_email');
	    }
	    else
	    {
	    	if($this->admin_model->email_exists($email))
	    	{
	    		$token = bin2hex(openssl_random_pseudo_bytes(32));
	    		$this->admin_model->update_token($email, $token);
				// $forgot_password = $this->load->view('templates/admin/forgot_password/' . $token, '', TRUE);
				$to = $email;
				$subject = "Reset Password | " . CLINIC;
				// $msgcontents = $forgot_password->output->final_output;
				$msgcontents = '<p>Hi, We got a request to reset your password</p><a href=' . site_url('a/admin/new_password') . '/' . $token . '>Reset Password<a><p>If you ignore this message, your password won\'t change</p>';
				$headers = "MIME-Version: 1.0 \r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
				$headers .= "From: " . CLINIC .  "\r\n";
				$mailsend = mail($to, $subject, $msgcontents, $headers);

				if ($mailsend) 
				{
					redirect('a/admin/mail_send_message');			
				}	    	
	    	}
	    	else
	    	{
	    		$this->session->set_flashdata('email_not_found', 'The given email is not in our admin records!<br>Please enter a registered email');
				redirect('a/admin/forgot_password');
	    	}
	    }
		
		// if($this->admin_model->email_exists($email))
		// {

		// }

		// else
		// {
		// 	$this->session->set_flashdata('email_not_found', 'The given email is not in our admin records!<br>Please enter a registered email');
		// 	redirect('a/admin/forgot_password');
		// }
		// die();
		// $a = $this->load->view('templates/admin/forgot_password', true);
		// print_r($a->output->final_output);
		// $to = "sheryarahmed007@gmail.com";
		// $subject = "Reset Password |" . CLINIC;
		// $msgcontents = $this->load->view('templates/admin/forgot_password', true);
		// $headers = "MIME-Version: 1.0 \r\n";
		// $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		// $headers .= "From: " . CLINIC .  "\r\n";
		// $mailsend = mail($to, $subject, $msgcontents, $headers);

		// if ($mailsend) 
		// {
		// 	$this->load->view('templates/admin/mail_send_message');			
		// }
	}

	public function new_password()
	{
		$token = $this->uri->segment(4);

		if($this->admin_model->match_token($token))
		{

			$this->form_validation->set_rules(

		    		'password', 'Password',
		    		'trim|required|min_length[5]|max_length[15]|alpha_dash',
		        	array(
	                	'required'      => 'You have not provided any %s.',
	                	'alpha_dash'		=> '%s should only contain characters (case-insentitive), spaces, underscores and hypens'
	        		)
		    );
		    
			$this->form_validation->set_rules(

		    		'confirm_password', 'Confirm Password',
		    		'trim|required|min_length[5]|max_length[15]|alpha_dash|matches[password]',
		        	array(
	                	'required'      => 'You have not provided any %s.',
	                	'alpha_dash'		=> '%s should only contain characters (case-insentitive), spaces, underscores and hypens'
	        		)
		    );

		    if ($this->form_validation->run() === FALSE)
		    {
				$this->load->view('templates/admin/new_password');
		    }
		    else
		    {
				$this->admin_model->update_password($token);
				$this->session->set_flashdata('password_reset', 'Password has been successfully updated!');
				redirect('a/admin/login');
		    }
		
		}
		else
		{
			redirect('a/admin/recover_password');
		}

	}

	public function get_modal($id)
	{		

		$data['record'] = $this->admin_by_id_lookup($id);	
		
		$this->load->view('templates/admin/admin_modal', $data);
		
	}

	function _admin_regex($admin) 
	{
		if (preg_match('/^[a-z ]+$/i', $admin)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}

	function _address_regex($address) 
	{
		if (preg_match('/^[a-z \-\/0-9#.,]+$/i', $address)) 
		{
			return TRUE;
		} 
		else 
		{
			return FALSE;
		}
	}

	public function admin_lookup()
	{
		$admins = $this->admin_model->get_admins();
		return $admins;
	}	

	public function admin_by_id_lookup($id)
	{
		$admin = $this->admin_model->get_admin_by_id($id);
		return $admin;
	}

	public function delete_admin_lookup($id)
	{
		if ($this->admin_model->delete_admin($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/a/admin/');
		}
	}	
}

