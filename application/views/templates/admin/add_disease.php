 <div id="page-wrapper">
    <div class="row">

        <div class="col-lg-12">
				<!-- Form -->
			<?php //validation_errors(); ?>
			<?= form_open('a/disease/add_disease_lookup'); ?>
			<h1 class="page-header text-center">Add A Disease</h1>

		<!-- Specialization -->

		<div class="form-group">
			<label for="disease">Disease: </label>
			<input type="text" class="form-control" id="disease" name="disease" value="<?= ucwords(set_value('disease')); ?>">
		<?= form_error('disease'); ?>
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
			<input type="submit" value="Add" class="btn btn-success">
		</div>
	<?= form_close(); ?>
	<!-- / Form -->
        </div>
    </div>
            
</div> <!-- /.row