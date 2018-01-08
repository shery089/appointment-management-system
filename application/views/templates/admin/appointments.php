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
					<a href="<?= site_url('a/appointment/add_appointment_lookup'); ?>" class="btn btn-primary">Add New</a>
				</div>
			</div>
			<?php if(!empty($appointments)): ?>
			<!-- <div class="ui-widget"> -->
					<div class="col-lg-4">
						<div class="form-group">
							<input type="text" id="auto_date" name="auto_date" class="form-control" placeholder="Date">
						</div>
					</div>
				<div class="col-lg-4">
					<div class="form-group">
						<input type="text" id="auto_time" name="auto_time" class="form-control" placeholder="Visit Time">
					</div>
				</div>
				<div class="col-lg-4">
		    		<div class="input-group custom-search-form">
		        		<input type="text" id="mr_number" name = "data" class="form-control" placeholder="MR-Number">
		        		<span class="input-group-btn">
			        		<button class="btn btn-default" id="appt_search" name="appt_search" type="button">
			            		<i class="fa fa-search"></i>
			        		</button>
		    			</span>
		    		</div>
	    		</div>
	    		<br>
	    	<!-- </div> -->

        <div class="col-lg-12">
			<div id="searched_apt">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table">
						<col width="80">
		  				<col width="80">
		  				<col width="60">
		  				<col width="60">
		  				<col width="55">
		  				<col width="190">
		  				<col width="100">
					    <thead>
					    	<tr>
					    		<th>MR-Number</th>
					    		<th>Doctor</th>
					    		<th>Visit Date</th>
					    		<th>Morning Shift</th>
					    		<th>Evening Shift</th>
					    		<th>Visit Purpose</th>
					    		<th>Actions</th>
					    	</tr>
					    </thead>
					    <tbody>

					    <?php foreach ($appointments as $appointment): ?>
					    	<tr>
					   			<td><?= ucwords(entity_decode($appointment['patient_id']['mr_number'])); ?></td>
					   			<td><?= ucwords(entity_decode($appointment['doctor_id']['first_name'])); ?></td>
					   			<td><?= ucwords(entity_decode($appointment['date'])); ?></td>
					   			<?php $cut_visit_purpose = ucwords(html_entity_decode($appointment['visit_purpose'], ENT_QUOTES));
					   					$cut_visit_purpose = (strlen($cut_visit_purpose) > 40) ? substr($cut_visit_purpose,0,35).'.....' : $cut_visit_purpose;
					   					$morning_shift = ($appointment['morning_shift']) == 0 ? 'N/A' : $appointment['morning_shift'];
					   					$evening_shift = ($appointment['evening_shift']) == 0 ? 'N/A' : $appointment['evening_shift'];
					   			?>
					   			<td><?= $morning_shift; ?></td>					   			
					   			<td><?= $evening_shift; ?></td>					   			
					   			<td><?= $cut_visit_purpose;?></td>					   			
					   			<td>
					   				<a href="<?= site_url('a/appointment/edit_appointment_lookup') . '/' . $appointment['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="javascript:void(0)" onclick="getModal(<?= $appointment['id']; ?>, 'delete', 'appointment')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
					   				<a href="javascript:void(0)" onclick="getModal(<?= $appointment['id']; ?>, 'view', 'appointment')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
					   				<a href="javascript:void(0)" onclick="getModal(<?= $appointment['id']; ?>, 'add', 'prescription')" class="btn btn-sm btn-primary actions"><span class="fa fa-file-text-o"></span></a>
					   			</td>
					   		</tr>
						<?php endforeach; ?>
					    </tbody>
		  			</table>
		  			<?= $links ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
    </div>