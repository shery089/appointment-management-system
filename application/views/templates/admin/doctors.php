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
				<a href="<?= site_url('a/doctor/add_doctor_lookup'); ?>" class="btn btn-primary">Add New</a>
			</div>
		</div>
  		<?php if(!empty($doctors)): ?>

		<div class="col-lg-4">
    		<div class="form-group custom-search-form">
	       		<input type="text" id="search_doctor_name" name="search_doctor_name" class="form-control" placeholder="Doctor Name">
	   		</div>
    	</div>				
			<div class="col-lg-4">
	    		<div class="form-group custom-search-form">
	        		<input type="text" id="search_doc_specialization" name="search_doc_specialization" class="form-control" placeholder="Specialization">
	        		<input type="hidden" id="searched_doc_id" name="searched_doc_id">
	    		</div>
    		</div>	
    		<div class="col-lg-4">
	    		<div class="input-group custom-search-form">
	        		<input type="text" id="search_doc_mobile_number" name="search_doc_mobile_number" class="form-control" placeholder="Mobile Number">
	        		<span class="input-group-btn">
		        		<button class="btn btn-default" id="doctor_search" name="doctor_search" type="button">
		            		<i class="fa fa-search"></i>
		        		</button>
	    			</span>
	    		</div>
    		</div>
    		<br>
        <div class="col-lg-12">
        <div class="row">
            <div id="searched_doctors">
        		<div class="table-responsive">
				<table class="table table-bordered table-striped table">
					<col width="120">
	  				<col width="65">
	  				<col width="120">
	  				<col width="140">
	  				<col width="120">
	  				<col width="100">
	  				<col width="100">
				    <thead>
				    	<tr>
				    		<th>First Name</th>
				    		<th>Middle Name</th>
				    		<th>Last Name</th>
				    		<th>Specialization</th>
				    		<th>Fee</th>
				    		<th>Mobile Number</th>
				    		<th>Actions</th>
				    	</tr>
				    </thead>
				    <tbody>
				    <?php foreach ($doctors as $doctor): ?>
				    	<tr>
				   			<td><?= ucwords(entity_decode($doctor['first_name'])); ?></td>
				   			<td><?= ucwords(strtolower((entity_decode($doctor['middle_name'])))); ?></td>
				   			<td><?= ucwords(entity_decode($doctor['last_name'])); ?></td>
				   			<td><?= ucwords(entity_decode(implode(', ', array_column($doctor['specialization'], 'name')))); ?></td>
				   			<td><?= entity_decode($doctor['fee']); ?></td>
				   			<td><?= entity_decode($doctor['mobile_number']); ?></td>
				   			<td>
				   				<a href="<?= site_url('a/doctor/edit_doctor_lookup') . '/' . $doctor['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="javascript:void(0)" onclick="getModal(<?= $doctor['id']; ?>, 'delete', 'doctor')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
				   				<a href="javascript:void(0)" onclick="getModal(<?= $doctor['id']; ?>, 'view', 'doctor')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
				   			</td>
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
	  		</div>
  			<?= $links ?>
		</div>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
    </div>
<?php endif; ?>
    </div>
</div> <!-- /.row  -->