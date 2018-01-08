<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Patient"; ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped patient-table">
                            <thead>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Registeration Number</th>
                                <th>Father Name</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th>Diseases</th>
                                <th>Joined Date</th>
                                <th>Updated Date</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $patient): ?>
                                <tr>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['first_name']))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['middle_name']))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['last_name']))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['mr_number']))); ?></td>
                                    <td><?= ucwords(entity_decode($patient['father_name'])); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['mobile_number']))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['email']))); ?></td>
                                    <td><?=  ucwords(entity_decode(implode(', ', array_column($patient['disease'], 'name')))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['joined_date']))); ?></td>
                                    <td><?=  ucwords(entity_decode(stripslashes($patient['updated_date']))); ?></td>
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
                        <a href="<?= site_url('a/patient/delete_patient_lookup/' . $patient['id']) ?>" class="btn btn-danger">Delete</a>
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
/*  jQuery  (document).ready(function(){
     jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>