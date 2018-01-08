<!-- Banner Section
================================= -->

<section class="animatedParent animateOnce subbanner subbanner-image subbanner-pattern-03 subbanner-type-2 subbanner-type-2-btn">
    	<div class="container">
        	<div class="subbanner-content banner-content">
            	<div class="skew-effect fadeInLeft animated">
                   	<span class="fw-normal"> Thank You!</span> &nbsp; Your Appointment has been Scheduled.
				</div>
            </div>
        </div>
</section>

<!-- // Banner Section
================================= -->

<!-- Content 
================================================== -->

<section class="top-bottom-spacing grey-bg">
    	<div class="container">
        	<div class="row marbot10 animatedParent animateOnce">
          <!-- Left Content -->
            	<div class="col-md-8 faq-question marbot30 fadeInLeft animated">
                    <?php foreach ($result as $appointment): ?>
                    <?php if($this->uri->segment(3) !== 'add_appointment_old_lookup'): ?>
                        <p class="text-center">Your Appointment Date is  <?= $appointment['date'] ?>&nbsp; in <?= ($appointment['morning_shift'] != 0) ? ' Morning Shift ' . $appointment['morning_shift'] : ' Evening Shift ' . $appointment['evening_shift']?>&nbsp; <br> Your MR-Number is <?= $appointment['patient_id']['mr_number'] ?>&nbsp; save it for future usage!.</p><br>
                    <?php else: ?>
                        <p class="text-center">Your Appointment Date is  <?= $appointment['date'] ?>&nbsp; in <?= ($appointment['morning_shift'] != 0) ? ' Morning Shift ' . $appointment['morning_shift'] : ' Evening Shift ' . $appointment['evening_shift']?></p><br>
                    <?php endif; ?>
                        <p class="text-center">Please be on time and feel free to contact us on our phone number</p>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
</section>

<!-- // Content 
================================================== -->
