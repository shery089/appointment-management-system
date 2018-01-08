 <div id="page-wrapper">
    <div class="row">
 
	
        <div class="col-lg-12">
				<!-- Form -->
			<?php //validation_errors(); ?>
			<?php foreach ($specialization as $current_specialization): ?>
			<?= form_open('a/disease/edit_disease_lookup/' . $current_specialization->id); ?>
		
			
			<h1 class="page-header text-center">Edit Disease</h1>

		<!-- Specialization -->

		<div class="form-group">
			<label for="disease">Disease: </label>
			<input type="text" class="form-control" id="disease" name="disease" value="<?= ucwords($current_specialization->name); ?>">
		<?= form_error('disease'); ?>
		</div>		

		<!-- Detail -->

		<div class="form-group">
			<label for="detail">Detail: </label>
			<textarea class="form-control textarea" id="detail" name="detail">
				<?= ucwords(entity_decode(stripslashes(stripslashes($current_specialization->detail)))); ?>
			</textarea>
		<?= form_error('detail'); ?>
		</div>
		<div class="form-group text-right">
			<a href="<?= base_url('disease') ?>" class="btn btn-default">Cancel</a>
			<input type="submit" value="Edit" class="btn btn-success">
		</div>
	
	<?php endforeach ?>
	
	</form> 
	<!-- / Form -->
        </div>
    </div>
            
</div> <!-- /.row