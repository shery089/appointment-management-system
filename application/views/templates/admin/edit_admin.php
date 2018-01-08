 <div id="page-wrapper">
    <div class="row">
 
	
        <div class="col-lg-12">
				<!-- Form -->
			<?php //validation_errors(); ?>
			<?php foreach ($record as $admin): ?>
			<?= form_open('a/admin/edit_admin_lookup/' . $admin->id); ?>
		
			
			<h1 class="page-header text-center">Edit Admin</h1>

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
                            'value'         => $admin->first_name
                            
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
                            'value'         => $admin->middle_name
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
                            'value'         => $admin->last_name
                        );
                    ?>                        
                    <?= form_input($data); ?>
                    <?= form_error('last_name'); ?>
                </div>
            </div>      
        </div> 

        <div>

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
                            'value'         => $admin->email
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
                            'value'         => $admin->mobile_number
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
                            'value'         =>  $admin->address
                        );
                    ?>
                    <?= form_textarea($data); ?>
                    <?= form_error('address'); ?>

                </div>
            </div>

        </div>


		<div class="form-group text-right">
			<a href="<?= base_url('disease') ?>" class="btn btn-default">Cancel</a>
			<input type="submit" value="Edit" class="btn btn-success">
		</div>
	
	<?php endforeach ?>
	
	</form> 
	<!-- / Form -->
        </div>
    </div>
            
</div> <!-- /.row