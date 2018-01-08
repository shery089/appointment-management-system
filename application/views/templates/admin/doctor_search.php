    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
			<?php $doctors = json_decode($doctors, true); ?>	
        	<?php if(!array_key_exists('error_message', $doctors[0])): ?>
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
				    		<th>Mobile Number</th>
				    		<th>Fee</th>
				    		<th>Specialization</th>
				    		<th>Actions</th>
				    	</tr>
				    </thead>
				    <tbody>
				    <?php foreach ($doctors as $doctor): ?>
				    	<tr>
				   			<td><?= ucwords(entity_decode($doctor['first_name'])); ?></td>
				   			<td><?= ucwords(entity_decode($doctor['middle_name'])); ?></td>
				   			<td><?= ucwords(entity_decode($doctor['last_name'])); ?></td>
				   			<td><?= entity_decode($doctor['mobile_number']); ?></td>
				   			<td><?= ucwords(entity_decode($doctor['fee'])); ?></td>
				   			<td><?= ucwords(entity_decode($doctor['specialization'])); ?></td>
				   			<td>
				   				<a href="<?= site_url('doctor/edit_doctor_lookup') . '/' . $doctor['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" onclick="getModal(<?= $doctor['id']; ?>, 'delete', 'doctor')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
				   				<a href="#" onclick="getModal(<?= $doctor['id']; ?>, 'view', 'doctor')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
			   				</td>
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
			</div>
		</div>
			<?php else: ?>
			<div class="col-lg-12">
				<h4 class="text-center"><?= $doctors[0]['error_message']; ?></h4>
			</div>
			<div class="col-lg-12">
				<div class="text-center">
					<!-- <a href="<? //site_url('doctor')?>" class="btn btn-default">Go Back</a> -->
				</div>
			</div>
			<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
