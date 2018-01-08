<?php ob_start(); ?>
<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Sorry!</h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                    <?php $id = array_column($id, 'id');?>
                        <div class="col-sm-12">
                            <p class="text-center">You have already added a prescription to this record</p>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()">Close</button>
                    <a href="<?= site_url('a/prescription/edit_prescription_lookup') . '/' . $id[0]; ?>" class="btn btn-success text-right">Edit</a>
                </div>
            </div>  <!-- end modal-footer -->
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