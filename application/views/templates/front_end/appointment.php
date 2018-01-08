<!-- Banner Section 
================================= -->
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-02 subbanner-type-2 subbanner-type-2-btn">
    	<div class="container">
        	<div class="subbanner-content banner-content">
            	<div class="skew-effect fadeInLeft animated">
                   	<span class="fw-normal">Schedule </span>Appointment				
                </div>
            </div>
    </div>
</section>

<!-- // Banner Section
================================= -->

<!-- Services Section
================================================== -->

<section class="top-bottom-spacing grey-bg">
    <div class="container">
        <div class="row">
            <div class="clearfix">
                <!-- Section 1 -->
                <div class="col-md-4">
                	<div class="heading marbot40">
                        <h2>Fix appointment with our doctors</h2>
                        <p class="fontresize marbot0">Please bring to your appointment any available medical records, including images such as x-rays and MRI.  Please fill out the appointment request form here.	</p>
                        
                  	</div>
                    
                    <div class="appointment-sidebar panel panel-body panel-grey bottom-right marbot40">
                        <ul class="cont-det">
                            <li class="border-seperator">
                            	<h4>For Emergency</h4>
                                <a href="#" class="reverse fw-500">
                                   <i class="fa fa-fw flaticon-clock location-icon color-light"></i>  <?= PHONE_NUMBER ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <!-- // Section 1 -->
                
                <!-- Section 2 -->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Fix an appointment</h3>
                        </div>
                        <div class="col-md-6">
                        <ul class="nav nav-pills">
                            <li class="active"><a id="pill_1" data-toggle="tab" href="#new_patient">New Patient</a></li>
                            <li><a data-toggle="tab" id="pill_2" href="#old_patient">Returning Patient</a></li>
                        </ul>
                        <br>
                        </div>
                    </div> 
                    <div class="tab-content">
                        <div id="new_patient" class="tab-pane fade in active">
                            <?php     
                                if($this->session->flashdata('failure_message') || $this->session->flashdata('success_message'))
                                {
                                ?>
                
                                <p class="alert <?= ($this->session->flashdata('failure_message')) ? 'alert-danger' : 'alert-danger' ?> alert-dismissable fade in text-center top-height"><?php if($this->session->flashdata('failure_message')) {echo $this->session->flashdata('failure_message');} else{ echo $this->session->flashdata('success_message');} ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </p>
                            <?php
                            }
                            ?>
                            <form id="appointment-form" class="appointment panel panel-body marbot40 panel-grey" method="post" action="<?= site_url('f/appointment/add_appointment_lookup'); ?>">
                                <?php $this->session->flashdata('success_message'); ?>
                                <!-- Form Section -->
                                <div class="row clearfix">
                                	<div class="clearfix">
                                    <div class="col-md-4">
                                        <div class="clearfix form-group">
                                            <label id="first_name">First Name:</label>
                                            <input name="first_name" type="text" id="first_name" value="<?= $this->input->post('first_name') ?>" class="validate['required'] textbox1" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="clearfix form-group">
                                            <label>Middle Name:</label>
                                            <input name="middle_name" type="text" id="middle_name" value="<?= $this->input->post('middle_name') ?>" class="validate['required'] textbox1" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="clearfix form-group">
                                            <label for="last_name">Last Name:</label>
                                            <input name="last_name" type="text" class="form-control" value="<?= $this->input->post('last_name') ?>" id="last_name" autocomplete="off">
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="clearfix">
                                    <div class="col-md-6">    
                                        <div class="clearfix form-group">
                                            <label for="emailid">Email:</label>
                                            <input name="email" type="email" class="form-control" value="<?= $this->input->post('email') ?>" id="emailid" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <label for="mobile_number">Phone number:</label>
                                            <input name="mobile_number" type="text" class="form-control" value="<?= $this->input->post('mobile_number') ?>" id="mobile_number" autocomplete="off">
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="clearfix">
                                    

                                    <!-- Gender -->
                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('Gender: ', 'gender'); ?>
                                            <?php
                                                
                                                $data = array(
                                                    
                                                    'class'         => 'form-control selectpicker',
                                                    'id'            => 'gender',
                                                    'name'          => 'gender',
                                                    'title'         => 'Please Choose one',
                                                );


                                                $genders = array('male' => 'Male','female' => 'Female');

                                                foreach ($genders as $key => $value) {
                                                    $sex_options[$key] = $value;
                                                }

                                                
                                                $selected = $this->input->post('gender');

                                            ?>
                                            <?= form_dropdown('gender', $sex_options, $selected, $data); ?>
                                            <?= form_error('gender'); ?>
                                        </div>
                                    </div>

                                    <!-- Birthday -->
                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('Birthday: ', 'birthday'); ?>
                                            <?php

                                                $data = array(
                                                    'type'          => 'text',
                                                    'class'         => 'form-control',
                                                    'name'          => 'birthday',
                                                    'id'            => 'birthday',
                                                    'value'         => set_value('birthday')
                                                );
                                            ?>

                                            <?= form_input($data); ?>
                                            <?= form_error('birthday'); ?>
                                        </div>
                                    </div>
                                    
                                    <!-- CNIC -->


                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('CNIC: ', 'cnic'); ?>
                                            <?php

                                                $data = array(
                                                    'type'          => 'text',
                                                    'class'         => 'form-control',
                                                    'name'          => 'cnic',
                                                    'id'            => 'cnic',
                                                    'value'         => set_value('cnic'),
                                                    'autocomplete'  => 'off'
                                                );
                                            ?>

                                            <?= form_input($data); ?>
                                            <?= form_error('cnic'); ?>
                                        </div>
                                    </div>

                                    <!-- MR_NUMBER -->

                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('Appointment Date: ', 'submitted_date_1'); ?>
                                            <?php

                                                $data = array(
                                                    
                                                    'class'         => 'form-control submitted_date',
                                                    'readonly'      => 'readonly',
                                                    'name'          => 'submitted_date_1',
                                                    'id'            => 'submitted_date_1',
                                                    'value'         => set_value('submitted_date_1')
                                                    
                                                );
                                            ?>
                                            <?= form_input($data); ?>
                                        </div>
                                    </div>

                                    <!-- VISIT PURPOSE -->

                                    <div class="clearfix marbot30">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="message">Visit Purpose:</label>
                                                <textarea name="visit_purpose" class="form-control" rows="4" id="visit_purpose"><?= $this->input->post('visit_purpose') ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php if($this->uri->segment(3) !== 'appointment_by_id_lookup'): ?>
                                    <!-- Dropdown List -->
                                    <div class="clearfix">
                                        <div class="col-md-6" >
                                    
                                            <!-- Doctor -->
                                            <div class="form-group">
                                                <?= form_label('Doctor: ', 'doctor'); ?>
                                                <?php
                                                    
                                                    $data = array(
                                                        
                                                        'class'         => 'form-control selectpicker btn btn-primary',
                                                        'id'            => 'doctor',
                                                        'name'          => 'doctor',
                                                        'title'         => 'Please choose one',
                                                        'data-live-search'  => TRUE
                                                    );

                                                    // foreach ($doctors as $doctor) 
                                                    // {
                                                    //     $id = $doctor['doctor_id'];
                                                    //     // $id . 'data-subtext="Rep California"';
                                                    //     $specializations = ucwords(entity_decode(implode(', ', array_column($doctor['specialization'], 'name'))));
                                                    //     $doc_options[$id] = ucwords(entity_decode($doctor['first_name']));
                                                    // }

                                                    $selected = $this->input->post('doctor');

                                                ?>
                                                <?= form_dropdown('doctor', '', $selected, $data); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <!-- Dropdown List -->
                                <?php else: ?> 
                                <div class="col-md-6">
                                
                                <?= form_label('Doctor: ', 'doctor'); ?>
                                <div class="input-group">
                                    <?php

                                        $data = array(
                                            
                                            'class'         => 'form-control',
                                            'name'          => 'doctor',
                                            'id'            => 'doctor',
                                            'value'         => set_value('doctor'),
                                            'readonly'      => 'readonly',
                                            'autocomplete'  => 'off',                                            
                                        );
                                    ?> 
                                    <?= form_input($data); ?>  
                                <br>
                                </div>
                                </div>
                                <?php endif; ?>   
                            <div class="col-lg-6">
                                <?= form_label('Morning Shift: ', 'morning_shift'); ?>
                                <div class="input-group">
                                <?php

                                    $data = array(
                                        
                                        'class'         => 'form-control',
                                        'name'          => 'morning_shift',
                                        'id'            => 'morning_shift',
                                        'value'         => set_value('morning_shift'),
                                        'title'         => 'Please select a doctor first',
                                        'readonly'      => 'readonly',
                                        'autocomplete'  => 'off',
                                        'disabled'      => 'disabled'                                        
                                    );
                                ?>

                                <span class="input-group-addon">
                                    <input type="checkbox" id="morning_shift_cb" aria-label="Checkbox for following text input">
                                </span>
                                <?= form_input($data); ?>
                                <br><br>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <?= form_label('Evening Shift: ', 'evening_shift'); ?>
                                <div class="input-group">
                                    <?php

                                        $data = array(
                                            
                                            'class'         => 'form-control',
                                            'name'          => 'evening_shift',
                                            'id'            => 'evening_shift',
                                            'value'         => set_value('evening_shift'),
                                            'title'         => 'Please select a doctor first',
                                            'readonly'      => 'readonly',
                                            'autocomplete'  => 'off',
                                            'disabled'      => 'disabled'
                                            
                                        );
                                    ?>
                                    <span class="input-group-addon">
                                        <input type="checkbox" id="evening_shift_cb" aria-label="Checkbox for following text input">
                                    </span>  
                                    <?= form_input($data); ?>  
                                <br><br>
                                </div>
                            </div>
                                    </div>
                                    
                                </div>
                                        

                                <input type="hidden" name="status" value="0">
                                  
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" name="book1" id="book1" class="btn btn-type1-reverse pull-right">Book Appointment</button>
                                    </div>
                                </div>
                                <!-- // Form Section -->
                            </form>
                </div> 

                <!-- #new_patient -->
                

                        <div id="old_patient" class="tab-pane fade in">
                            <?php     
                                if($this->session->flashdata('success_message_2'))
                                {
                                ?>
                
                                <p class="alert <?= ($this->session->flashdata('success_message_2')) ? 'alert-danger' : 'alert-danger' ?> alert-dismissable fade in text-center top-height"><?php if($this->session->flashdata('success_message_2')) {echo $this->session->flashdata('success_message_2');} else{ echo $this->session->flashdata('success_message_2');} ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </p>
                            <?php
                            }
                            ?>
                            <form id="second-appointment-form" class="appointment panel panel-body marbot40 panel-grey" method="post" action="<?= site_url('f/appointment/add_appointment_old_lookup'); ?>">
                                
                                <!-- Form Section -->
                                <div class="row clearfix">                                            
                                
                                    <!-- CNIC -->

                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('CNIC: ', 'old_cnic'); ?>
                                            <?php

                                                $data = array(
                                                    'type'          => 'text',
                                                    'class'         => 'form-control',
                                                    'name'          => 'old_cnic',
                                                    'id'            => 'old_cnic',
                                                    'value'         => set_value('old_cnic'),
                                                    'autocomplete' =>  'off'
                                                );
                                            ?>

                                            <?= form_input($data); ?>
                                        </div>
                                    </div>

                                    <!-- MR_NUMBER -->

                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <label for="mr_number">MR-Number:</label>
                                            <input name="mr_number" type="text" value="<?= $this->input->post('mr_number') ?>"  autocomplete="off" class="form-control" id="mr_number" readonly placeholder="It will be autofilled after CNIC is given">
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="clearfix form-group">
                                            <?= form_label('Appointment Date: ', 'submitted_date_2'); ?>
                                            <?php

                                                $data = array(
                                                    
                                                    'class'         => 'form-control submitted_date',
                                                    'readonly'      => 'readonly',
                                                    'name'          => 'submitted_date_2',
                                                    'id'            => 'submitted_date_2',
                                                    'value'         => set_value('submitted_date_2')
                                                );
                                            ?>
                                            <?= form_input($data); ?>
                                        </div>
                                    </div>

                            <!-- Dropdown List -->
                                <div class="col-md-6">
                                    <!-- Doctor -->
                                    <div class="clearfix form-group">
                                        <?= form_label('Doctor: ', 'doctor'); ?>
                                        <?php
                                            
                                            $data = array(
                                                
                                                'class'         => 'form-control selectpicker btn btn-primary',
                                                'id'            => 'doctor_old',
                                                'name'          => 'doctor_old',
                                                'title'         => 'Please choose one',
                                                'data-live-search'  => TRUE
                                            );

                                            // foreach ($doctors as $doctor) 
                                            // {
                                            //     $id = $doctor['doctor_id'];
                                            //     // $id . 'data-subtext="Rep California"';
                                            //     $specializations = ucwords(entity_decode(implode(', ', array_column($doctor['specialization'], 'name'))));
                                            //     $doc_options[$id] = ucwords(entity_decode($doctor['first_name']));
                                            // }

                                            $selected = $this->input->post('doctor_old');

                                        ?>
                                        <?= form_dropdown('doctor_old', '', $selected, $data); ?>
                                    </div>                                            
                                    </div>
                                </div>
                                <!-- Dropdown List -->

                                <!-- VISIT PURPOSE -->

                            <div class="row clearfix">

                            <div class="col-md-12">
                                    <div class="form-group">
                                        <br>
                                        <label for="visit_purpose_2">Visit Purpose:</label>
                                        <textarea name="visit_purpose_2" class="form-control" rows="4" id="visit_purpose_2"><?= $this->input->post('visit_purpose_2') ?></textarea>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <?= form_label('Morning Shift: ', 'morning_shift'); ?>
                                <div class="input-group">
                                <?php

                                    $data = array(
                                        
                                        'class'         => 'form-control',
                                        'name'          => 'morning_shift_2',
                                        'id'            => 'morning_shift_2',
                                        'value'         => set_value('morning_shift'),
                                        'title'         => 'Please select a doctor first',
                                        'readonly'      => 'readonly',
                                        'autocomplete'  => 'off',
                                        'disabled'      =>  'disabled'                                        
                                    );
                                ?>

                                <span class="input-group-addon">
                                    <input type="checkbox" id="morning_shift_cb_2" aria-label="Checkbox for following text input">
                                </span>
                                <?= form_input($data); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <?= form_label('Evening Shift: ', 'evening_shift'); ?>
                                <div class="input-group">
                                    <?php

                                        $data = array(
                                            
                                            'class'         => 'form-control',
                                            'name'          => 'evening_shift_2',
                                            'id'            => 'evening_shift_2',
                                            'value'         => set_value('evening_shift'),
                                            'title'         => 'Please select a doctor first',
                                            'readonly'      => 'readonly',
                                            'autocomplete'  => 'off',
                                            'disabled'      => 'disabled'
                                            
                                        );
                                    ?>
                                    <span class="input-group-addon">
                                        <input type="checkbox" id="evening_shift_cb_2" aria-label="Checkbox for following text input">
                                    </span>  
                                    <?= form_input($data); ?>  
                    
                                </div>
                            </div>
                        </div>
                                <input type="hidden" name="status" value="0">
                                  
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <br>
                                        <button type="submit" id="book2" name="book2" class="btn btn-type1-reverse pull-right">Book Appointment</button>
                                    </div>
                                </div>
                            </form>
                                <!-- // Form Section -->
                            </div>
                            <!-- old patient -->
                                                    
                    </div> <!-- tab-content -->
                    
                    <div id="post_message"><p class="fontresize"> </p></div>
                    
                </div>
                <!-- // Section 2 -->

            </div>
        </div>
    </div>
</section>

<!-- // appointment form Section
==================================================