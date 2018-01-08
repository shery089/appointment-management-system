 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <?php 
                if($this->session->flashdata('failure_message'))
                {
                ?>

                <p class="alert <?= ($this->session->flashdata('failure_message') ? 'alert-danger' : '') ?> alert-dismissable fade in text-center top-height"><?php if($this->session->flashdata('failure_message')) {echo $this->session->flashdata('failure_message');} ?>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </p>
                <?php
                }
            ?>
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?php foreach ($record as $patient): ?>
            <?= form_open('a/patient/edit_patient_lookup/' . $patient['id'] , 'class="patient_form"'); ?>
            <h1 class="page-header text-center">Edit Patient</h1>

        <!-- First Name -->
        <div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('First Name: ', 'first_name'); ?>
                    <?php

                        $data = array(
                            
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'first_name',
                            'id'            => 'first_name',
                            'value'         =>  ucwords(entity_decode($patient['first_name']))
                            
                        );
                    ?>
                    <?= form_input($data); ?>
                    <?= form_error('first_name'); ?>
                </div>
            </div>           

            <!-- Middle Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Middle Name: ', 'middle_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'middle_name',
                            'id'            => 'middle_name',
                            'value'         => ucwords(entity_decode($patient['middle_name']))
                        );
                    ?>
                        
                    <?= form_input($data); ?>
                    <?= form_error('middle_name'); ?>
                </div>
            </div>

            <!-- Last Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Last Name: ', 'last_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'last_name',
                            'id'            => 'last_name',
                            'value'         => ucwords(entity_decode($patient['last_name']))
                        );
                    ?>                        
                    <?= form_input($data); ?>
                    <?= form_error('last_name'); ?>
                </div>
            </div>  
        </div>

        <!-- / first row -->

        <div>
            <!-- Mobile Number -->
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Mobile Number: ', 'mobile_number'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'autocomplete'  => 'off',
                            'name'          => 'mobile_number',
                            'id'            => 'mobile_number',
                            'value'         => ucwords(entity_decode($patient['mobile_number']))
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('mobile_number'); ?>
                </div>
            </div>

            <!-- Father Name -->
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Father Name: ', 'father_name'); ?>
                    <?php

                        $data = array(
                            'type'          => 'text',
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'father_name',
                            'id'            => 'father_name',
                            'value'         => ucwords(entity_decode($patient['father_name']))
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('father_name'); ?>
                </div>
            </div>

            <!-- Gender -->
            <div class="col-md-4">
                <div class="form-group">
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

                        
                        $selected = entity_decode($patient['gender'])

                    ?>
                    <?= form_dropdown('gender', $sex_options, $selected, $data); ?>
                    <?= form_error('gender'); ?>
                </div>
            </div>
             
        </div> 
        
        <!-- / second row -->
        
        <div>
            <!-- Birthday -->
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Birthday: ', 'birthday'); ?>
                    <?php

                        $data = array(
                            'type'          => 'text',
                            'class'         => 'form-control',
                            'name'          => 'birthday',
                            'id'            => 'birthday',
                            'readonly'      => 'readonly',
                            'value'         => entity_decode($patient['birthday'])
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('birthday'); ?>
                </div>
            </div>
            <!-- CNIC -->
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('CNIC: ', 'cnic'); ?>
                    <?php

                        $data = array(
                            'type'          => 'text',
                            'class'         => 'form-control',
                            'name'          => 'cnic',
                            'id'            => 'cnic',
                            'value'         => entity_decode($patient['cnic'])
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('cnic'); ?>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Email: ', 'email'); ?>
                    <?php

                        $data = array(
                            'type'          => 'email',
                            'autocomplete'  => 'off',
                            'class'         => 'form-control',
                            'name'          => 'email',
                            'id'            => 'email',
                            'value'         => ucwords(entity_decode($patient['email']))
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('email'); ?>
                </div>
            </div>            

        </div>

        <!-- / Third row -->
        
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

    </div>
            
</div> <!-- /.row