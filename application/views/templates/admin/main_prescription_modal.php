<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Prescription"; ?></h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped prescription-table">
                            <thead>
                                <th>Patient MR-Number</th>
                                <th>Doctor</th>
                                <th>Visited Date</th>
                                <th>Visited Time</th>
                                <th>Prescription</th>
                                <th>Food</th>
                                <th>Next_visit_date</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $prescription): ?>
	                            <tr>
                                    <td><?= ucwords(entity_decode($prescription['patient_id']['mr_number'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['doctor_id']['first_name'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['visited_date'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['visited_time'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['prescription'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['food'])); ?></td>
                                    <td><?= ucwords(entity_decode($prescription['next_visit_date'])); ?></td>
            	               </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()">Close</button>
                    <?php if($url == 'delete'): ?>
                        <a href="<?= site_url('a/prescription/delete_prescription_lookup/' . $prescription['id']) ?>" class="btn btn-danger">Delete</a>
                    <?php endif; ?>
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
        },100);
    }
/*	jQuery	(document).ready(function(){
   	 jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>