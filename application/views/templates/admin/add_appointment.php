 <div id="page-wrapper">
    <div class="row">
            <div class="alert alert-danger fade in text center" id="date-popup">
                <strong>Error!</strong> Please select a valid date.
            </div>
            <div class="alert alert-danger fade in text center" id="date-not-found-popup">
                <strong>Error!</strong> There is no schedule of this doctor at this particular date.
            </div>            
            <?php if(!empty($this->session->flashdata('reserved_time_message'))): ?>
                <div class=" text-center alert alert-danger fade in" style="margin-top: 20px;">
                    <?php echo $this->session->flashdata('reserved_time_message') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>
            <?php endif ?>
        <div class="col-lg-6">
                <!-- Form -->
            <?= form_open('a/appointment/add_appointment_lookup', 'class="appointment_form"'); ?>

            <h1 class="page-header text-center">Add Appointment</h1>
        
        <!-- first row -->

        <div>
            <!-- Patient MR-Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Patient MR-Number: ', 'patient_id'); ?>
                    <?php
                        
                        $data = array(
                            'autofocus'         => 'autofocus',                            
                            'class'             => 'form-control selectpicker',
                            'id'                => 'patient_id',
                            'name'              => 'patient_id',
                            'title'             => 'Please Choose or Enter',
                            'data-live-search'  => TRUE
                        );


                        foreach ($patients as $patient) 
                        {
                            $patient_mr_number = entity_decode($patient['mr_number']); 
                            $patient_id = $patient['id']; 
                            $options[$patient_id] = $patient_mr_number;
                        }
                        $selected = $this->input->post('patient_id');
                    ?>
                    <?= form_dropdown('patient_id', $options, $selected, $data); ?>
                    <?php //$error = explode("\n", validation_errors()); ?>

                    <? //$error[0]; ?>
                    <?= form_error('patient_id') ?>

  <!-- <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option> -->


                </div>
            </div>  

            <!-- Doctor -->
            <div class="col-md-6">
                <div class="form-group">
                    <div class="overlay"></div>
                    <?= form_label('Doctor: ', 'doctor'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'size'              => 3,
                            'disabled'      => 'disabled',
                            'id'            => 'doctor',
                            'name'          => 'doctor',
                            'title'         => 'Please Choose or Enter',
                            'data-live-search'  => TRUE,
                        );

                        // foreach ($doctors as $doctor) 
                        // {
                        //     $doc_options[$doctor->id] = ucwords(entity_decode($doctor->first_name));
                        // }

                        $selected = $this->input->post('doctor');

                    ?>
                    <?= form_dropdown('doctor', '', $selected, $data); ?>
                    <?= form_error('doctor'); ?>
                </div>
            </div>   
                        
        </div>

        <!-- / first row -->
        

            <div class="col-lg-12">
                <div class="form-group">
                    <?= form_label('Visit Purpose: ', 'visit_purpose'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'visit_purpose',
                            'id'            => 'visit_purpose',
                        );
                    ?>
                    <?= form_textarea($data, set_value('visit_purpose')); ?>
                    <?= form_error('visit_purpose'); ?> 
                </div>
            </div>
               
        <!-- / third row -->

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
                            'disabled'      => 'disabled'
                            
                        );
                    ?>

                    <?= form_input($data); ?>            
                      <span class="input-group-addon">
                        <input type="checkbox" id="morning_shift_cb" aria-label="Checkbox for following text input">
                      </span>
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
                                'disabled'      => 'disabled'
                                
                            );
                        ?>

                        <?= form_input($data); ?>            
                      <span class="input-group-addon">
                        <input type="checkbox" id="evening_shift_cb" aria-label="Checkbox for following text input">
                      </span>
                    </div>
                    <?= form_error('time'); ?>
                </div>  

    </div>



    <div class="col-lg-6" id="add-apt-rside">

  
        <div id="date">           

            <div class="col-md-12">
                <div id="date"></div>
            </div>
            <!--             <div class="col-md-6">
                <div class="form-group">
                    <div class="form-group">
                    <? // form_label('Date: ', 'date'); ?>
                    <?php
            
                        /*$data = array(
            
                            'class'         => 'form-control datepicker-here',
                            'name'          => 'date',
                            'id'            => 'date',
                            'data-language' => 'en',
                            'timepicker'    => 'true',
                            'data-timepicker' => 'true',
                            'data-datepicker' => 'true',
                            'data-time-format'=> 'hh:ii aa',
                            'value'         => set_value('date')
                        );*/
                    ?>
                    <?// form_input($data); ?>
                    <?// form_error('date'); ?>
                </div> 
                </div>
            </div> -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group text-right">
                    <!-- <input type="hidden" id="time" name="time"> -->
                    <input type="submit" id="add" value="Add" class="btn btn-success">
                </div>
            </div>
        </div>

    </div>

    <?= form_close(); ?>
    <!-- / Form -->
        <!-- </div> -->
            
</div> <!-- /.row-->