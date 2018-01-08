 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <!-- Form -->
            <?php foreach ($record as $appointment): ?>
            <?= form_open('a/appointment/edit_appointment_lookup/' . $appointment['id'], 'class="appointment_form"'); ?>
            <h1 class="page-header text-center">Edit Appointment</h1>        
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
                            $patient_id = entity_decode($patient['id']);
                            $options[$patient_id] = $patient_mr_number;
                        }

                        $selected = $appointment['patient_id']['id'];

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
                    <?= form_label('Doctor: ', 'doctor'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'id'            => 'doctor',
                            'name'          => 'doctor',
                            'title'         => 'Please Choose or Enter',
                            'data-live-search'  => TRUE,
                            'data-max-options'  => '1'
                        );

                        foreach ($doctors as $doctor) 
                        {
                            $doc_options[$doctor->id] = ucwords(entity_decode($doctor->first_name));
                        }

                        $selected = $appointment['doctor_id'];

                    ?>
                    <?= form_dropdown('doctor', $doc_options, $selected, $data); ?>
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
                            'value'         =>  stripslashes(html_entity_decode($appointment['visit_purpose'], ENT_QUOTES)),
                        );
                    ?>
                    <?= form_textarea($data); ?>
                    <?= form_error('visit_purpose'); ?> 
                </div>
            </div>
                      
        <!-- / third row -->
                <?php $morning_shift = ($appointment['morning_shift'] == 0) ? '' : $appointment['morning_shift']; ?>
                <input type="hidden" id="morning_shift_hidden" name="morning_shift_hidden" value="<?= $morning_shift ?>">

                <div class="col-lg-6">
                    <?= form_label('Morning Shift: ', 'morning_shift'); ?>
                    <div class="input-group">
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'morning_shift',
                            'id'            => 'morning_shift',
                            'value'         => $morning_shift,
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

                <?php $evening_shift = ($appointment['evening_shift'] == 0) ? '' : $appointment['evening_shift']?>
                <input type="hidden" id="evening_shift_hidden" name="evening_shift_hidden" value="<?= $evening_shift ?>">

                <div class="col-lg-6">
                    <?= form_label('Evening Shift: ', 'evening_shift'); ?>
                    <div class="input-group">
                        <?php

                            $data = array(
                                
                                'class'         => 'form-control',
                                'name'          => 'evening_shift',
                                'id'            => 'evening_shift',
                                'value'         => $evening_shift,
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
            <input type="hidden" id="edit_appt_date" name="edit_appt_date" value="<?= $appointment['date'] ?>">
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group text-right">
                    <a href="<?= base_url('appointment') ?>" class="btn btn-default">Cancel</a>
                    <input type="submit" id="edit" value="Edit" class="btn btn-success">
                </div>
            </div>
        </div>

    </div>

    <?= form_close(); ?>
    <?php endforeach; ?>
    <!-- / Form -->
        <!-- </div> -->
            
</div> <!-- /.row-->
