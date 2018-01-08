<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {



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
		$this->load->model('a/doctor_model');	
		$this->load->model('a/doctor_specialization_model');	
	}

	public function index()
	{
		$this->layouts->set_title('Doctor'); 

		$config = array();
        $config["base_url"] = base_url('a/') . '/'  . $this->router->fetch_class() . '/' . $this->router->fetch_method();
	    $config["total_rows"] = $this->doctor_model->record_count();
		$config['per_page'] = 5;
        $config["uri_segment"] = 4;
		//$choice = $config["total_rows"] / $config["per_page"];
		// $config["num_links"] = round($choice);
		// $config['use_page_numbers'] = TRUE;
		$config["num_links"] = 1;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = $config['last_tag_open']= $config['next_tag_open']= $config['prev_tag_open'] = $config['num_tag_open'] = '<li>';
        $config['first_tag_close'] = $config['last_tag_close']= $config['next_tag_close']= $config['prev_tag_close'] = $config['num_tag_close'] = '</li>';
        // By clicking on performing NEXT pagination.
		//$config['next_link'] = 'Next';

		// By clicking on performing PREVIOUS pagination.
		//$config['prev_link'] = 'Previous';
        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["doctors"] = $this->doctor_model->fetch_doctors($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

		$this->layouts->view('templates/admin/doctors', $data);
	}

	public function add_doctor_lookup()
	{
		$submitted_specializations = $this->input->post('specializations');

		$this->layouts->set_title('Add Doctor'); 
			    	    
	    $this->form_validation->set_rules(

	    		'first_name', 'First Name', 
	    		'trim|required|min_length[2]|max_length[50]|alpha',
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
	    		'trim|min_length[2]|max_length[50]|alpha',
	        	array(
                	'required'      => 'You have not provided any %s.'
        		)
	    );

		$this->form_validation->set_rules(

	    		'specialization', 'Specialization', 
	    		'required',
	        	array(
                	'required'     => 'You have not provided any %s.'
        		)
	    );
  
	    $this->form_validation->set_rules(

	    		'fee', 'Fee', 
	    		'trim|required|is_natural|min_length[1]|max_length[11]',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_natural'	=> '%s should only contain numbers'
        		)
	    );	  
  
	    $this->form_validation->set_rules(

	    		'image', 'Image', 
	    		'trim'
	    );	  

		$this->form_validation->set_rules(

				'mobile_number', 'Mobile Number',
				'trim|required|is_natural|min_length[11]|max_length[11]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    );

		$this->form_validation->set_rules(

				'password', 'Password',
				'trim|required|min_length[5]|max_length[100]',
		    	array(
		        	'required'      => 'You have not provided any %s.'
				)
	    ); 

		$this->form_validation->set_rules(

				'description', 'Description',
				'trim|required|min_length[10]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    );  
		
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$this->load->model('doctor_model');
	    	$this->load->model('doctor_specialization_model');
			$data['specializations'] = $this->doctor_specialization_model->get_all_specialization();
			$this->layouts->view('templates/admin/add_doctor', $data);	 	
	    }
	    else
	    {
	    	if($_FILES['image']['name'] == '')
	    	{
	    		$file = 'no_image_600.png';
	    	}
	    	else
	    	{
		    	$name = $_FILES['image']['name'];
		    	$parts = pathinfo($name);
		    	$extension	= $parts['extension'];
		    	$new_name = 'MY_' . time() . '.' . $extension;
		    	$upload_path = IMAGE_PATH;
		    	$file = $new_name;
		    }

			if($this->doctor_model->insert_doctor($file))
			{

				$config['upload_path'] = $upload_path;		        
		        
		        $config['allowed_types'] = 'jpg|jpeg|png';

		        $config['file_name'] = $new_name;
         		
         		$config['max_size'] = 10485760;

				$this->upload->initialize($config);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {

                }
                else
                {
                	$this->upload->data();
                }

				$this->session->set_flashdata('success_message', 'Doctor ' . ucfirst($this->input->post('first_name')) . ' with email ' .$this->input->post('email') . ' has been successfully added!');
			    redirect('/a/doctor/');
	    	}
	    }		
	}	

	public function edit_doctor_lookup($id)
	{		
		$this->layouts->set_title('Edit doctor');

		$this->form_validation->set_rules(

	    		'first_name', 'First Name', 
	    		'trim|required|min_length[4]|max_length[50]|alpha',
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

	    		'image', 'Image', 
	    		'trim'
	    );	  


		$this->form_validation->set_rules(

	    		'specialization', 'Specialization', 
	    		'required',
	        	array(
                	'required'     => 'You have not provided any %s.'
        		)
	    );
  
	    $this->form_validation->set_rules(

	    		'fee', 'Fee', 
	    		'trim|required|is_natural|min_length[1]|max_length[11]',
	        	array(
                	'required'      => 'You have not provided any %s.',
                	'is_natural'	=> '%s should only contain numbers'
        		)
	    );	  

		$this->form_validation->set_rules(

				'mobile_number', 'Mobile Number',
				'trim|required|is_natural|min_length[11]|max_length[11]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    );  


		$this->form_validation->set_rules(

				'description', 'Description',
				'trim|required|min_length[10]',
		    	array(
		        	'required'      => 'You have not provided any %s.',
		        	'is_natural'		=> '%s should only contain numbers'
				)
	    ); 
	    
	    if ($this->form_validation->run() === FALSE)
	    {
	    	$data['record'] = $this->doctor_by_id_lookup($id, TRUE);

	    	$data['specializations'] = $this->doctor_specialization_model->get_all_specialization(TRUE);

			$this->layouts->view('templates/admin/edit_doctor', $data);	 	
	    }
	    else
	    {
	    	if($_FILES['image']['name'] != '')
	    	{
	    		$this->delete_picture($id);
		    	
		    	$name = $_FILES['image']['name'];
		    	$parts = pathinfo($name);
		    	$extension	= $parts['extension'];

		    	$new_name = 'MY_' . time() . '.' . $extension;
		    	
		    	$upload_path = IMAGE_PATH;

		    	$file = $new_name;

		    	$config['upload_path'] = $upload_path;		        
		        
		        $config['allowed_types'] = 'jpg|jpeg|png';

		        $config['file_name'] = $new_name;
         		
         		$config['max_size'] = 100000000;

				$this->upload->initialize($config);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {

                }
                else
                {
                	$this->upload->data();
                }
	    	}

			$this->doctor_model->update_doctor($id, $file);
			$this->session->set_flashdata('success_message', 'Doctor ' . ucfirst($this->input->post('first_name')) . ' has been successfully updated!');
		    redirect('/a/doctor/');
	    }		
	}

	public function get_modal($id)
	{		

		$data['record'] = $this->doctor_by_id_lookup($id, TRUE);	

		$this->load->view('templates/admin/doctor_modal', $data);
		
	}

	function _doctor_regex($doctor) 
	{
		if (preg_match('/^[a-z ]+$/i', $doctor)) 
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

	public function doctor_lookup()
	{
		$doctors = $this->doctor_model->get_doctors();
		return $doctors;
	}	

	public function doctor_by_id_lookup($id, $attach_specialization = FALSE)
	{
		$doctor = $this->doctor_model->get_doctor_by_id($id, $attach_specialization);
		return $doctor;
	}	

	public function specialization_by_id_lookup($id)
	{
		$specialization = $this->doctor_model->get_doctor_specialization($id);
		return $specialization;
	}

	public function delete_doctor_lookup($id)
	{
		$this->delete_picture($id);

		if ($this->doctor_model->delete_doctor($id)) 
		{
			$this->session->set_flashdata('delete_message', 'Record has been successfully deleted!');
		    redirect('/a/doctor/');
		}
	}

	public function delete_picture($id)
	{
		$result = $this->doctor_by_id_lookup($id);
		$image = $result[0]['image'];

		if($image != 'no_image_600.png')
		{
			unlink(IMAGE_PATH . DIRECTORY_SEPARATOR . $image);
		}
	}
}

