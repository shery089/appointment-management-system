 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?= form_open_multipart('a/doctor/add_doctor_lookup', 'class="doctor_form"'); ?>
            <h1 class="page-header text-center">Add Doctor</h1>

        <!-- First Name -->
        <div>
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('First Name: ', 'first_name'); ?>
                    <?php

                        $data = array(
                            
                            'autofocus'     => 'autofocus',
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'first_name',
                            'id'            => 'first_name',
                            'value'         => set_value('first_name')
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('first_name'); ?>
                </div>
            </div>      

            <!-- Middle Name -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('Middle Name: ', 'middle_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'middle_name',
                            'id'            => 'middle_name',
                            'value'         => set_value('middle_name')
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                    <?= form_error('middle_name'); ?>
                </div>
            </div>      

            <!-- Last Name -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('Last Name: ', 'last_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'last_name',
                            'id'            => 'last_name',
                            'value'         => set_value('last_name')
                        );
                    ?>                        
                    <?= form_input($data); ?>
                    <?= form_error('last_name'); ?>
                </div>
            </div>      
        </div> 

    <!-- END FIRST -->

        <div>
            <!-- Specialization -->
            <div class="col-lg-6">
                <div class="form-group">
                    <?= form_label('Specialization: ', 'specialization'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'id'            => 'specialization',
                            'multiple'      => 'multiple',
                            'title'         => 'Choose one or more...',
                            'data-actions-box' => 'true',
                            'data-selected-text-format' => 'count'
                        );
                            
                        foreach ($specializations as $specialization) 
                        {
                            $options[$specialization->id] = ucwords(entity_decode($specialization->name));
                        }

                        $selected = explode(',', $this->input->post('submitted_specializations'));

                    ?>
                    <?= form_multiselect('specialization', $options, $selected, $data); ?>
                    <?= form_error('specialization'); ?>
                </div>
            </div>
            
            <!-- Image -->
            <div class="col-lg-6">
                <div class="form-group">
                    <?= form_label('Image: ', 'image'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'image',
                            'id'            => 'image',
                        );
                    ?>

                    <?= form_upload($data); ?>
                </div>
            </div>
        </div>

        <!-- END SECOND -->

        <div>
            <!-- Fee -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('Fee: ', 'fee'); ?>
                    <?php

                        $data = array(
                            
                            'type'          => 'number',
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'fee',
                            'id'            => 'fee',
                            'value'         => set_value('fee'),
                            'min'           => '1'
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('fee'); ?>
                </div>
            </div> 

            <!-- Mobile Number -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('Mobile Number: ', 'mobile_number'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'mobile_number',
                            'id'            => 'mobile_number',
                            'value'         => set_value('mobile_number')
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('mobile_number'); ?>
                </div>
            </div>

            <!-- Password -->
            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('Password: ', 'password'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'password',
                            'id'            => 'password',
                            'value'         => set_value('password')
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('password'); ?>
                </div>
            </div>

        </div>

        <div class="form-group col-lg-12">
            <?= form_label('Description: ', 'description'); ?>
            <?php

                $data = array(
                    
                    'class'         => 'form-control textarea',
                    'id'            => 'description',
                    'name'            => 'description',
                    'value'         =>  stripslashes(str_replace('<br>', '\n\r', set_value('description')))
                );
            ?>
            <?= form_textarea($data); ?>
            <?= form_error('description'); ?>
        </div>

        <!-- END THIRD -->

        <div>
            <div class="col-lg-12">
                <div class="form-group text-right">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </div>

    <?= form_close(); ?>
    <!-- / Form -->
        <!-- </div> -->
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    
        <div id="image_preview">
            <br><br><br><br>
            <img class="img-responsive previewing fadein img-rounded" id="previewing" src="<?= ADMIN_ASSETS . '/images/doctors/';?>no_image_600.png" />
            <div id="loading">
                <img class="img-responsive" src="<?= ADMIN_ASSETS . '/images/doctors/';?>coursera_ditto.gif" />
            </div>
            <div id="message" class="text-center"></div>
        </div>

    </div>

    </div>
            
</div>