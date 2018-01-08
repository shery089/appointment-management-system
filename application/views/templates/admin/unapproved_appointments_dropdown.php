<?php $count = 1 ?>
<?php foreach ($appointments as $appointment): ?>
	<?php if($count <= 3): ?>
	<li>
	    <a id="notify_appt_<?= $appointment['id'] ?>" href="<?= site_url('a/appointment/edit_appointment_lookup/' . $appointment['id']); ?>">
	        <div>
				<i class="fa fa-clock-o fa-fw"></i> Appt date &nbsp; <?= $appointment['date']; ?>
				<?php 
					date_default_timezone_set("Asia/Karachi");

					$inserted_time = new DateTime($appointment['inserted_date']); // string date
					
					$inserted_time->getTimestamp(); // string date
					
					$current_time = new DateTime();

					$current_time->getTimestamp(); // timestamps,  it can be string date too.

					$interval =  $inserted_time->diff($current_time);
				?>
				<span class="pull-right text-muted small">&nbsp; <?= $interval->format("%H hours %i minutes %s seconds"); ?>&nbsp; ago</span>
	        </div>
	    </a>
	    <?php $count++; ?>
	</li>
	<br>
	<li class="divider"></li>
	<?php else: ?>
		<li id="pending_appointments_list">
            <a class="text-center" href="javascript:void(0)">
	            <strong>See All Unapproved Appointments</strong>
    	        <i class="fa fa-angle-right"></i>
        	</a>
        </li>
		<?php break; ?>
	<?php endif; ?>
<?php endforeach ?>