 <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
   			<?php 
   				if($this->session->flashdata('success_message') OR $this->session->flashdata('delete_message'))
   				{
   				?>

   				<p class="alert <?= ($this->session->flashdata('delete_message') ? 'alert-danger' : 'alert-success') ?> alert-dismissable fade in text-center top-height"><?php if($this->session->flashdata('success_message')) {echo $this->session->flashdata('success_message');} elseif($this->session->flashdata('delete_message')) {echo $this->session->flashdata('delete_message');}else{ echo '';} ?>
   					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				</p>
   				<?php
   				}
   				?>
            <h1 class="page-header"><?= $layout_title; ?></h1>
             </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    			<div class="col-lg-12">
					<!-- Add Category Button -->
					<div class="form-group text-left">
						<a href="<?= site_url('a/patient/add_patient_lookup'); ?>" class="btn btn-primary">Add New</a>
					</div>
				</div>
				<?php if(!empty($patients)): ?>
			<!-- <div class="ui-widget"> -->
				<div class="col-lg-3">
		    		<div class="form-group custom-search-form">
			       		<input type="text" id="search_mobile_number" name="search_mobile_number" class="form-control" placeholder="Mobile Number">
			   		</div>
		    	</div>				
				<div class="col-lg-3">
		    		<div class="form-group custom-search-form">
		        		<input type="text" id="search_father_name" name="search_father_name" class="form-control" placeholder="Father Name">
		    		</div>
	    		</div>					
	    		<div class="col-lg-3">
		    		<div class="form-group custom-search-form">
		        		<input type="text" id="search_cnic" name="search_cnic" class="form-control" placeholder="CNIC">
		    		</div>
	    		</div>	
	    		<div class="col-lg-3">
		    		<div class="input-group custom-search-form">
		        		<input type="text" id="mr_number" name="mr_number" class="form-control" placeholder="MR-Number">
		        		<span class="input-group-btn">
			        		<button class="btn btn-default" id="patient_search" name="patient_search" type="button">
			            		<i class="fa fa-search"></i>
			        		</button>
		    			</span>
		    		</div>
	    		</div>
	    		<br>
        <div class="col-lg-12">
        <div id="searched_patients">
        	<div class="table-responsive">
			<table class="table table-bordered table-striped table">
				<col width="100">
  				<col width="80">
  				<col width="100">
  				<col width="100">
  				<col width="50">
  				<col width="40">
  				<col width="120">
  				<col width="100">
  				<col width="100">
  				<col width="120">
			    <thead>
			    	<tr>
			    		<th>First Name</th>
			    		<th>Middle Name</th>
			    		<th>Last Name</th>
			    		<th>MR-Number</th>
			    		<th>Gender</th>
			    		<th>Age</th>
			    		<th>Father Name</th>
			    		<th>Email</th>
			    		<th>Mobile Number</th>
			    		<th>Actions</th>
			    	</tr>
			    </thead>
			    <tbody>
			    <?php foreach ($patients as $patient): ?>
			    	<tr>
			   			<td><?= ucwords(entity_decode($patient['first_name'])); ?></td>
			   			<td><?= ucwords(entity_decode($patient['middle_name'])); ?></td>
			   			<td><?= ucwords(entity_decode($patient['last_name'])); ?></td>
			   			<td><?= ucwords(entity_decode($patient['mr_number'])); ?></td>
			   			<td><?= ucwords(entity_decode($patient['gender'])); ?></td>
			   			<td><?= ageCalculator(entity_decode($patient['birthday'])); ?></td>
			   			<td><?= ucwords(entity_decode($patient['father_name'])); ?></td>
			   			<td><?= entity_decode($patient['email']); ?></td>
			   			<td><?= entity_decode($patient['mobile_number']); ?></td>
			   			<td>
			   				<a href="<?= site_url('a/patient/edit_patient_lookup') . '/' . $patient['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="javascript:void(0)" onclick="getModal(<?= $patient['id']; ?>, 'delete', 'patient')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
			   				<a href="javascript:void(0)" onclick="getModal(<?= $patient['id']; ?>, 'view', 'patient')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
			   			</td>
			   		</tr>
				<?php endforeach; ?>
			    </tbody>
  			</table>
  			<?= $links; ?>
		</div>
		</div>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
		</div>
	<?php endif; ?>
    </div>

</div> <!-- /.row  -->