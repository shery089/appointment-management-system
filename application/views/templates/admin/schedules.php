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
				<a href="<?= site_url('a/schedule/add_schedule_lookup'); ?>" class="btn btn-primary">Add New</a>
			</div>
    	</div>
    <?php if(!empty($schedules)): ?>
    		<div class="col-lg-4">
				<div class="form-group">
					<input type="text" id="auto_date" name="auto_date" class="form-control" placeholder="Date">
				</div>
			</div>
            <!-- Doctor -->
            <div class="col-md-4">
                <div class="form-group">
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'id'            => 'search_day',
                            'name'          => 'search_day',
                            'title'         => 'Please choose a Day',
                            'data-live-search'  => TRUE                            
                        );

                        $days = array('monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 
                        				'saturday' => 'Saturday', 'sunday' => 'Sunday', );

                        foreach ($days as $day => $value) 
                        {
                            $days_options[$day] = $value;
                        }

                        $selected = $this->input->post('search_day');

                    ?>
                    <?= form_dropdown('search_day', $days_options, $selected, $data); ?>
                </div>
            </div>   
                        
    		<div class="col-lg-4">
    		<!-- <div class="form-group custom-search-form">
    				   	</div> -->
			<div class="input-group custom-search-form">
				<input type="text" id="search_doctor_name" name="search_doctor_name" class="form-control" placeholder="Doctor Name">
	    		<span class="input-group-btn">
	        		<button class="btn btn-default" id="schedule_search" name="schedule_search" type="button">
	            		<i class="fa fa-search"></i>
	        		</button>
				</span>
			</div>
			</div>	
        <div class="col-lg-12">
        <div id="searched_schedules">

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
	                    <td><?= ucwords(entity_decode($schedule['doctor']['first_name'])); ?></td>                                    
			   			<td><?= entity_decode($schedule['date']); ?></td>
			   			<td><?= entity_decode($schedule['first_shift_start']); ?></td>
			   			<td><?= entity_decode($schedule['first_shift_end']); ?></td>
			   			<td><?= entity_decode($schedule['second_shift_start']); ?></td>
			   			<td><?= entity_decode($schedule['second_shift_end']); ?></td>

			   			<td>
			   				<a href="<?= site_url('a/schedule/edit_schedule_lookup') . '/' . $schedule['id']; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="javascript:void(0)" onclick="getModal(<?= $schedule['id']; ?>, 'delete', 'schedule')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
			   				<a href="javascript:void(0)" onclick="getModal(<?= $schedule['id']; ?>, 'view', 'schedule')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
			   			</td>
			   		</tr>
				<?php endforeach; ?>
			    </tbody>
  			</table>
  			<?= $links; ?>
		</div>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
		</div>
  <?php endif; ?>
    </div>

</div> <!-- /.row  -->