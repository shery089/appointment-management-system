    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
			<?php $patients = json_decode($patients, true); ?>	
        	<?php if(!array_key_exists('error_message', $patients[0])): ?>
	    	<div class="table-responsive">
				<table class="table table-bordered table-striped table">
					<col width="120">
	  				<col width="100">
	  				<col width="120">
	  				<col width="140">
	  				<col width="120">
	  				<col width="100">
	  				<col width="100">
	  				<col width="120">
				    <thead>
				    	<tr>
				    		<th>First Name</th>
				    		<th>Middle Name</th>
				    		<th>Last Name</th>
			    			<th>Patient MR-Number</th>
				    		<th>Email</th>
				    		<th>Father Name</th>
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
				   			<td><?= ucwords(entity_decode($patient['email'])); ?></td>
				   			<td><?= ucwords(entity_decode($patient['father_name'])); ?></td>
				   			<td><?= entity_decode($patient['mobile_number']); ?></td>
				   			<td>
				   				<a href="<?= site_url('patient/edit_patient_lookup') . '/' . $patient['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" onclick="getModal(<?= $patient['id']; ?>, 'delete', 'patient')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
				   				<a href="#" onclick="getModal(<?= $patient['id']; ?>, 'view', 'patient')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
				   			</td>
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
			</div>
		</div>
			<?php else: ?>
			<div class="col-lg-12">
				<h4 class="text-center"><?= $patients[0]['error_message']; ?></h4>
			</div>
			<div class="col-lg-12">
				<div class="text-center">
					<!-- <a href="<? //site_url('patient')?>" class="btn btn-default">Go Back</a> -->
				</div>
			</div>
			<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
