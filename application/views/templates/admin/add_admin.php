 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
                <!-- Form -->
            <?php //validation_errors(); ?>
            <?= form_open('a/admin/add_admin_lookup'); ?>
            <h1 class="page-header text-center">Add A Admin</h1>
            
        <!-- First Name -->
        <div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('First Name: ', 'first_name'); ?>
                    <?php

                        $data = array(
                            
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
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Middle Name: ', 'middle_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
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
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Last Name: ', 'last_name'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
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

        <div>
            
            <!-- Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Password: ', 'password'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'password',
                            'id'            => 'password'
                        );
                    ?>

                    <?= form_password($data); ?>
                    <?= form_error('password'); ?>
                </div>
            </div> 
            
            <!-- Confirm Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Confirm Password: ', 'confirm_password'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'confirm_password',
                            'id'            => 'confirm_password'
                        );
                    ?>

                    <?= form_password($data); ?>
                    <?= form_error('confirm_password'); ?>             
                </div>
            </div> 

        </div>

        <div>        
            <!-- Email -->
            <div class="col-md-8">
                <div class="form-group">
                    <?= form_label('Email: ', 'email'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'type'          => 'email',
                            'name'          => 'email',
                            'id'            => 'email',
                            'value'         => set_value('email')
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('email'); ?>
                </div>
            </div>

            <!-- Mobile Number -->
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Mobile Number: ', 'mobile_number'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control',
                            'name'          => 'mobile_number',
                            'id'            => 'mobile_number',
                            'value'         => set_value('mobile_number')
                        );
                    ?>

                    <?= form_input($data); ?>
                    <?= form_error('mobile_number'); ?>
                </div>
            </div>

        </div>

        <div>        
            <!-- Address -->
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Address: ', 'address'); ?>
                    <?php

                        $data = array(
                            
                            'class'         => 'form-control textarea',
                            'name'          => 'address',
                            'id'            => 'address',
                            'value'         =>  set_value('address')
                        );
                    ?>
                    <?= form_textarea($data); ?>
                    <?= form_error('address'); ?>

                </div>
            </div>

        </div>

        <div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <input type="submit" value="Add" class="btn btn-success">
                </div>
            </div>
        </div>

    <?= form_close(); ?>
    <!-- / Form -->
        <!-- </div> -->
    </div>

    </div>
            
</div> <!-- /.row