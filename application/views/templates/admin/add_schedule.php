 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?= form_open('schedule/add_schedule_lookup', 'class="schedule_form"'); ?>
            <h1 class="page-header text-center">Add Schedule</h1>
        
        <!-- first row -->
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
                            'value'         => set_value('schedule_date')
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('schedule_date'); ?>
                    <?php $custom_error = '';
                        if(!empty($date_errors))
                        {
                            foreach ($date_errors as $date_error => $errors)
                            {
                                foreach ($errors as $error) 
                                {
                                    $array_keys = array_keys($date_errors);
                                    $last_error = end($array_keys);
                                    // print_r($date_error);
                                    if ($date_error == $last_error)
                                    {
                                        $custom_error .= $error;
                                    }
                                    else
                                    {
                                        $custom_error .= $error . ', '; 
                                    }
                                }
                            }
                        }
                    ?>
                    <?php if(!empty($custom_error)): ?>
                        <!-- <div class="error_prefix text-right"><?= $custom_error ?></div> -->
                        <input type="hidden" id="schedule_errors" value="<?= $custom_error ?>">
                    <?php endif; ?>
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

                        foreach ($doctors as $doctor) 
                        {
                            $doc_options[$doctor->id] = ucwords(entity_decode($doctor->first_name));
                        }

                        $selected = $this->input->post('doctor');

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
                <?= form_label('First Shift Start: ', 'first_shift_start'); ?>
                <div class="form-group">
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'first_shift_start',
                            'id'            => 'first_shift_start',
                            'value'         => set_value('first_shift_start')                            
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
                    <?= form_label('First Shift End: ', 'first_shift_end'); ?>
                <div class="form-group">
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'disabled'      => 'disabled',
                            'name'          => 'first_shift_end',
                            'id'            => 'first_shift_end',
                            'value'         => set_value('first_shift_end')
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
                            'disabled'      => 'disabled',
                            'name'          => 'second_shift_start',
                            'id'            => 'second_shift_start',
                            'value'         => set_value('second_shift_start')
                            
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
                            'disabled'      => 'disabled',
                            'name'          => 'second_shift_end',
                            'id'            => 'second_shift_end',
                            'value'         => set_value('second_shift_end')
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('second_shift_end'); ?>
                </div>
            </div>
        </div>

        <!-- / third row -->


        <div class="col-md-7"></div>

        <div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <input type="submit" value="Add" id="add_schedule_btn" class="btn btn-success">
                    <input type="hidden" value="<?= $this->uri->segment(2); ?> " id="controller_name">
                </div>
            </div>
        </div>
    <?= form_close(); ?>
    <!-- / Form -->
        <!-- </div> -->
    </div>

    </div>
            
</div> <!-- /.row