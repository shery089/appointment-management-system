<?php ob_start(); ?>

<!-- Delete modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Appointments</h4>
                <p class="text-center"><?= $date = $_POST['date']; ?></p>
                <a href="<? //site_url('doctor/delete_doctor_lookup/' . $doctor['id']) ?>" class="btn btn-primary">Add New</a>

            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-condensed table-striped doctor-table">
        <div>
            <!-- Patient MR-Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Patient MR-Number: ', 'patient_mr_number'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'             => 'form-control selectpicker',
                            'id'                => 'patient_mr_number',
                            'name'              => 'patient_mr_number',
                            'title'             => 'Please Enter MR-Number',
                            'data-live-search'  => TRUE
                        );

                        foreach ($patients as $patient) 
                        {
                            $patient_mr_number = entity_decode($patient['mr_number']); 
                            $options[$patient_mr_number] = $patient_mr_number;
                        }

                        $selected = $this->input->post('patient_mr_number');

                    ?>
                    <?= form_dropdown('patient_mr_number', $options, $selected, $data); ?>
                    <?= form_error('patient_mr_number'); ?>

  <!-- <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option> -->


                </div>
            </div>  

            <!-- Doctor -->
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Doctor: ', 'doctor'); ?>
                    <?php
                        
                        $data = array(
                            
                            'class'         => 'form-control selectpicker',
                            'id'            => 'doctor',
                            'name'          => 'doctor',
                            'title'         => 'Please choose one',
                        );

                        foreach ($doctors as $doctor) 
                        {
                            $doc_options[$doctor->id] = ucwords(entity_decode($doctor->first_name));
                        }

                        $selected = $this->input->post('doctor');

                    ?>
                    <?= form_dropdown('doctor', $doc_options, $selected, $data); ?>
                    <?= form_error('doctor'); ?>
                </div>
            </div>   
                        
        </div>

                        </div>
                    </div>
                </div>
            </div> <!-- end modal-body -->

            <div class="modal-footer">
                <div>
                    <button type="button" class="btn btn-default" onclick="closeModel()">Close</button>
                </div>
            </div>  <!-- end modal-footer -->
                            <?php //endforeach ?>
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