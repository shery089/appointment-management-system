<?php ob_start(); ?>

<!-- First modal -->
<div id="edit_schedule_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center"></h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php foreach ($date_errors as $date_error => $error): ?>
                                <?php $array_keys = array_keys($date_errors); ?>
                                <?php $last_date = end($array_keys); ?>
                                <?php foreach ($error as $error_value): ?>
                                    <a class="text-center edit_schedule_form_modal_id" id="<?= $error_value['id'] ?>" data-toggle="modal" href="#">
                                        <?php if($date_error == $last_date): ?>
                                            <?= trim($error_value['date']) . '.'; ?>
                                        <?php else: ?>
                                            <?= trim($error_value['date']) . ', '; ?>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-center">These dates are already been scheduled you can edit them by clicking on them. Other dates are been inserted if provided.</div>
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
        localStorage.removeItem('modal');
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

<?= ob_get_clean(); ?>