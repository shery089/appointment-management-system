 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?php foreach ($record as $doctor): ?>
            <?= form_open_multipart('a/doctor/edit_doctor_lookup/' . $doctor['id'] , 'class="doctor_form"'); ?>
            <h1 class="page-header text-center">Edit Doctor</h1>

        <!-- First Name -->

            <div class="col-lg-4">
                <div class="form-group">
                    <?= form_label('First Name: ', 'first_name'); ?>
                    <?php

                        $data = array(
                            
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'first_name',
                            'id'            => 'first_name',
                            'value'         =>  ucwords(entity_decode($doctor['first_name']))
                            
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
                            'value'         => ucwords(entity_decode($doctor['middle_name']))
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                    <?= form_error('middle_name'); ?>
                </div>
            </div>      
        
        <!-- / first row --> 

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
                            'value'         => ucwords(entity_decode($doctor['last_name']))
                        );
                    ?>                        
                    <?= form_input($data); ?>
                    <?= form_error('last_name'); ?>
                </div>    
            </div>
           
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
                        );
                            $selected = array_column($doctor['specialization'], 'name', 'id');
                            foreach ($selected as $key => $value) 
                            {
                                $keys[] = $key;
                            }   

                            $specializations = array_column($specializations, 'name', 'id');

                        foreach ($specializations as $key => $specialization) 
                        {
                            //echo $key . $specialization;
                            $options[$key] = ucwords(entity_decode($specialization));
                        }

                        //$selected = explode(',', $this->input->post('submitted_specializations'));

                    ?>
                    <?= form_multiselect('specialization', $options, $keys, $data); ?>
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

            <!-- Fee -->
            <div class="col-lg-6">
                <div class="form-group">
                    <?= form_label('Fee: ', 'fee'); ?>
                    <?php

                        $data = array(
                            
                            'type'          => 'number',
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'fee',
                            'id'            => 'fee',
                            'min'           => '1',
                            'value'         => ucwords(entity_decode($doctor['fee']))
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('fee'); ?>
                </div>
            </div> 


            <!-- Mobile Number -->
            <div class="col-lg-6">
                <div class="form-group">
                    <?= form_label('Mobile Number: ', 'mobile_number'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'mobile_number',
                            'id'            => 'mobile_number',
                            'value'         => ucwords(entity_decode($doctor['mobile_number']))
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('mobile_number'); ?>
                </div>
            </div>


        <div class="form-group col-lg-12">
            <?= form_label('Description: ', 'description'); ?>
            <?php

                $data = array(
                    
                    'class'         => 'form-control textarea',
                    'id'            => 'description',
                    'name'            => 'description',
                    'value'         =>  html_entity_decode(stripslashes(str_replace(array('\n\r', '\r\n', '\n', '\r'), '&#013;', $doctor['description'])), ENT_QUOTES)
                );
            ?>
            <?= form_textarea($data); ?>
            <?= form_error('description'); ?>
        </div>

        <div>
            <div class="col-lg-12">
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


    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    
        <div id="image_preview">
            <br><br><br><br>
            <?php  $image = (entity_decode($doctor['image']) == '' ? 'no_image_600.png' : entity_decode($doctor['image'])) ?>
            <img class="img-responsive previewing fadein img-rounded" id="previewing" src="<?= ADMIN_ASSETS . '/images/doctors/' . $image;?>" />
            <div id="loading">
                <img class="img-responsive" src="<?= ADMIN_ASSETS . '/images/doctors/';?>coursera_ditto.gif" />
            </div>
            <div id="message" class="text-center"></div>
        </div>

    </div>

    </div> <!-- /.row -->
            
</div> <!-- page-wrapper -->