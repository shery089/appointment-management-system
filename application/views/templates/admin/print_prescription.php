<?php ob_start(); ?>
    <div class="container-fluid">
        <div class="row">
			<div class="col-xs-12">
    		
                <?php $print_prescription = json_decode($print_prescription, TRUE); ?>
                <?php foreach($print_prescription as $prescription): ?>
    		<div class="invoice-title">
    		
    			<h1><img src="<?= ADMIN_ASSETS ?>/images/plus.png" alt="" style="width: 8%; margin-bottom: 1%; margin-right: 1.5%;">John Doe Clinic</h1>
    		
    		</div>
            <div class="my-hr"></div>    		
    		<div class="row">
    			<div class="col-xs-6 text-left">
    				<address>
    				    <h2>Patient Details: </h2>
                        <strong><?= ucwords(entity_decode($prescription['patient_id']['full_name'])); ?> </strong><br><br>
                        <strong>Mr-Number: </strong><p><?= entity_decode($prescription['patient_id']['mr_number']); ?> </p>
                        <strong>Gender: </strong><p><?= ucwords(entity_decode($prescription['patient_id']['gender'])); ?> </p>
                        <strong>Age: </strong><p><?= ageCalculator(entity_decode($prescription['patient_id']['birthday'])) . ' Years'; ?> </p>
                        <p><i class="fa fa-phone">&nbsp;</i><?= entity_decode($prescription['patient_id']['mobile_number']); ?> </p>
                    </address>
    			</div>
    			<div class="col-xs-6 text-right">
                    <address>
                        <h2>Doctor Details: </h2>
                        <?php $full_name = entity_decode($prescription['doctor_id'][0]['first_name']) . ' ' . entity_decode($prescription['doctor_id'][0]['middle_name'])  . ' ' .  entity_decode($prescription['doctor_id'][0]['last_name']); ?>
                        <strong><?= ucwords($full_name); ?> </strong><br><br>
                        <strong>Fee: </strong><p><?= 'Rs. ' . number_format(entity_decode($prescription['doctor_id'][0]['fee'])); ?> </p><br>
                        <strong>Specialization: </strong><p><?= ucwords(entity_decode(implode(', ', array_column($prescription['doctor_id'][0]['specialization'], 'name')))); ?> </p><br>
                    </address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Visited Time:</strong>
    					<p><?= $prescription['visited_time'] . ' (24 hours format)'; ?></p>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
                        <strong>Visited Date:</strong>
                        <p><?= $prescription['visited_date']; ?></p>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary" id="presc_panel">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Prescription</strong></h3>
    			</div>
    			<div class="panel-body">
                    <div class="col-xs-6 text-justify">
                        <address>
                            <strong class="pres_up">Instructions: </strong><br>
                            <p class="pres_hr"><?= ucwords(html_entity_decode($prescription['prescription'], ENT_QUOTES)); ?></p>
                        </address>
                    </div>
                    <div class="col-xs-6 text-justify">
                        <address>
                            <strong class="pull-left pres_up">Diet: </strong><br>
                            <p class="pres_hr"><?= ucwords(html_entity_decode($prescription['food'], ENT_QUOTES)); ?></p>
                        </address>
                    </div>
    			</div>
            </div>
        </div>
    </div>
    <div class="col-xs-6"></div>
    <div class="col-xs-6 text-right">
        <address>
            <strong>Next Visit Date: </strong>
            <?php $date = (entity_decode($prescription['next_visit_date']) == '0000-00-00') ? 'N/A' : entity_decode($prescription['next_visit_date']) ?>
            <p><?= $date ?></p>
        </address>
    </div>

    <?php endforeach; ?>

<?= ob_get_clean(); ?>