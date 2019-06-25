a/Diet <div id="page-wrapper">
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
		<?php if(!empty($prescriptions)): ?>
    <div class="row">
         		<div class="col-lg-3">
				<div class="form-group">
					<input type="text" id="search_presc_date" name="search_presc_date" class="form-control" placeholder="Visited Date">
				</div>
			</div>
			<div class="col-lg-3">
				<div class="form-group">
					<input type="text" id="search_presc_time" name="search_presc_time" class="form-control" placeholder="Visited Time">
				</div>
			</div>
			<div class="col-lg-3">
    			<div class="form-group custom-search-form">
	       			<input type="text" id="search_doctor_name" name="search_doctor_name" class="form-control" placeholder="Doctor Name">
	   			</div>
    		</div>	
			<div class="col-lg-3">
		    	<div class="input-group custom-search-form">
		       		<input type="text" id="mr_number" name = "data" class="form-control" placeholder="MR-Number">
		       		<span class="input-group-btn">
			       		<button class="btn btn-default" id="presc_search" name="presc_search" type="button">
			           		<i class="fa fa-search"></i>
		        		</button>
	    			</span>
	    		</div>
	   		</div>
	   		<br>
        <div class="col-lg-12">
			<div id="searched_prescriptions">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table">
						<col width="50">
		  				<col width="155">
		  				<col width="90">
		  				<col width="70">
		  				<col width="195">
		  				<col width="195">
		  				<col width="85">
		  				<col width="200">
					    <thead>
					    	<tr>
					    		<th>MR-Number</th>
					    		<th>Doctor</th>
					    		<th>Visited Date</th>
					    		<th>Visited Time</th>
					    		<th>Prescription</th>
					    		<th>Diet</th>
					    		<th>Next Visit Date</th>
					    		<th>Actions</th>
					    	</tr>
					    </thead>
					    <tbody>
					    <?php foreach ($prescriptions as $prescription): ?>
					    	<tr>
					   			<td><?= ucwords(entity_decode($prescription['patient_id']['mr_number'])); ?></td>
					   			<td><?= ucwords(entity_decode($prescription['doctor_id']['full_name'])); ?></td>
					   			<td><?= ucwords(entity_decode($prescription['visited_date'])); ?></td>
					   			<td><?= ucwords(entity_decode($prescription['visited_time'])); ?></td>
					   			<?php $cut_prescription = ucwords(entity_decode($prescription['prescription']));
					   					$cut_prescription = (strlen($cut_prescription) > 40) ? substr($cut_prescription,0,35).'.....' : $cut_prescription;
					   			?>
					   			<td><?= $cut_prescription;?></td>
					   			<?php $cut_food = ucwords(entity_decode($prescription['food']));
				   					$cut_food = (strlen($cut_food) > 40) ? substr($cut_food,0,35).'.....' : $cut_food;
					   			?>
					   			<td><?= $cut_food;?></td>
					   			<?php $date = entity_decode($prescription['next_visit_date']); ?>					   			
					   			<?php $date = ($date == '0000-00-00') ? 'N/A' : entity_decode($prescription['next_visit_date']) ?>
								<td><?= $date ?></td>
					   			<td>
					   				<a title = "Edit Prescription" href="<?= site_url('a/prescription/edit_prescription_lookup') . '/' . $prescription['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
									<a title = "Delete Prescription" href="javascript:void(0)" onclick="getModal(<?= $prescription['id']; ?>, 'delete', 'prescription', 'TRUE')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
					   				<a title = "View Prescription" href="javascript:void(0)" onclick="getModal(<?= $prescription['id']; ?>, 'view', 'prescription', 'TRUE')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
					   				<a title="Print Prescription" href="javascript:void(0)" id="print_prescription_<?= $prescription['id']; ?>" class="btn btn-sm btn-primary actions print-preview"><span class="glyphicon glyphicon-print"></span></a>
					   			</td>
					   		</tr>
						<?php endforeach; ?>
					    </tbody>
		  			</table>
		  			<?= $links; ?>
				</div>
			</div>
		</div>
			<?php endif; ?>
		<!-- <div class="col-lg-2"></div> -->
		</div>
    </div>