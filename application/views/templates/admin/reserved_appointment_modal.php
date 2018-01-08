<?php ob_start(); ?>
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="closeModel()" aria-hidden="true">×</button>
                <h4 class="text-center">Sorry! </h4>
            </div>
            <!-- modal-body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <p class="text-justify col-sm-12"> These appointment times of <?= '<strong style="color: #50AB50">' . ' Dr.' . ucwords($times[0]['doctor_name']) . '</strong>' . ' on ' . '<strong style="color: #50AB50">' . $times[0]['date'] . '</strong>' ?> are already been reserved 
                        <?php foreach ($times as $time): ?>
                            <?php
                                if($time['morning_shift'] != 0)
                                {
                                    $time_array[] = $time['morning_shift'];
                                } 
                                else
                                {
                                    if($time['evening_shift'] != 0)
                                    {
                                        $time_array[] = $time['evening_shift']; 
                                    }
                                }
                                ?>
                        <?php endforeach ?>
                        <?php echo '<strong style="color: red">' . implode(", ", $time_array) . '</strong>' . '.<br>Please select another time or another day. Thanks</p>' ?>
                        </p>
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
alert();
$("#modal").modal({backdrop: "static", toggle: true});

    function closeModel() 
    {
        jQuery('#modal').modal('hide');
        setTimeout(function(){
            jQuery('#modal').remove();
            jQuery('.modal-backdrop').remove();
            $("#modal").remove();
        },500);

        $('#doctor').val('');
        
        $('#morning_shift').val('');
        
        $('#evening_shift').val('');

        // $('#submitted_date_1').val('');
        
        $('#doctor').selectpicker('refresh');
    }
/*	jQuery	(document).ready(function(){
   	 jQuery("#modal").on('hidden.bs.modal', function () {
            alert('The modal is now hidden.');
           }
    }*/
</script>

<?= ob_get_clean(); ?>