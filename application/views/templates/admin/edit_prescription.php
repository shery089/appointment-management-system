 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?php foreach ($record as $prescription): ?>
            <?= form_open('a/prescription/edit_prescription_lookup/' . $prescription['id']); ?>
            <h1 class="page-header text-center">Edit prescription</h1>

        <!-- First Name -->

            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('MR-Number: ', 'mr_number'); ?>
                    <?php

                        $data = array(
                            
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'value'         =>  ucwords(entity_decode($prescription['patient_id']['mr_number'])),
                            'readonly'      => 'readonly'
                        );
                    ?>
                    <?= form_input($data); ?>
                </div>
            </div>      

            <!-- Middle Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Doctor: ', 'doctor'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'value'         => ucwords(entity_decode($prescription['doctor_id']['first_name'])),
                            'readonly'      => 'readonly'
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                </div>
            </div>      
        
            <!-- Visited Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Visited Date: ', 'visited_date'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'value'         => ucwords(entity_decode($prescription['visited_date'])),
                            'readonly'      => 'readonly'
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                </div>
            </div>      
            
            <!-- Middle Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Visited Time: ', 'visited_time'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'value'         => ucwords(entity_decode($prescription['visited_time'])),
                            'readonly'      => 'readonly'
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                </div>
            </div>      

        <div class="col-md-6">
            <div class="form-group">
        
            <?= form_label('Prescription: ', 'edit_prescription'); ?>
                <?php

                    $data = array(
                        
                        'class'         => 'form-control textarea',
                        'id'            => 'edit_prescription',
                        'name'          => 'edit_prescription',
                        'value'         =>  ucwords(entity_decode($prescription['prescription']))
                    );
                ?>
            <?= form_textarea($data); ?>
            <?= form_error('edit_prescription'); ?>            
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
        
            <?= form_label('Diet: ', 'edit_food'); ?>
                <?php

                    $data = array(
                        
                        'class'         => 'form-control textarea',
                        'id'            => 'edit_food',
                        'name'          => 'edit_food',
                        'value'         =>  ucwords(entity_decode($prescription['food']))
                    );
                ?>
            <?= form_textarea($data); ?>
            <?= form_error('edit_food'); ?>
            </div>
        </div>

            <!-- Next Visit Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Next Visit Date: ', 'edit_next_visit_date'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'edit_next_visit_date',
                            'id'            => 'edit_next_visit_date',
                            'value'         => ucwords(entity_decode($prescription['next_visit_date']))
                        );
                    ?>                        
                    <?= form_input($data); ?>
                    <?= form_error('edit_next_visit_date'); ?>
                </div>    
            </div>

        <!-- / second row -->     
           

        <div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <input type="submit" value="Edit" class="btn btn-success">
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