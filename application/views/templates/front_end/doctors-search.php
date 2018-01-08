
<!-- <div class="col-lg-6">
</div> -->
<!-- Doctors List Section
================================= -->

<section class="top-bottom-spacing grey-bg">
<div id="searched_doctors">
<?php $doctors = json_decode($doctors, TRUE);?>
<?php if(!array_key_exists('error_message', $doctors[0])): ?>
    <?php foreach ($doctors as $doctor): ?>     
    <div class="container">
        <div class="clearfix marbot10 animatedParent animateOnce" data-sequence='250'>
            <div class="row">
                <div class="col-md-4 marbot30 fadeInRight animated" data-id='<?= entity_decode($doctor['id']); ?>'>
                    <div class="text-center">
                        <div class="grid image-effect2">
                            <a href="<?= site_url('f/doctor/doctor_details/' . $doctor['id']) ?>">
                                <figure>
                                    <img style="height: 360px;" src="<?= ADMIN_ASSETS . 'images/doctors/' . entity_decode($doctor['image']); ?>" alt=" " class="img-responsive img-rounded">
                                    <figcaption><i class="fa flaticon-link-1 gallery-icon transition"></i></figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="panel panel-body marbot0 clearfix doctor-details">
                            <h3 class="marbot0"><?= ucwords(entity_decode($doctor['first_name'])) . ' ' . ucwords(entity_decode($doctor['middle_name'])) . ' ' . ucwords(entity_decode($doctor['last_name'])); ?></h3>
                            <p class="fontresize marbot10 color-light"><em> <span class="fw-500"><?= ucwords(entity_decode($doctor['specialization'])); ?></span> </em></p>
   <!--                          <ul class="social-icons-simple social-bg-grey clearfix">
                                <div class="col-md-4 vertical-middle visible-block-sm-xs text-center animatedParent animateOnce">
                                    <a href="<?= site_url('f/appointment/appointment_by_id_lookup')  . '/' .  $doctor['id'] ?> class="btn btn-type1-reverse pulse animated"> Make an Appointment</a>
                                </div>
                            </ul> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
       <?php else: ?>
       <div class="col-lg-12">
            <h4 class="text-center"><?= $doctors[0]['error_message']; ?></h4>
        </div>
    </div>
<?php endif; ?>
</div>
</section>


<!-- // Doctors List Section
================================= -->