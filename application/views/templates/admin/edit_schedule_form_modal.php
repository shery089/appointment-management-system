<?php ob_start(); ?>

<!-- Second modal -->
<div id="edit_schedule_form_modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel('#edit_schedule_form_modal')" aria-hidden="true">×</button>
                <?php foreach ($record as $schedule) : ?>
                <h4 class="text-center" id="schedule_updated_msg">Edit Scedule of <?= $schedule['date'] ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            
                            <label class="col-lg-2 control-label" for="day_modal">Date</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['day'] ?>" id="day_modal" readonly disabled/>
                            </div>

                            <label class="col-lg-2 control-label" for="doctor_modal">Doctor</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['doctor']['first_name'] ?>" id="doctor_modal" readonly disabled/>
                            </div>                            
                        </div>                            
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="first_shift_start_modal">First Shift Start</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['first_shift_start'] ?>" id="first_shift_start" readonly />
                            </div>

                            <label class="col-lg-2 control-label" for="first_shift_end_modal">First Shift End</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['first_shift_end'] ?>" id="first_shift_end" readonly />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="second_shift_start_modal">Second Shift Start</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['second_shift_start'] ?>" id="second_shift_start" readonly />
                            </div>
                        <!-- </div> -->

                            <label class="col-lg-2 control-label" for="second_shift_end_modal">Second Shift End</label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?= $schedule['second_shift_end'] ?>" id="second_shift_end" readonly />
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel('#edit_schedule_form_modal')">Close</button>
                    <a class="btn btn-success" onclick="updateSchedule(<?= $schedule['id'] ?>)">Edit</a>
                </div>
            </div>  <!-- end modal-footer -->
        <?php endforeach; ?>
        </div>
    </div>
</div>  <!-- Second modal -->

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
    }
</script>

<?= ob_get_clean(); ?>