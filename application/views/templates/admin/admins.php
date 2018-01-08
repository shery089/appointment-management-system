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
				<a href="<?= site_url('a/admin/add_admin_lookup'); ?>" class="btn btn-primary">Add New</a>
			</div>
     		<?php if(!empty($admins)): ?>
			<table class="table table-bordered table-striped table">
				<col width="100">
  				<col width="100">
  				<col width="100">
  				<col width="200">
  				<col width="110">
  				<col width="90">
  				<col width="90">
  				<col width="110">
			    <thead>
			    	<tr>
			    		<th>First Name</th>
			    		<th>Middle Name</th>
			    		<th>Last Name</th>
			    		<th>Email</th>
			    		<th>Mobile</th>
			    		<th>Address</th>
			    		<th>Joined Date</th>
			    		<th>Updated Date</th>
			    		<th>Actions</th>
			    	</tr>
			    </thead>
			    <tbody>
			    <?php foreach ($admins as $admin): ?>
			    	<tr>
			   			<td><?= ucwords(entity_decode($admin->first_name)); ?></td>
			   			<td><?= ucwords(entity_decode($admin->middle_name)); ?></td>
			   			<td><?= ucwords(entity_decode($admin->last_name)); ?></td>
			   			<td><?= entity_decode($admin->email); ?></td>
			   			<td><?= entity_decode($admin->mobile_number); ?></td>
			   			<td><?= ucwords(entity_decode($admin->address)); ?></td>
			   			<td><?= $admin->joined_date; ?></td>
			   			<td><?= $admin->updated_date; ?></td>
			   			<td>
			   				<a href="a/admin/edit_admin_lookup/<?=  $admin->id; ?>" class="btn btn-sm btn-success actions"><span class="glyphicon glyphicon-pencil"></span></a>
							<a href="javascript:void(0)" onclick="getModal(<?= $admin->id; ?>, 'delete', 'admin')" class="btn btn-sm btn-danger actions"><span class="glyphicon glyphicon-remove-sign"></span></a>
			   				<a href="javascript:void(0)" onclick="getModal(<?= $admin->id; ?>, 'view', 'admin')" class="btn btn-sm btn-info actions"><span class="fa fa-eye"></span></a>
			   			</td>
			   		</tr>
				<?php endforeach; ?>
			    </tbody>
  			</table>
  		<?php endif; ?>
		</div>
		
		<!-- <div class="col-lg-2"></div> -->
		</div>
    </div>

</div> <!-- /.row  -->