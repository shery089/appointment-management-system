<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Schedule"; ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <th>Day</th>
                                <th>Doctor</th>
                                <th>First Shift Start</th>
                                <th>First Shift End</th>
                                <th>Second Shift Start</th>
                                <th>Second Shift End</th>
                                <th>Insert Date</th>
                                <th>Update Date</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $schedule): ?>
	                            <tr>
	                                <td><?= ucwords($schedule['day']); ?></td>
                                    <td><?= ucwords(entity_decode($schedule['doctor']['first_name'])); ?></td>                                    
                                    <td><?= ucwords(entity_decode(stripslashes($schedule['first_shift_start']))); ?></td>
                                    <td><?= ucwords(entity_decode(stripslashes($schedule['first_shift_end']))); ?></td>
                                    <td><?= ucwords(entity_decode(stripslashes($schedule['second_shift_start']))); ?></td>
                                    <td><?= ucwords(entity_decode(stripslashes($schedule['second_shift_end']))); ?></td>
                                    <td><?= ucwords(entity_decode(stripslashes($schedule['insert_date']))); ?></td>
	                                <td><?= ucwords(entity_decode(stripslashes($schedule['update_date']))); ?></td>
	                            </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()"><?= ($url) == 'delete' ? "Cancel" : "Close" ?></button>
                    <?php
                    if($url == 'delete')
                    {
                    ?>
                    	<a href="<?= site_url('a/schedule/delete_schedule_lookup/' . $schedule['id']) ?>" class="btn btn-danger">Delete</a>
                	<?php } ?>
                </div>
            </div>  <!-- end modal-footer -->
                            <?php endforeach ?>
        </div>
</div>  <!--  Delete Modal  -->
<script>
    function closeModel() 
    {
        jQuery('#modal').modal('hide');
        setTimeout(function(){
            jQuery('#modal').remove();
            jQuery('.modal-backdrop').remove();
        },500);
    }
/*	jQuery	(document).ready(function(){
   	 jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>