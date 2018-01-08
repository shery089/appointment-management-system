<?php ob_start(); ?>

<!-- Second modal -->
<?php $appointments = json_decode($appointments, TRUE);?>
<?php if(!empty($appointments)): ?>
<div id="reschedule_form_modal" class="modal fade" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" disabled="disabled" onclick="closeModel('#reschedule_form_modal')" aria-hidden="true">×</button> -->
                <h4 class="text-center" id="reschedule_form_modal_prepend">Edit Scedule of <?= $appointments[0]['date'] ?></h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="form-horizontal"  role="form">
                        <?php foreach ($appointments as $appointment) : ?>
                        <div class="form-group" id="main_<?= $appointment['id'] ?>" >
                            <label class="col-md-1 control-label" for="day_modal">MR #: </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" value="<?= $appointment['mr_number'] ?>" id="day_modal" readonly/>
                            </div>

                            <label class="col-md-1 control-label" for="doctor_modal">Old Time: </label>
                            <div class="col-md-1">
                                <input type="text" class="form-control" value="<?= ($appointment['morning_shift'] == 0) ? $appointment['evening_shift'] : $appointment['morning_shift'] ?>" id="doctor_modal" readonly/>
                            </div>

                            <label class="col-md-2 control-label hidden-lg hidden-md" for="next_visit_date">New Date: </label>
                            <div class="col-md-2">
                                <input type="text" class="form-control next_visit_date" id="next_visit_date" placeholder="New Date" readonly/>
                            </div>

                        <label class="col-md-2 control-label hidden-lg hidden-md" for="new_time">Morning Shift: </label>
                         <div class="col-lg-2">
                            <div class="input-group">
                            <?php

                                $data = array(
                                    
                                    'class'         => 'form-control morning_shift_reschedule',
                                    'name'          => 'morning_shift_reschedule_' . $appointment['id'],
                                    'id'            => 'morning_shift_reschedule_' . $appointment['id'],
                                    'placeholder'   => 'Morning Shift',
                                    'value'         => set_value('morning_shift'),
                                    'title'         => 'Please select a doctor first',
                                    'disabled'      => 'disabled'
                                    
                                );
                            ?>

                            <?= form_input($data); ?>            
                              <span class="input-group-addon">
                                <input type="checkbox" id="morning_shift_reschedule_cb_<?= $appointment['id'] ?>" class="morning_shift_reschedule_cb">
                              </span>
                            </div>
                        </div>

                        <label class="col-md-2 control-label hidden-lg hidden-md" for="new_time">Evening Shift: </label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <?php

                                    $data = array(
                                        
                                        'class'         => 'form-control evening_shift_reschedule',
                                        'name'          => 'evening_shift_reschedule_' . $appointment['id'],
                                        'id'            => 'evening_shift_reschedule_' . $appointment['id'],
                                        'placeholder'   => 'Evening Shift',
                                        'value'         => set_value('evening_shift'),
                                        'title'         => 'Please select a doctor first',
                                        'disabled'      => 'disabled'
                                        
                                    );
                                ?>

                                <?= form_input($data); ?>            
                              <span class="input-group-addon">
                                <input type="checkbox" id="evening_shift_reschedule_cb_<?= $appointment['id'] ?>" class="evening_shift_reschedule_cb">
                              </span>
                            </div>
                            <?= form_error('time'); ?>
                        </div>  

                            <br class="hidden-lg hidden-md">
                            
                            <div class="col-md-1 hidden-xs hidden-sm">
                                <a href="#" onclick="reschedule_save(<?= $appointment['id'] ?>)" class="btn btn-sm btn-info actions save_apt_form_modal"><span class="fa fa-save"></span></a>
                            </div>

                            <div class="col-md-1 hidden-lg hidden-md">
                                <a href="#" onclick="reschedule_save(<?= $appointment['id'] ?>)" class="btn btn-info btn-block actions save_apt_form_modal">Save <span class="fa fa-save"></span></a>
                            </div>
                            
                            <hr class="hidden-lg hidden-md">
                        </div>                            

                        <?php endforeach; ?>
                    </form>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" disabled="disabled" onclick="closeModel('#reschedule_form_modal')">Close</button>
                </div>
            </div>  <!-- end modal-footer -->
        
        </div>
    </div>
</div>  <!-- Second modal -->
<?php endif; ?>

<script>
    function closeModel(modalId = '#reschedule_form_modal') 
    {
        jQuery(modalId).modal('hide');
        setTimeout(function(){
            jQuery('#modal').remove();
            if(modalId == "#reschedule_form_modal")
            {
                jQuery('.modal-backdrop').remove();
            }
        },100);
    }
</script>

<?= ob_get_clean(); ?>