    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
			<?php $appointments = json_decode($appointments, true); ?>
        	<?php if(!array_key_exists('error_message', $appointments[0])): ?>
	    	<div class="table-responsive">
				<table class="table table-bordered table-responsive table-striped table">
						<col width="40">
		  				<col width="45">
		  				<col width="55">
		  				<col width="50">
		  				<col width="50">
		  				<col width="10">
		  				<!-- <col width="50"> -->
		  				<col width="100">
				    <thead>
				    	<tr>
			    			<th>MR-Number</th>
				    		<th>Doctor</th>
				    		<th>Date</th>
				    		<th>Morning Shift</th>
				    		<th>Evening Shift</th>
				    		<th>Visit Purpose</th>
				    	</tr>
				    </thead>
				    <tbody>
				    <?php foreach ($appointments as $appointment): ?>
				    	<tr>
				   			<td><?= ucwords(entity_decode($appointment['patient_id']['mr_number'])); ?></td>
				   			<td><?= ucwords(entity_decode($appointment['doctor_id']['first_name'])); ?></td>
				   			<td><?= ucwords(entity_decode($appointment['date'])); ?></td>
				   			<?php $cut_visit_purpose = entity_decode($appointment['visit_purpose']); ?>
			   				<?php $cut_visit_purpose = (strlen($cut_visit_purpose) > 30) ? substr($cut_visit_purpose,0,25).'.....' : $cut_visit_purpose;
								$morning_shift = ($appointment['morning_shift']) == 0 ? 'N/A' : $appointment['morning_shift'];
					   			$evening_shift = ($appointment['evening_shift']) == 0 ? 'N/A' : $appointment['evening_shift'];
				   			?>
				   			<td><?= $morning_shift ?></td>
				   			<td><?= $evening_shift ?></td>
				   			<td><?= $cut_visit_purpose;?></td>				   						   		
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
			</div>
		</div>
			<?php else: ?>
			<div class="col-lg-12">
				<h4 class="text-center"><?= $appointments[0]['error_message']; ?></h4>
			</div>
			<div class="col-lg-12">
				<div class="text-center">
					<!-- <a href="<? //site_url('appointment')?>" class="btn btn-default">Go Back</a> -->
				</div>
			</div>
			<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
