<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Appointments"; ?></h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped appointment-table">
                            <col width="80">
                            <col width="80">
                            <col width="60">
                            <col width="60">
                            <col width="55">
                            <col width="190">
                            <col width="100">
                            <thead>
                                <th>Patient MR-Number</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Morning Shift</th>
                                <th>Evening Shift</th>
                                <th>Visit Purpose</th>
                                <th>Inserted Date</th>
                                <th>Updated Date</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $appointment): ?>
	                            <tr>
                                    <td><?= ucwords(entity_decode($appointment['patient_id']['mr_number'])); ?></td>
                                    <td><?= ucwords(entity_decode($appointment['doctor_id']['first_name'])); ?></td>
                                    <td><?= ucwords(entity_decode($appointment['date'])); ?></td>
                                    <?php
                                        $morning_shift = ($appointment['morning_shift']) == 0 ? 'N/A' : $appointment['morning_shift'];
                                        $evening_shift = ($appointment['evening_shift']) == 0 ? 'N/A' : $appointment['evening_shift']; 
                                    ?>
                                    <td><?= $morning_shift; ?></td>                             
                                    <td><?= $evening_shift; ?></td> 
                                    <!-- <td><? //ucwords(entity_decode(implode(', ', array_column($appointment['specialization'], 'name')))); ?></td> -->
                                    <td><?= entity_decode($appointment['visit_purpose']); ?></td>
                                    <td><?= $appointment['inserted_date']; ?></td>
                                    <td><?= $appointment['updated_date']; ?></td>
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
                    <?php
                        if($url == 'delete')
                        {
                        ?>
                            <a href="<?= site_url('a/appointment/delete_appointment_lookup/' . $appointment['id']) ?>" class="btn btn-danger">Delete</a>
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
        },100);
    }
/*	jQuery	(document).ready(function(){
   	 jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>