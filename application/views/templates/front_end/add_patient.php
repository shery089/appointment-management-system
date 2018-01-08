<pre>
<?php print_r($doctors) ?>
</pre>
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
                                   <i class="fa fa-fw flaticon-clock location-icon color-light"></i> +1-234-567-8900
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <!-- // Section 1 -->
                
                <!-- Section 2 -->
                <div class="col-md-8">
                    <form id="appointment-form" class="appointment panel panel-body marbot40 panel-grey" method="post" action="#">
                        <h3>Fix an appointment</h3>
                        <!-- Dropdown List -->
                        <div class="row clearfix">
                            <div class="col-md-6">
                            
<!--                                 <div class="form-group">
                                    <div class="dropdown marbot30">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span data-bind="label"> Choose doctors </span>
                                        </button>
                                        <ul class="doctors-dropdown">
                                            <li><a href="#">Steve John</a></li>
                                            <li><a href="#">Steve Willaims</a></li>
                                            <li><a href="#">Henry David</a></li>
                                            <li><a href="#">John Kerry</a></li>
                                            <li><a href="#">James anderson</a></li>
                                            <li><a href="#">Steve jones</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            
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

                        foreach ($doctors as $doctor) 
                        {
                            $id = $doctor['id'];
                            // $id . 'data-subtext="Rep California"';
                            $specializations = ucwords(entity_decode(implode(', ', array_column($doctor['specialization'], 'name'))));
                            $doc_options[$id] = ucwords(entity_decode($doctor['first_name']));
                        }

                        $selected = $this->input->post('doctor');

                    ?>
                    <?= form_dropdown('doctor', $doc_options, $selected, $data); ?>
                    <?= form_error('doctor'); ?>
                </div>
                            </div>
                            
                            <div class="col-md-6">
                            
                            </div>
                        </div>
                        <!-- Dropdown List -->
                        
                        <!-- Form Section -->
                        <div class="row clearfix">
                        	<div class="clearfix">
                            <div class="col-md-4">
                                <div class="clearfix form-group">
                                    <label id="first_name">First Name</label>
                                    <input name="first_name" type="text" id="first_name" class="validate['required'] textbox1" placeholder="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clearfix form-group">
                                    <label>Middle Name</label>
                                    <input name="middle_name" type="text" id="middle_name" class="validate['required'] textbox1" placeholder="">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="clearfix form-group">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="">
                                </div>
                            </div>
                            </div>
                            
                            <div class="clearfix">
                            <div class="col-md-6">    
                                <div class="form-group">
                                    <label for="emailid">Email</label>
                                    <input name="email" type="email" class="form-control" id="emailid" placeholder="">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone-number">Phone number</label>
                                    <input name="mobile_phone" type="text" class="form-control" id="mobile_phone" placeholder="">
                                </div>
                            </div>
                            </div>
                            
                            <div class="clearfix">
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <div class="clearfix marbot20">
                                        <label for="date-time">Select Date</label>
                                        <div id="datetimepicker" class="input-group date form_datetime" data-date-format="dd MM yyyy" data-link-field="dtp_input1">
                                        <input name="dt" type="text" value="" id="date-time" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>                
                                        </div>
                                        <input type="hidden" id="dtp_input1" value="" />
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="security-number">Social security number</label>
                                    <input name="security" type="text" class="form-control" id="security-number" placeholder="">
                                </div>
                            </div>
                            </div>
                            
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="message">Please Select Below</label>
                                    <!--<textarea class="form-control" rows="4" id="message"> </textarea>-->
                                        <select name="consulting" class="select reason-option">
                                            <option value="Please Select Below"> --- --- Select Below --- --- </option>
                                            <option value="I Would Like to Book a Consultation">I Would Like to Book a Consultation</option>
                                            <option value="I Would Like a Call Back">I Would Like a Call Back</option>
                                            <option value="I'm Interested in LASIK or LASEK">I'm Interested in LASIK or LASEK</option>
                                            <option value="Implantable Contact Lenses">Implantable Contact Lenses</option>
                                            <option value="Clear Lens Exchange">Clear Lens Exchange</option>
                                            <option value="Cataract Treatment Information">Cataract Treatment Information</option>
                                            <option value="Keratoconus Treatment Information">Keratoconus Treatment Information</option>
                                            <option value="Intraocular Lens Exchange">Intraocular Lens Exchange</option>
                                        </select>
                                   
                                </div>
                            </div>
                        
                            <div class="col-md-3"> 
                            
                            </div>
                        </div>
                        
                        <div class="row clearfix marbot30">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" rows="4" id="message"> </textarea>
                                </div>
                            </div>
                        
                            <div class="col-md-3"> 
                            
                            </div>
                        </div>
                          
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-type1-reverse">Book Appointment</button>
                            </div>
                        </div>
                        <!-- // Form Section -->
                    </form>
                    <div id="post_message"><p class="fontresize"> </p></div>
                    
                </div>
                <!-- // Section 2 -->

            </div>
        </div>
    </div>
</section>

<!-- // appointment form Section
================================================== -->