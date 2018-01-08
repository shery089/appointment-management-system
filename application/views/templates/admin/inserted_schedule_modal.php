<?php ob_start(); ?>

<!-- First modal -->
<div id="inserted_schedule_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Success</h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">Schedule has been added!</div>
                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()">Close</button>
                </div>
            </div>  <!-- end modal-footer -->
        </div>
    </div>
</div>  <!-- First modal -->

<script>
    function closeModel(modalId = '#edit_schedule_modal') 
    {
        jQuery(modalId).modal('hide');
        setTimeout(function(){
            jQuery('#modal').remove();
            if(modalId == "#edit_schedule_modal")
            {
                jQuery('.modal-backdrop').remove();
            }
        },100);
        window.location.replace("<?= site_url('a/schedule') ?>");
    }
</script>
<script>
    $( "#edit_schedule_modal").load(function()
        {
            localStorage.setItem('modal', 'schedule');
        });
</script>

<?= ob_get_clean(); ?>