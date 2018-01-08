<?php ob_start(); ?>
<?php $url = $_POST['url']; ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"><?= ($url) == 'delete' ? "Are You Sure?" : "Disease"; ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <th>Disease</th>
                                <th>Detail</th>
                            </thead>
                            <tbody>
                            <?php foreach ($record as $disease): ?>
	                            <tr>
	                                <td><?=  $disease->name; ?></td>
	                                <td><?=  entity_decode(stripslashes($disease->detail)); ?></td>
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
                    	<a href="<?= site_url('a/disease/delete_disease_lookup/' . $disease->id) ?>" class="btn btn-danger">Delete</a>
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