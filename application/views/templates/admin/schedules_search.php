    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
			<?php $schedules = json_decode($schedules, true); ?>
        	<?php if(!array_key_exists('error_message', $schedules[0])): ?>
	    	<div class="table-responsive">
				<table class="table table-bordered table-striped table">
					<col width="150">
	  				<col width="150">
	  				<col width="150">
	  				<col width="150">
	  				<col width="150">
	  				<col width="150">
	  				<col width="150">
	  				<col width="150">
				    <thead>
				    	<tr>
				    		<th>Day</th>
				    		<th>Doctor</th>
				    		<th>Date</th>
				    		<th>First Shift Start</th>
				    		<th>First Shift End</th>
				    		<th>Second Shift Start</th>
				    		<th>Second Shift End</th>
				    		<th>Actions</th>
				    	</tr>
				    </thead>
				    <tbody>
				    <?php foreach ($schedules as $schedule): ?>
				    	<tr>
				   			
				   			<td><?= ucwords(entity_decode($schedule['day'])); ?></td>
		                    <td><?= ucwords(entity_decode($schedule['first_name'])); ?></td>                                    
				   			<td><?= entity_decode($schedule['date']); ?></td>
				   			<td><?= entity_decode($schedule['first_shift_start']); ?></td>
				   			<td><?= entity_decode($schedule['first_shift_end']); ?></td>
				   			<td><?= entity_decode($schedule['second_shift_start']); ?></td>
				   			<td><?= entity_decode($schedule['second_shift_end']); ?></td>

				   			<td>
				   				<a href="<?= site_url('schedule/edit_schedule_lookup') . '/' . $schedule['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" onclick="getModal(<?= $schedule['id']; ?>, 'delete', 'schedule')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
				   				<a href="#" onclick="getModal(<?= $schedule['id']; ?>, 'view', 'schedule')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
				   			</td>
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
			</div>
		</div>
			<?php else: ?>
			<div class="col-lg-12">
				<h4 class="text-center"><?= $schedules[0]['error_message']; ?></h4>
			</div>
			<div class="col-lg-12">
				<div class="text-center">
					<!-- <a href="<? //site_url('appointment')?>" class="btn btn-default">Go Back</a> -->
				</div>
			</div>
			<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
