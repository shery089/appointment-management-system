<?php ob_start(); ?>

<!-- First modal -->
<div id="valid_date_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
    function closeModel(modalId = '#valid_date_modal') 
    {
        jQuery(modalId).modal('hide');
        setTimeout(function(){
            jQuery('#valid_date_modal').remove();
            if(modalId == "#valid_date_modal")
            {
                jQuery('.modal-backdrop').remove();
            }
        },100);
        window.location.replace("<?= site_url('schedule') ?>");
    }
</script>
<script>
    $("#valid_date_modal").load(function()
        {
            localStorage.removeItem('date');
        });
</script>

<?= ob_get_clean(); ?>