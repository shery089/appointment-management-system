 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?php foreach ($record as $doctor): ?>
            <?= form_open('a/schedule/edit_schedule_lookup/' . $doctor['id'] , 'class="doctor_form"'); ?>
            <h1 class="page-header text-center">Edit Schedule</h1>

        <div>
      
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('Schedule Date: ', 'schedule_date'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'readonly'      => 'readonly',
                            'name'          => 'schedule_date',
                            'id'            => 'schedule_date',
                            'value'         => $doctor['date'],
                            'disabled'      => 'disabled'
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                
                </div>
            </div>

            <div class="col-md-2"></div>

            <!-- Doctor -->
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('Doctor: ', 'doctor'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'id'            => 'doctor',
                            'name'          => 'doctor',
                            'title'         => 'Please choose one',
                            'data-live-search'  => TRUE                            
                        );

                        foreach ($all_doctors as $selected_doctor) 
                        {
                            $doc_options[$selected_doctor->id] = ucwords(entity_decode($selected_doctor->first_name));
                        }

                        $selected = $doctor['doctor_id'];

                    ?>
                    <?= form_dropdown('doctor', $doc_options, $selected, $data); ?>
                    <?= form_error('doctor'); ?>
                </div>
            </div>   
                        
        </div>

        <!-- / first row -->
        

        <!-- second row -->

        <div>
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('First Shift Start: ', 'first_shift_start'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'readonly'      => 'readonly',
                            'name'          => 'first_shift_start',
                            'id'            => 'first_shift_start',
                            'value'         => $doctor['first_shift_start']
                            
                        );
                    ?>

                    <?= form_input($data); ?>           

                    <?= form_error('first_shift_start'); ?>
                </div>
            </div>         

            <div class="col-md-2">
                <div class="form-group">
                    <i class="fa fa-minus fa-fw hidden-sm hidden-xs minus-position"></i>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('First Shift End: ', 'first_shift_end'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'readonly'      => 'readonly',
                            'name'          => 'first_shift_end',
                            'id'            => 'first_shift_end',
                            'value'         => $doctor['first_shift_end']
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('first_shift_end'); ?>
                </div>
            </div>


        </div>

        <!-- / second row -->

        <!-- third row -->

        <div>
                 
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('Second Shift Start: ', 'second_shift_start'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'readonly'      => 'readonly',
                            'name'          => 'second_shift_start',
                            'id'            => 'second_shift_start',
                            'value'         => $doctor['second_shift_start']
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('second_shift_start'); ?>
                </div>
            </div>


            <div class="col-md-2">
                <div class="form-group">
                    <i class="fa fa-minus fa-fw hidden-sm hidden-xs minus-position"></i>
                </div>
            </div>
            
            <div class="col-md-5">
                <div class="form-group">
                    <?= form_label('Second Shift End: ', 'second_shift_end'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'readonly'      => 'readonly',
                            'name'          => 'second_shift_end',
                            'id'            => 'second_shift_end',
                            'value'         => $doctor['second_shift_end']
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('second_shift_end'); ?>
                </div>
            </div>
        </div>

        <!-- / third row -->

        <div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <input type="submit" value="Edit" id="edit" name="edit" class="btn btn-success">
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <?= form_close(); ?>
    <!-- / Form -->
        <!-- </div> -->
    </div>

    </div> <!-- /.row -->
            
</div> <!-- page-wrapper -->