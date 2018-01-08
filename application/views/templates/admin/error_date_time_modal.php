<?php ob_start(); ?>

<script>
    $('.save_apt_form_modal').on('click', function(){
        alert();
    });
    // localStorage.setItem("reschedule_appt_modal", "error");
</script>

<!-- Delete modal -->
<div id="error_date_time_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Error!</h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">Please provide both date and time!</p>
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
</div>  <!--  Delete Modal  -->
<script>
    function closeModel() 
    {
        jQuery('#error_date_time_modal').modal('hide');
        setTimeout(function(){
            jQuery('#error_date_time_modal').remove();
            // jQuery('.modal-backdrop').remove();
        },100);
    }
/*	jQuery	(document).ready(function(){
   	 jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>