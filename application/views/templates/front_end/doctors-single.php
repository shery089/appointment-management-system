<!-- Banner Section
================================= -->

<?php foreach ($record as $doctor ): ?>
<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
	<div class="container">
    	<div class="subbanner-content banner-content">
        	<div class="skew-effect fadeInLeft animated">
               	<span class="fw-normal"></span> <?= ucwords(entity_decode($doctor['first_name'])) . ' ' . ucwords(entity_decode($doctor['middle_name'])) . ' ' . ucwords(entity_decode($doctor['last_name'])); ?>
			</div>
        </div>
    </div>
</section>

<!-- // Banner Section
================================= -->

<!-- Doctor Detail Section
================================= -->

<section class="hospital top-bottom-spacing grey-bg">
    	<div class="container">
        	<div class="row">
                 <div class="col-md-10 col-md-pull-1 col-md-push-1">
                    <div class="row clearfix">
                    <div class="col-md-6 marbot40">
                        <div class="grid image-effect2 text-center">
                        	<a href="<?= site_url('f/doctor/doctor_details/' . $doctor['id']) ?>">
                                <figure>
                                    <img src="<?= ADMIN_ASSETS . 'images/doctors/' . entity_decode($doctor['image']); ?>" alt=" " class="img-responsive">
                                    <figcaption><i class="fa flaticon-link-1 gallery-icon transition"></i></figcaption>
                                </figure>
                            </a>                        
                        </div>
                        <div class="panel panel-body marbot0 text-center doctor-details">
                            <h3 class="marbot0"><?= $full_name = ucwords(entity_decode($doctor['first_name'])) . ' ' . ucwords(entity_decode($doctor['middle_name'])) . ' ' . ucwords(entity_decode($doctor['last_name'])); ?></h3>
                            <p class="fontresize marbot20 color-light"><em><span class="fw-500"><?= $specialization = ucwords(entity_decode(implode(', ', array_column($doctor['specialization'], 'name')))); ?> </span></em></p>
                
<!--                 <div class="col-md-4 vertical-middle visible-block-sm-xs text-center animatedParent animateOnce">
                    <a href="<?= site_url('f/appointment/' . $doctor['id']) ?>" class="btn btn-type1-reverse pulse animated"> Make an Appointment</a>
                </div> -->
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="col-md-6 marbot40">
                        <div class="story">
                            <h2 class="marbot20">About <?= $full_name ?></h2>
                            <p class="lead color-light marbot30"><?= $full_name . ' is Specialized in '; ?> <span class="marbot30"><?= $specialization; ?></span>.</p>
                                
                            <!-- <p class="fontresize marbot30">His 20 years of experience enables him to provide excellent care to our residents. Dr. Steve  is a member of the Medical Advisory Board at NJ. He is an expert in SICS (manual phako), Botox, Ptosis, Oculoplasty, Pterygium, DCR surgeries.</p> -->
                            <p class="fontresize text-justify"> <?= implode('<br>', array_map('ucfirst', explode('<br>', stripslashes(str_replace(array('\r\n', '\n\r', '\r', '\n'), '<br>', $doctor['description']))))); ?></p> 
                            <!-- stripslashes(str_replace(array('\r\n', '\n\r', '\r', '\n'), "<br>", $doctor['description']));   -->
                        </div>
                    </div>
                    <!-- Content -->
                    </div>
                </div>
          </div>
        </div>
</section>

<!-- // Doctor Detail Section
================================= -->
<?php endforeach; ?>