<?php ob_start(); ?>

<!-- Prescription modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Add Prescription</h4>

            </div>
            <!-- modal-body -->
            <div class="modal-body" id="prescription_inserted_msg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php foreach ($record as $appointment): ?> 
                            <div class="form-group col-lg-3">
                                <label for="presc_mr_number">MR-Number: </label>
                                <input type="text" value="<?= ucwords(entity_decode($appointment['patient_id']['mr_number'])); ?>" class="form-control" readonly>
                                <input type="hidden" id="presc_mr_number" name="presc_mr_number" value="<?= ucwords(entity_decode($appointment['patient_id']['id'])); ?>" class="form-control" readonly>                            
                            </div>                        
                            <div class="form-group col-lg-3">
                                <label for="presc_doctor">Doctor: </label>
                                <input type="text" value="<?= ucwords(entity_decode($appointment['doctor_id']['first_name'])); ?>" class="form-control" readonly>                            
                                <input type="hidden" id="presc_doctor" name="presc_doctor" value="<?= ucwords(entity_decode($appointment['doctor_id']['id'])); ?>" class="form-control" readonly> 
                            </div>                        
                            <div class="form-group col-lg-3">
                                <label for="presc_date">Visit Date: </label>
                                <input type="text" id="presc_date" name="presc_date" value="<?= entity_decode($appointment['date']); ?>" class="form-control" readonly>
                            </div>                        
                            <div class="form-group col-lg-3">
                                <label for="presc_time">Visit Time: </label>
                                <?php $time = ($appointment['morning_shift'] == 0) ? $appointment['evening_shift'] : $appointment['morning_shift']; ?>
                                <input type="text" id="presc_time" name="presc_time" value="<?= entity_decode($time); ?>" class="form-control" readonly>
                            </div>
                        <?php endforeach; ?>
                        <!-- Prescription -->
                        <?= form_open('prescription/add_prescription_lookup/', 'id="add_prescription_form"'); ?>

                        <div class="form-group col-lg-4">
                            <?= form_label('Prescription: ', 'prescription'); ?>
                            <?php

                                $data = array(
                                    
                                    'class'         => 'form-control textarea',
                                    'id'            => 'prescription',
                                    'name'          => 'prescription',
                                    'value'         =>  ucwords(set_value('prescription'))
                                );
                            ?>
                            <?= form_textarea($data); ?>
                            <div id="prescription_error"></div>

                        </div>                        
                        <div class="form-group col-lg-4">
                            <?= form_label('Diet: ', 'food'); ?>
                            <?php

                                $data = array(
                                    
                                    'class'         => 'form-control textarea',
                                    'id'            => 'food',
                                    'name'            => 'food',
                                    'value'         =>  ucwords(set_value('food'))
                                );
                            ?>
                            <?= form_textarea($data); ?>
                            <div id="food_error"></div>

                        </div>

                        <div class="form-group col-lg-4">
                            <div class="form-group">
                                <label for="next_visit_date">Next Visit Date: </label>
                                <input type="text" id="next_visit_date" name="next_visit_date" class="form-control" placeholder="Next Visit Date">
                            </div>
                        </div>
                        <div id="next_visit_date_error"></div>                        
                       
                        <div class="form-group col-lg-4">
                            <div class="form-group">
                                <input type="submit" value="Add" id="add_prescription" class="btn btn-success btn-block pull-right">
                                <br>
                            </div>
                        </div>

                    <?= form_close(); ?>
                    </div>
                    </div>
                </div>

            </div> 

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()">Close</button>
                </div>
            </div>  <!-- end modal-footer -->
                            
        </div> <!-- end modal-body -->
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


</script>

<?= ob_get_clean(); ?>