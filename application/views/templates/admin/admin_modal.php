<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Admin"; ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped admin-table">
                            <thead>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Joined Date</th>
                                <th>Updated Date</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $admin): ?>
	                            <tr>
                                    <td><?=  entity_decode(stripslashes($admin->first_name)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->middle_name)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->last_name)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->email)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->mobile_number)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->address)); ?></td>
                                    <td><?=  entity_decode(stripslashes($admin->joined_date)); ?></td>
	                                <td><?=  entity_decode(stripslashes($admin->updated_date)); ?></td>
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
                    	<a href="<?= site_url('admin/delete_admin_lookup/' . $admin->id) ?>" class="btn btn-danger">Delete</a>
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