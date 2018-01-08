    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
			<?php $prescriptions = json_decode($prescriptions, true); ?>
        	<?php if(!array_key_exists('error_message', $prescriptions[0])): ?>
	    	<div class="table-responsive">
				<table class="table table-bordered table-responsive table-striped table">
					<col width="80">
	  				<col width="80">
	  				<col width="80">
	  				<col width="80">
	  				<col width="230">
	  				<col width="230">
	  				<col width="100">
	  				<col width="120">
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
				   			<td><?= ucwords(entity_decode($prescription['mr_number'])); ?></td>
				   			<td><?= ucwords(entity_decode($prescription['doctor'])); ?></td>
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
				   			<td><?= ucwords(entity_decode($prescription['next_visit_date'])); ?></td>


				   			<td>
				   				<a href="prescription/edit_prescription_lookup/<?=  $prescription['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" onclick="getModal(<?= $prescription['id']; ?>, 'delete', 'prescription')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
				   				<a href="#" onclick="getModal(<?= $prescription['id']; ?>, 'view', 'prescription')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
				   			</td>
				   		</tr>
					<?php endforeach; ?>
				    </tbody>
	  			</table>
			</div>
		</div>
			<?php else: ?>
			<div class="col-lg-12">
				<h4 class="text-center"><?= $prescriptions[0]['error_message']; ?></h4>
			</div>
			<div class="col-lg-12">
				<div class="text-center">
					<!-- <a href="<? //site_url('prescription')?>" class="btn btn-default">Go Back</a> -->
				</div>
			</div>
			<?php endif; ?>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
