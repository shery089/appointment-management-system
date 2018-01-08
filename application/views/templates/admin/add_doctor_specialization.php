 <div id="page-wrapper">
    <div class="row">

        <div class="col-lg-12">
				<!-- Form -->
			<?= form_open('a/doctor_specialization/add_doctor_specialization'); ?>
			<h1 class="page-header text-center">Add A Doctor Specialization</h1>

		<!-- Specialization -->

		<div class="form-group">
			<label for="specialization">Specialization: </label>
			<input type="text" class="form-control" id="specialization" name="specialization" value="<?= ucwords(set_value('specialization')); ?>">
		<?= form_error('specialization'); ?>
		</div>		

		<!-- Detail -->

		<div class="form-group">
			<label for="detail">Detail: </label>
			<textarea class="form-control textarea" id="detail" name="detail">
				<?= ucwords(set_value('detail')); ?>
			</textarea>
		<?= form_error('detail'); ?>
		</div>
		<div class="form-group text-right">
			<a href="<?= base_url('doctor_specialization') ?>" class="btn btn-default">Cancel</a>
			<input type="submit" value="Add" class="btn btn-success">
		</div>
	<?= form_close(); ?>
	<!-- / Form -->
        </div>
    </div>
            
</div> <!-- /.row