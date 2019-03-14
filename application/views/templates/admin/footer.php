        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- JS includes -->

    <!-- jQuery -->  
    <script src="<?= ADMIN_ASSETS ?>bower_components/jquery/dist/jquery.min.js"></script>

	<!-- dist/js/sb-admin-2.js -->
    <script src="<?= ADMIN_ASSETS ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
    <!-- Bootstrap Select -->
    <script src="<?= ADMIN_ASSETS ?>bootstrap-select/dist/js/bootstrap-select.js"></script>
        
 	<!-- Metis Menu Plugin JavaScript -->
    <script src="<?= ADMIN_ASSETS ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>
        
    <!-- Custom Theme JavaScript -->
    <script src="<?= ADMIN_ASSETS ?>dist/js/sb-admin-2.js"></script>
        
    <!-- ckeditor -->
    <script src="<?= ADMIN_ASSETS ?>ckeditor/ckeditor.js"></script>

    <script src="<?= ADMIN_ASSETS ?>timepicki/js/timepicki.js"></script>

    <script src="<?= ADMIN_ASSETS ?>air-datepicker-master/dist/js/datepicker.min.js"></script>

    <!-- Include English language -->
    <script src="<?= ADMIN_ASSETS ?>air-datepicker-master/dist/js/i18n/datepicker.en.js"></script>
    
    <script src="<?= ADMIN_ASSETS ?>fullcalendar-2.9.0/lib/moment.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>fullcalendar-2.9.0/fullcalendar.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>fullcalendar-2.9.0/gcal.js"></script>

    <script src="<?= ADMIN_ASSETS ?>jquery-ui/jquery-ui.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>bower_components/bootstrap/js/transition.js"></script>
    
    <script src="<?= ADMIN_ASSETS ?>bower_components/bootstrap/js/collapse.js"></script>

    <script src="<?= ADMIN_ASSETS ?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>multidatespicker/jquery-ui.multidatespicker.js"></script>
    
    <script src="<?= ADMIN_ASSETS ?>bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>

    <script src="<?= ADMIN_ASSETS ?>jquery-print-preview-plugin-master/src/jquery.print-preview.js"></script>

    <script>
		// CKEDITOR.replace('detail');
        $(window).on('load', function(){
            $('a[id^="print_prescription_"]').on('click', function(){
                var id = $(this).attr('id');
                var id_length = id.length;
                var prescription_id = id.substring(19, id_length);
                printPrescription(prescription_id);
                // window.print();
                // $('#' + id).printPreview({obj2print:'#main'});
            });
        });
    
        function printPrescription(id) 
        {
            var originalContents = $('body').html();

            var controller = "<?= $this->uri->segment(2) ?>";      
            if(controller === 'prescription')   
            {
                jQuery.ajax({
                    url: '/a/' + controller + '/prescription_by_id_lookup/' + id,
                    // method: 'post',
                    // data: data,
                    success: function(data)
                    {
                        $('body').html(data);
                        // var prescription = open(data);
                        // prescription.onload = function(){
                            window.print();
                        // $('body') = html(originalContents);
                        // }
                        window.location.replace("<?= site_url('a/prescription') ?>");
                        // jQuery('body').append(data);
                        // $("#modal").modal({backdrop: "static", toggle: true});
                    },
                    error: function()
                    {
                        alert('Something went wrong!');
                    }
                });

                // var printContents = document.getElementById(divName).innerHTML;
                // document.body.innerHTML = printContents;

                // window.print();
                // document.body.innerHTML = originalContents;
            }
        }
    </script>

	<script>
        function getModal(id = 0, url = '', controller, del_view = '')
        {
            var data = {'id': id, 'url': url, 'del_view': del_view};
            var id = id;
            
            jQuery.ajax({
                url: '/a/' + controller + '/get_modal/' + id,
                method: 'post',
                data: data,
                success: function(data)
                {
                    jQuery('body').append(data);
                    $("#modal").modal({backdrop: "static", toggle: true});
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }
	</script>
        
    <script>    
        $(".doctor_form").submit( function(eventObj) {
            var specializations = jQuery("#specialization").val();
            $('<input>').attr({
                type: 'hidden',
                id: 'submitted_specializations',
                name: 'submitted_specializations',
                value: specializations
            }).appendTo('.doctor_form');                
        });            
    </script>    
    <script>    
        $(".schedule_form").submit( function(eventObj) {
            var day = jQuery("#day").val();
            $('<input>').attr({
                type: 'hidden',
                id: 'submitted_days',
                name: 'submitted_days',
                value: day
            }).appendTo('.schedule_form');                
        });            
    </script>
    <script>    
        $(".patient_form").submit( function(eventObj) {
            var diseases = jQuery("#disease").val();
            $('<input>').attr({
                type: 'hidden',
                id: 'submitted_diseases',
                name: 'submitted_diseases',
                value: diseases
            }).appendTo('.patient_form');                
        });            
    </script>

        <script>    
        $(".appointment_form").submit( function(eventObj) {
            var date = localStorage.getItem("date");
            $('<input>').attr({
                type: 'hidden',
                id: 'submitted_date',
                name: 'submitted_date',
                value: date
            }).appendTo('.appointment_form');                
        });            
    </script>

    <script type="text/javascript"> 

    function time_picker(id, min_hour_value = 8, max_hour_value = 23, start_hour = 08, start_min = 00)
    {
        $(id).timepicki({
            show_meridian:false,
            min_hour_value:min_hour_value,
            max_hour_value:max_hour_value,
            step_size_minutes:15,
            overflow_minutes:true,
            increase_direction:'up',
            start_time: [start_hour, start_min],
            disable_keyboard_mobile: true
        });
    }
    
    function schedule_timepicker(id, defaultHour, minHour = '', maxHour = '')
    {
        $(id).timepicker({showWidge: true, showInputs: false, showMeridian: false , minuteStep: 5, defaultTime: defaultHour + ':00'}).on('changeTime.timepicker', function(e) {    
            var h= e.time.hours;
            var m= e.time.minutes;
/*            if(h === minHour)
            {
                // alert(minHour);
                // minHour = minHour - 1;
                $(id).timepicker('setTime', minHour + ':00');
            }
            else
            {
                $(id).timepicker('setTime', minHour + '0:00');
            }
*/
            // else if( h > maxHour)
            // {
            //     $(id).timepicker('setTime', minHour + ':00');
            // }
          });
    }

    $(document).on('focusin','#first_shift_start', function(){
        $('#first_shift_end').removeAttr('disabled');
        $('#second_shift_start').removeAttr('disabled');
        $('#first_shift_end').val('');
        schedule_timepicker('#first_shift_start', 7);
    });

    $(document).on('focusin','#first_shift_end', function(){
        var parts = $('#first_shift_start').val().split(':');
        var time = parseInt(parts[0]) + 1;
        schedule_timepicker('#first_shift_end', time);
    });

    $(document).on('focusin','#second_shift_start', function(){
        $('#second_shift_end').removeAttr('disabled');
        $('#second_shift_end').val('');
        
        var parts = $('#first_shift_end').val().split(':');
        var time = parseInt(parts[0]);        
        
        var parts = $('#first_shift_start').val().split(':');
        var max_time = parseInt(parts[0]);
        // alert(time);
        schedule_timepicker('#second_shift_start', 16, time, max_time);
    });

    $(document).on('focusin','#second_shift_end', function(){
        var parts = $('#second_shift_start').val().split(':');
        var time = parseInt(parts[0]) + 1;
        schedule_timepicker('#second_shift_end', time , 00, 17);
    });

    // Add Appointment

    $("#time").focus(function(){
        time_picker('#time', 8, 23, 8);
    });

    function schedule_timepicker(id, defaultHour, minHour = '', maxHour = '')
    {
        $(id).timepicker({showWidge: true, showInputs: false, showMeridian: false , minuteStep: 5, defaultTime: defaultHour + ':00'});
    }

    function schedule_timepicker_modal(id, defaultHour, minHour = '', maxHour = '')
    {
        $(id).timepicker({showWidge: true, showInputs: false, showMeridian: false , minuteStep: 5, defaultTime: defaultHour + ':00'}).on('changeTime.timepicker', function(e) {    
            var h= e.time.hours;
            var m= e.time.minutes;
            console.log('current ' + h + 'maxHour ' + maxHour);
            // if(h === minHour)
            // {
            //     // minHour = minHour - 1;
            //     $(id).timepicker('setTime', minHour + ':00');
            // }

            // else
            // {
            //     $(id).timepicker('setTime', minHour + '0:00');
            // }
            // else if( h > maxHour)
            // {
            //     $(id).timepicker('setTime', minHour + ':00');
            // }
          });
    }

    $(document).on('click', '.morning_shift_reschedule_cb', function(){

        var own_id = $(this).attr('id');

        var main_element = $(this).parent().siblings()[0];  

        var id = $(main_element).attr('id');

        var id_length = id.length;
        
        var num = id.substring(25, id_length);
        
        $('#' + id).removeAttr('disabled');

        localStorage.setItem('morning_id', id);

        var to_disable = '#' + 'evening_shift_reschedule_cb_' + num;
        var to_empty = '#' + 'evening_shift_reschedule_' + num;
        
        $('#' + own_id).change(function() {
            if(this.checked) 
            {
                $(to_disable).attr('checked', false);
                to_disable = '#' + 'evening_shift_reschedule_' + num;
                $(to_disable).attr('disabled', true);
                $(to_empty).val('');
            }
        });                    

    });
            
    $(document).on('change','.morning_shift_reschedule_cb', function(){
    
        if (typeof localStorage.getItem('morning_id') !== 'undefined' && localStorage.getItem('morning_id') !== null)
        {
            var id = localStorage.getItem('morning_id');
            $(document).on('click focusin','#' + id, function(){

                var first_shift_start = $('#first_shift_start').val().trim();
                var f_start_split = first_shift_start.split(':');
                
                var first_shift_end = $('#first_shift_end').val().trim();
                var f_end_split = first_shift_end.split(':');
                
                time_picker('#' + id, f_start_split[0], f_end_split[0] - 1, f_start_split[0], f_start_split[1]);

                localStorage.removeItem('morning_id');
                
            });
        }
    });

    $(document).on('click','.evening_shift_reschedule_cb',function(){
                
        var own_id = $(this).attr('id');
        
        var main_element = $(this).parent().siblings()[0];  

        var id = $(main_element).attr('id');

        var id_length = id.length;

        var num = id.substring(25, id_length);

        $('#' + id).removeAttr('disabled');

        localStorage.setItem('evening_id', id);

        var to_disable = '#' + 'morning_shift_reschedule_cb_' + num;
        var to_empty = '#' + 'morning_shift_reschedule_' + num;
                
        $('#' + own_id).change(function() {
            if(this.checked) 
            {
                $(to_disable).attr('checked', false);
                to_disable = '#' + 'morning_shift_reschedule_' + num;
                $(to_disable).attr('disabled', true);
                $(to_empty).val('');
            }
        });     

    $(document).on('change','.evening_shift_reschedule_cb', function(){
    
        if (typeof localStorage.getItem('evening_id') !== 'undefined' && localStorage.getItem('evening_id') !== null)
        {
            var id = localStorage.getItem('evening_id');

            $(document).on('click focus','#' + id, function(){

                var second_shift_start = $('#second_shift_start').val().trim();
                var s_start_split = second_shift_start.split(':');
                
                var second_shift_end = $('#second_shift_end').val().trim();
                var s_end_split = second_shift_end.split(':');
                
                time_picker('#' + id, s_start_split[0], s_end_split[0], s_start_split[0], s_start_split[1])

                localStorage.removeItem('evening_id');

            });   
        }
    });   

    });

    function reschedule_save(id)
    {
        var controller = "<?= $this->uri->segment(2) ?>";      

        if(controller === 'schedule')
        {
            var date = $('#next_visit_date').val();
            var morning_shift = $('#morning_shift_reschedule_' + id).val();
            var evening_shift = $('#evening_shift_reschedule_' + id).val();

            $.ajax({
                url: '/a/appointment/reschedule_appointment_lookup/' + id,
                method: 'post',
                data: {'submitted_date': date, 'morning_shift': morning_shift, 'evening_shift': evening_shift},
                success: function(data)
                {
                    // Create jQuery object from the response HTML.
                    var $response = $(data);

                    //Query the jQuery object for the values
                    var oneval = $response.filter('#error_date_time_modal').text();
     
                    jQuery('body').append(data);

                    $("#error_date_time_modal").modal({backdrop: "static", toggle: true});

                    if(data === 'success')
                    {
                        jQuery('#reschedule_form_modal_prepend').prepend('<div id="schedule_updated" class="alert alert-info fade in">' +
                            'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '</div>');
                                
                        $("#schedule_updated").fadeTo(2000, 500).slideUp(500, function(){
                            $("#schedule_updated").alert('close');
                            $('#main_' + id).css('background-color', '#FF9999');
                            $('#main_' + id).fadeOut(500, function() { $(this).remove(); });
                            var length = $(document).find('div[id^="main_"]').length;
                            if(length === 1)
                            {
                                // "<?= site_url('schedule/reschedule_lookup') ?>"
                                window.location.replace("<?= site_url('a/schedule') ?>");
                            }                   
                        });
                    }
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }
    }   

    // $('.form-group[id^="main_"]').find();

    $("#edit_time").focus(function(){
        var time = $("#edit_time").val();
        time = time.split(':');
        time_picker('#edit_time', 8, 23, time[0], time[1]);
    });

    // Appointment Autocomplete
    
    $(window).on('load', function() {
        $("#auto_time").attr('readonly','readonly');
        time_picker('#auto_time', 08, 23, 08);
    });  
      
    $(window).on('load', function() {
        $("#search_presc_time").attr('readonly','readonly');
        time_picker('#search_presc_time', 08, 23, 08);
    });
    
    $(window).on('load', function() {

        $(document).on('blur', '#dashboard_time', function(){
            
            var dashboard_time = $("#dashboard_time").val();
        });  

        $(document).on('focus','#dashboard_time',function(){
            $("#dashboard_time").attr('readonly','readonly');
            time_picker('#dashboard_time', 08, 23, 08);
        });
    });

    </script>

    <script>

        $(window).on('load', function() {
            $('td[data-date=' + localStorage.getItem('date') + ']').css('background-color', '#6BD9EC'); 
        });
            
/*        $(window).on('load', function() {
            $('td[data-date=' + localStorage.getItem('dashboard_date') + ']').css('background-color', '#6BD9EC'); 
        });*/
            
        $(window).on('load', function() {

            var $sfield = $('#mr_number').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/'); ?>";
                  $.post(url, {mr_number:request.term}, function(mr_number){
                    response($.map(mr_number, function(patient) {
                        return {
                            value: patient.mr_number
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        }); 

        $(window).on('load', function() {

            var $sfield = $('#search_father_name').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/father_autocomplete/'); ?>";
                  $.post(url, {father_name:request.term}, function(father_name){
                    response($.map(father_name, function(patient) {
                        return {
                            value: ucwords(patient.father_name)
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        }); 

        $(window).on('load', function() {

            var $sfield = $('#search_cnic').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/cnic_autocomplete/'); ?>";
                  $.post(url, {search_cnic:request.term}, function(search_cnic){
                    response($.map(search_cnic, function(patient) {
                        return {
                            value: patient.cnic
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        });  

        $(window).on('load', function() {

            var $sfield = $('#search_doctor_name').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/doctor_autocomplete/'); ?>";
                  $.post(url, {search_doctor_name:request.term}, function(search_doctor_name){
                    response($.map(search_doctor_name, function(doctor) {
                        return {
                            value: ucwords(doctor.first_name)             
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        });        

        $(window).on('load', function() {

            var $sfield = $('#search_mobile_number').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/mobile_number_autocomplete/'); ?>";
                  $.post(url, {search_mobile_number:request.term}, function(search_mobile_number){
                    response($.map(search_mobile_number, function(patient) {
                        return {
                            value: ucwords(patient.mobile_number)
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        });

        $(window).on('load', function() {

            var $sfield = $('#search_doc_mobile_number').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/doctor_mobile_number_autocomplete/'); ?>";
                  $.post(url, {search_doc_mobile_number:request.term}, function(search_doc_mobile_number){
                    response($.map(search_doc_mobile_number, function(doctor) {
                        return {
                            value: ucwords(doctor.mobile_number)
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            autofocus: true,

            });
        });        

        $(window).on('load', function() {

            var $sfield = $('#search_doc_specialization').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }   
            },
            source: function(request, response)
            {
                var url = "<?php echo site_url('a/autocomplete/doctor_specialization_autocomplete/'); ?>";
                  $.post(url, {search_doc_specialization:request.term}, function(search_doc_specialization){
                    response($.map(search_doc_specialization, function(specialization) {
                        $('#searched_doc_id').val(specialization.id);
                        return {
                            value: ucwords(specialization.name)

                        };
         
                    }).slice(0, 5));

                  }, "json");
            },

            minLength: 2,
            autofocus: true,

            });
        });

   </script>

    <script>
        function ucwords (str) {

            return (str + '')
            .replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
              return $1.toUpperCase()
            })
            }
    </script>

    <script>
        function updateSchedule(id)
        {    
            var id = id;
            var controller = $('#controller_name').val().trim();
            var first_shift_start = $('#first_shift_start').val().trim();
            var first_shift_end = $('#first_shift_end').val().trim();
            var second_shift_start = $('#second_shift_start').val().trim();
            var second_shift_end = $('#second_shift_end').val().trim();
            $.ajax({
                url: '/a/' + controller  + '/edit_schedule_lookup/' + id,
                method: 'post',
                data: {'id': id, 'ajax': true ,'first_shift_start': first_shift_start, 'first_shift_end': first_shift_end, 
                        'second_shift_start': second_shift_start, 'second_shift_end': second_shift_end},
                success: function(data)
                {
                    jQuery('#schedule_updated_msg').prepend('<div class="alert alert-info fade in">' +
                        'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '</div>')
                    setTimeout(function(){
                        jQuery('#edit_schedule_form_modal').remove();
                    }, 1000);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }
    </script>

    <script>

        // second_popup
        
        $(window).on('load', function() {
            $(document).on('click','.edit_schedule_form_modal_id',function(){
                var id = $(this).attr("id");
                var controller = $('#controller_name').val().trim();
                $.ajax({
                    url: '/a/' + controller  + '/get_modal/' + 'second_popup',
                    method: 'post',
                    data: {'id': id},
                    success: function(data)
                    {
                        jQuery('body').append(data);
                        $("#edit_schedule_form_modal").modal({backdrop: "static", toggle: true});
                    },
                    error: function()
                    {
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>

    <script>
        $(window).on('load', function() {
            $(document).on('focus','#appt_doctor',function(){

            $('#appt_doctor').autocomplete({
            select: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },            
            focus: function( event, ui ) 
            {
                if(ui.item.value === 'No Results Found')
                {
                    ui.item.value = '';
                }
            },
            source: function(request, response)
            {
                var date = localStorage.getItem("dashboard_date");
                var url = "<?php echo site_url('a/autocomplete/get_doctors_lookup'); ?>" + '/' + date;
                  $.post(url, {appt_doctor:request.term}, function(appt_doctor){
                    response($.map(appt_doctor, function(doctor) {
                        return {
                            value: doctor.doctor.first_name
                        };
                    }).slice(0, 5));

                  }, "json");  
            },

            minLength: 2,
            // autofocus: true

            });
        });
        });
    </script>

    <script>
/*    
    function count_pending_appointments()
    {
        $.ajax({
            url: '/a/appointment/get_unapproved_appointments_count_lookup',
            method: 'POST',
            success: function(data)
            {
                jQuery('#notification').html(data);
                // $("#edit_schedule_form_modal").modal({backdrop: "static", toggle: true});
            },
            error: function()
            {
                alert('Something went wrong!');
            }
        });
    }*/
/*    
    function get_pending_appointments()
    {
        $.ajax({
            url: '/a/appointment/get_unapproved_appointments_lookup',
            method: 'POST',
            success: function(data)
            {
                jQuery('#list_appointments').html(data);
            },
            error: function()
            {
                alert('Something went wrong!');
            }
        });
    }*/

    // notification
    // $(window).on('load', function() {
    //     count_pending_appointments();
    //     var delay = 120000; //2 minutes counted in milliseconds.

    //     setInterval(function(){
    //         count_pending_appointments();
    //     }, delay);
    // });
/*
    // pending_appointments
    $(window).on('load', function() {
        $('#pending_appointments').on('click', function(){
            get_pending_appointments();     
        });      
    });    

    // pending_appointments
    $(window).on('load', function() {
        $('.approve_toggle').on('click', function(e){
            e.preventDefault();
            $(this).animate({opacity:0.6});
            $(this).text(function(i, v){
               if (v === 'Approve Appointment')
                {
                    $(this).next().val(1);
                }
                else
                {
                    $(this).next().val(0);
                }
               return v === 'Approve Appointment' ? 'Unapprove Appointment' : 'Approve Appointment'
            }).animate({opacity:1});
        });      
    });*/

// $('.nav a').on('click', function(){
//     $('.btn-navbar').click(); //bootstrap 2.x
//     $('.navbar-toggle').click() //bootstrap 3.x by Richard
// });

    // pending_appointments
    $(window).on('load', function() {
        $('#pending_appointments_list').on('click', function(){
            get_pending_appointments();  
        });      
    });

    </script> 

    <script>
         $(window).on('load', function() {
            $(document).on('submit', '#add_prescription_form',function(e) {
                e.preventDefault();
                var prescription = ($('#prescription').val().length !== 0) ? $('#prescription').val() : '';
                var food = ($('#food').val().length !== 0) ? $('#food').val() : '';
                var next_visit_date = ($('#next_visit_date').val().length !== 10) ? $('#next_visit_date').val() : '';
                var presc_mr_number = jQuery('#presc_mr_number').val();
                var presc_doctor = jQuery('#presc_doctor').val();
                var presc_date = jQuery('#presc_date').val();
                var presc_time = jQuery('#presc_time').val();
                //prescription && food || next_visit_date
                if(1)
                {
                    $.ajax({

                        url: '/a/prescription/add_prescription_lookup/',
                        method: 'post',
                        data: {'prescription': prescription, 'food': food, 'next_visit_date': next_visit_date, 'presc_mr_number': presc_mr_number, 'presc_doctor': presc_doctor, 'presc_date': presc_date, 'presc_time': presc_time},
                        success: function(data)
                        {
                            if(data.length === 0)
                            {

                            jQuery('#prescription_inserted_msg').prepend('<div class="alert alert-info fade in text-center">' +
                                'Prescription has been inserted!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '</div>')
                                setTimeout(function(){
                                    window.location.replace("<?= site_url('a/appointment') ?>");
                                }, 3000);
                            }
                            else
                            {
                                data = jQuery.parseJSON(data);

                                if(data.food.length !== 0)
                                {
                                    jQuery('#food_error').html(data.food);
                                }
                                else
                                {
                                    jQuery('#food_error').html('');                                
                                }

                                if(data.prescription.length !== 0)
                                {
                                    jQuery('#prescription_error').html(data.prescription);
                                }
                                else
                                {
                                    jQuery('#prescription_error').html('');                                
                                }
                                if(data.next_visit_date.length !== 0)
                                {
                                    jQuery('#next_visit_date_error').html(data.next_visit_date);
                                }
                                else
                                {
                                    jQuery('#next_visit_date_error').html('');                                
                                }
                            }
                        },
                        error: function()
                        {
                            alert('Something went wrong!');
                        }
                    });                
                }
                else
                {
                    alert('Not allowed');
                }
            });
          });
</script>

<script>
    function validDate(text) {

        var date = Date.parse(text);

        if (isNaN(date)) 
        {
            return false;
        }

        var comp = text.split('-');

        if (comp.length !== 3) 
        {
            return false;
        }
        var y = parseInt(comp[0], 10);
        var m = parseInt(comp[1], 10);
        var d = parseInt(comp[2], 10);
        var date = new Date(y, m - 1, d);
        return (date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d);
    }

    function timeCheck()
    {
        $("#morning_shift").attr('title', 'Please select an appointment time');
        $('#morning_shift_cb').attr('checked', false);
        $('#evening_shift_cb').attr('checked', false);
        $("#evening_shift").attr('title', 'Please select an appointment time');
        var date = localStorage.getItem("date");
        if (typeof date !== 'undefined' && date !== null)
        {
            if(validDate(date))
            {
                return true;
            }
            else
            {
                setTimeout(function () {
                    $('#date-popup').fadeIn();
                }, 500);
                
                setTimeout(function () {
                    window.location.replace("<?= site_url('a/appointment/add_appointment_lookup') ?>")
                }, 3000);
                
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    function getTime(id, date)
    {
        return $.ajax({

            url: '/a/schedule/get_schedule_by_doc_id_lookup/' + id,
            method: 'post',
            data: {'date': date},

            error: function()
            {
                alert('Something went wrong!');
            }
        });
            return data;
    }


    // function that expects a promise as an argument:
    function displayData(x) 
    {
        x.success(function(realData) 
        {   
            var time = jQuery.parseJSON(realData);
            time = time[0];
            if (typeof time['error'] === 'undefined')
            {
                first_shift_start = time.first_shift_start;
                first_shift_start_parts = first_shift_start.split(':');
                
                first_shift_end = time.first_shift_end;
                first_shift_end_parts = first_shift_end.split(':');
                
                second_shift_start = time.second_shift_start;
                second_shift_start_parts = second_shift_start.split(':');
                
                second_shift_end = time.second_shift_end;
                second_shift_end_parts = second_shift_end.split(':');

                $("#morning_shift").on('click focus mouseover', function() {
                    time_picker('#morning_shift', first_shift_start_parts[0], first_shift_end_parts[0], first_shift_start_parts[0], first_shift_start_parts[1]);
                });

                $("#evening_shift").on('click focus mouseover', function() {
                    time_picker('#evening_shift', second_shift_start_parts[0], second_shift_end_parts[0], second_shift_start_parts[0], second_shift_start_parts[1]);
                });
            }
            else
            {
                setTimeout(function () {
                    $('#date-not-found-popup').fadeIn();
                }, 500);
                setTimeout(function () {
                    window.location.replace("<?= site_url('a/appointment/add_appointment_lookup') ?>")
                }, 5000);
            }
        });
    }



    function doctorCheck()
    {
        var date = (timeCheck()) ? localStorage.getItem("date") : '';        
            if(date.length === 0)
            {
                var date = $('#edit_appt_date').val();        
            }
             
        var id = $('#doctor').val();

        var time_json = getTime(id, date);
            displayData(time_json);
        $("#morning_shift_cb").change(function() {
            if(this.checked) 
            {
                $('#evening_shift').attr('disabled', true);
                $('#morning_shift').attr('disabled', false);
                $('#morning_shift').val('');
                $('#evening_shift').val('');
                $('#evening_shift_cb').attr('checked', false);
            }
        });                    
        $("#evening_shift_cb").change(function() {
            if(this.checked) 
            {
                $('#morning_shift').attr('disabled', true);
                $('#evening_shift').attr('disabled', false);
                $('#morning_shift').val('');                            
                $('#evening_shift').val('');
                $('#morning_shift_cb').attr('checked', false);
            }
        });
    }

</script>

<script>
        
        $(window).on('load', function()
        {  
            var controller = "<?= $this->uri->segment(3) ?>";      
            if(controller === "add_appointment_lookup" || controller === "edit_appointment_lookup")
            {
                var id = $('#doctor').val();
                if(id.length === 0)
                {
                    $('#morning_shift').attr('disabled', true);
                    $('#evening_shift').attr('disabled', true);
                }

                $('#date').on('click', function(){

                    $(document).find('button.btn.dropdown-toggle').removeClass('disabled');
                    $('#doctor').removeAttr('disabled');
                    var id = $('#doctor').val();
                    if(id.length > 0)
                    {
                        if(timeCheck())
                        {
                            var date = localStorage.getItem("date");
                            var time_json = getTime(id, date);
                            displayData(time_json);
                            $('#morning_shift').val('');
                            $('#evening_shift').val('');
                        }
                    }
                });
                
                $('#doctor').on('change', function(){                
                    doctorCheck();
                });
                if($('#doctor').val().length > 0)
                {                
                    doctorCheck();
                }
            }
        });

</script>

<script>
        $(window).on('load', function()
        {
            $("#auto_date").datepicker({dateFormat: 'yy-mm-dd'}).attr('readonly','readonly');
            
            var dateToday = new Date();
            var yrCurrent = dateToday.getFullYear();

            $("#birthday").datepicker({dateFormat: 'yy-mm-dd', changeYear:true, changeMonth: true, minDate: -1893434400 ,maxDate: todayDate(), yearRange : '1910:'+yrCurrent}).attr('readonly','readonly');
            
            $("#search_presc_date").datepicker({dateFormat: 'yy-mm-dd'}).attr('readonly','readonly');
            if($('#schedule_errors').val() !== '' && $('#schedule_errors').val() !== undefined)
            {
                var schedule_errors = $('#schedule_errors').val();
                var schedule_errors = schedule_errors.split(',');
                $('#schedule_date').val('');
                var count = schedule_errors.length;
                var day = [];
                var date = new Date();
                for (var i = 0; i < count; i++) 
                {
                    c_day = schedule_errors[i].split('-');
                    day.push(date.setDate(c_day[2])) + ',' ;
                    
                }
            }

            //Schedule
            $("#schedule_date").multiDatesPicker({dateFormat: 'yy-mm-dd', minDate: 0, maxDate: 6, addDisabledDates: day}).attr('readonly','readonly');


            // Prescription Edit
            $("#edit_next_visit_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0 }).attr('readonly','readonly');
         });

            // Appointment Add Prescription
        $(document).on('click focus','.next_visit_date' ,function() {
            $(".next_visit_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0, maxDate: 6}).attr('readonly','readonly');
        });        

        $(document).on('click focus','#next_visit_date' ,function() {
            $("#next_visit_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0}).attr('readonly','readonly');
        });

    </script>

    <script>
        function searchAppointment(date, time, mr_number)
        {
            $.ajax({

                url: '/a/autocomplete/display_patients/',
                method: 'post',
                data: {'mr_number': mr_number, 'date': date, 'time': time},
                success: function(data)
                {
                    $('#mr_number').val('');
                    $('#auto_time').val('');
                    $('#auto_date').val('');
                    jQuery('#searched_apt').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }        

    </script>

    <script>
        function searchAppointmentByDoctor(doctor, time)
        {
            var date = localStorage.getItem("dashboard_date");
            $.ajax({

                url: '/a/autocomplete/display_appointments/',
                method: 'post',
                data: {'doctor': doctor, 'time': time, 'date': date},
                success: function(data)
                {
                    $('#dashboard_time').val('');
                    $('#appt_doctor').val('');
                    jQuery('#dashboard_results').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }         

        function searchSchedule(date, day, doctor)
        {
            $.ajax({

                url: '/a/autocomplete/display_schedules/',
                method: 'post',
                data: {'day': day, 'date': date, 'doctor': doctor},
                success: function(data)
                {
                    $('#search_day').val('');
                    $('#auto_date').val('');
                    $('#search_doctor_name').val('');
                    jQuery('#searched_schedules').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }      

        $(".alert-dismissable").fadeTo(10000, 500).slideUp(500, function(){
        $(".alert-dismissable").alert('close');
        });

    </script>

    <script>
     
        function searchPatient(mr_number, father_name, mobile_number)
        {
            $.ajax({

                url: '/a/autocomplete/display_patient_by_keys/',
                method: 'post',
                data: {'mr_number': mr_number, 'father_name': father_name, 'mobile_number': mobile_number},
                success: function(data)
                {
                    $('#mr_number').val('');
                    $('#search_father_name').val('');
                    $('#search_mobile_number').val('');
                    jQuery('#searched_patients').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }      
     
        function searchPrescription(date, time, mr_number, doctor_name)
        {
            $.ajax({

                url: '/a/autocomplete/get_prescription_by_keys/',
                method: 'post',
                data: {'date': date, 'time': time, 'mr_number': mr_number, 'doctor_name': doctor_name},
                success: function(data)
                {
                    $('#mr_number').val('');
                    $('#search_presc_date').val('');
                    $('#search_presc_time').val('');
                    $('#search_doctor_name').val('');
                    jQuery('#searched_prescriptions').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }      

        function searchDoctor(specialization, doctor_name, mobile_number)
        {
            $.ajax({

                url: '/a/autocomplete/display_doctor_by_keys/',
                method: 'post',
                data: {'specialization': specialization, 'doctor_name': doctor_name, 'mobile_number': mobile_number},
                success: function(data)
                {
                    $('#search_doctor_name').val('');
                    $('#search_doc_specialization').val('');
                    $('#search_doc_mobile_number').val('');
                    jQuery('#searched_doctors').html(data);
                },
                error: function()
                {
                    alert('Something went wrong!');
                }
            });
        }        

    </script>

    <script>

    $('#appt_search').on('click', function() {

        var mr_number = $('#mr_number').val();
        var date = ($('#auto_date').val().length === 10) ? $('#auto_date').val() : '';
        var time = ($('#auto_time').val().length === 07) ? $('#auto_time').val() : '';
        var mr_number_length = mr_number.length;
        var date_length = date.length;
        var time_length = time.length;

        if(mr_number_length !== 0 && date_length !== 0 && time_length !== 0)
        { 
            searchAppointment(date, time, mr_number);
        }
        else if(mr_number_length !== 0 && date_length !== 0)
        { 
            searchAppointment(date, '', mr_number);
        }
        else if(mr_number_length !== 0 && time_length !== 0)
        { 
            searchAppointment('', time, mr_number);
        }        
        else if(date_length !== 0 && time_length !== 0)
        { 
            searchAppointment(date, time, '');
        }
        else if(date_length !== 0)
        { 
            searchAppointment(date, '', '');
        }
        else if(time_length !== 0)
        { 
            searchAppointment('', time, '');
        }
        else
        {
            if(mr_number_length !== 0)
            { 
                searchAppointment('', '', mr_number);
            }
        }
    });

    $('#schedule_search').on('click', function() {

        var search_day = $('#search_day').val();
        var date = ($('#auto_date').val().length === 10) ? $('#auto_date').val() : '';
        var doctor_name = $('#search_doctor_name').val();
        var search_day_length = search_day.length;
        var date_length = date.length;
        var doctor_name_length = doctor_name.length;

        if(date_length !== 0 && search_day_length !== 0 && doctor_name_length !== 0)
        { 
            searchSchedule(date, search_day, doctor_name);
        }
        else if(date_length !== 0 && search_day_length !== 0)
        { 
            searchSchedule(date, search_day, '');
        }
        else if(date_length !== 0 && doctor_name_length !== 0)
        { 
            searchSchedule(date, '', doctor_name);
        }        
        else if(search_day_length !== 0 && doctor_name_length !== 0)
        { 
            searchSchedule('', search_day, doctor_name);
        }
        else if(date_length !== 0)
        { 
            searchSchedule(date, '', '');
        }
        else if(search_day_length !== 0)
        {
            searchSchedule('', search_day, '');
        }
        else
        {
            if(doctor_name_length !== 0)
            { 
                searchSchedule('', '', doctor_name);
            }
        }
    });
        
    $('#presc_search').on('click', function() {

        var mr_number = $('#mr_number').val();
        var doctor_name = $('#search_doctor_name').val();
        var date = ($('#search_presc_date').val().length === 10) ? $('#search_presc_date').val() : '';
        var time = ($('#search_presc_time').val().length === 07) ? $('#search_presc_time').val() : '';
        var doctor_name_length = doctor_name.length;
        var mr_number_length = mr_number.length;
        var date_length = date.length;
        var time_length = time.length;

        if(mr_number_length !== 0 && date_length !== 0 && time_length !== 0 && doctor_name_length !== 0)
        { 
            searchPrescription(date, time, mr_number, doctor_name);
        } 
        else if(mr_number_length !== 0 && date_length !== 0 && time_length)
        { 
            searchPrescription(date, time, mr_number, '');
        }         
        else if(mr_number_length !== 0 && date_length !== 0 && doctor_name_length)
        { 
            searchPrescription(date, '', mr_number, doctor_name);
        }
        else if(doctor_name_length !== 0 && date_length !== 0 && time_length)
        { 
            searchPrescription(date, time, '', doctor_name);
        } 
        else if(mr_number_length !== 0 && date_length !== 0)
        { 
            searchPrescription(date, '', mr_number, '');
        }
        else if(mr_number_length !== 0 && time_length !== 0)
        { 
            searchPrescription('', time, mr_number, '');
        }          
        else if(mr_number_length !== 0 && doctor_name_length !== 0)
        { 
            searchPrescription('', '', mr_number, doctor_name);
        }        
        else if(date_length !== 0 && time_length !== 0)
        { 
            searchPrescription(date, time, '', '');
        }        
        else if(date_length !== 0 && doctor_name_length !== 0)
        { 
            searchPrescription(date, '', '', doctor_name);
        }        
        else if(doctor_name_length !== 0 && time_length !== 0)
        { 
            searchPrescription('', time, '', doctor_name);
        }        
        else if(doctor_name_length !== 0)
        { 
            searchPrescription('', '', '', doctor_name);
        }        
        else if(date_length !== 0)
        { 
            searchPrescription(date, '', '', '');
        }
        else if(time_length !== 0)
        { 
            searchPrescription('', time, '', '');
        }
        else
        {
            if(mr_number_length !== 0)
            { 
                searchPrescription('', '', mr_number, '');
            }
        }
    });

    $('#patient_search').on('click', function() {
        var mobile_number = $('#search_mobile_number').val();
        var mr_number = $('#mr_number').val();
        var father_name = $('#search_father_name').val();
        var mr_number_length = mr_number.length;
        var mobile_number_length = mobile_number.length;
        var father_name_length = father_name.length;

        if(mr_number_length !== 0 && father_name_length !== 0 && mobile_number_length !== 0)
        { 
            searchPatient(mr_number, father_name, mobile_number);
        }
        else if(mr_number_length !== 0 && father_name_length !== 0)
        { 
            searchPatient(mr_number, father_name, '');
        }        
        else if(mr_number_length !== 0 && mobile_number_length !== 0)
        { 
            searchPatient(mr_number, '', mobile_number);
        }        
        else if(father_name_length !== 0 && mobile_number_length !== 0)
        { 
            searchPatient('', father_name, mobile_number);
        }
        else if(father_name_length !== 0)
        { 
            searchPatient('', father_name, '');
        }            
        else if(mobile_number_length !== 0)
        { 
            searchPatient('', '', mobile_number);
        }
        else
        {
            if(mr_number_length !== 0)
            { 
                searchPatient(mr_number, '', '');
            }
        }
    });

    $('#doctor_search').on('click', function() {
        var mobile_number = $('#search_doc_mobile_number').val();
        var doctor_name = $('#search_doctor_name').val();
        var specialization = $('#search_doc_specialization').val();
        var specialization_length = specialization.length;
        var mobile_number_length = mobile_number.length;
        var doctor_name_length = doctor_name.length;

        if(specialization_length !== 0 && doctor_name_length !== 0 && mobile_number_length !== 0)
        { 
            searchDoctor(specialization, doctor_name, mobile_number);
        }
        else if(specialization_length !== 0 && doctor_name_length !== 0)
        { 
            searchDoctor(specialization, doctor_name, '');
        }        
        else if(specialization_length !== 0 && mobile_number_length !== 0)
        { 
            searchDoctor(specialization, '', mobile_number);
        }        
        else if(doctor_name_length !== 0 && mobile_number_length !== 0)
        { 
            searchDoctor('', doctor_name, mobile_number);
        }
        else if(doctor_name_length !== 0)
        { 
            searchDoctor('', doctor_name, '');
        }            
        else if(mobile_number_length !== 0)
        { 
            searchDoctor('', '', mobile_number);
        }
        else
        {
            if(specialization_length !== 0)
            { 
                searchDoctor(specialization, '', '');
            }
        }
    });

    </script>
    
    <script>

    $(document).on('click','#appt_modal_search' ,function() {

        var doctor = $('#appt_doctor').val();
        var time = ($('#dashboard_time').val().length === 07) ? $('#dashboard_time').val() : '';
        var doctor_length = doctor.length;
        var time_length = time.length;

        if(doctor_length !== 0 && time_length !== 0)
        { 
            searchAppointmentByDoctor(doctor, time);
        }
        else if(doctor_length !== 0)
        { 
            searchAppointmentByDoctor(doctor, '');
        }
        else
        {
            if(time_length !== 0)
            { 
                searchAppointmentByDoctor('', time);
            }
        }
    });

    </script>

    <script>
        window.onbeforeunload = function() {
            localStorage.removeItem('date');
            localStorage.removeItem('dashboard_date');
            $('#edit_appt_date').val('');
    };
    </script>

    <!--  add_schedule_btn -->
    <script>
        $('.schedule_form').on('submit', function(e){
                var empty = 0;
                $('.schedule_form').find("#schedule_date, #doctor, #first_shift_start, #first_shift_end, #second_shift_end, #second_shift_start").filter(function() {
                    if(this.value === "")
                    {
                        empty++;
                    }
                });
                // alert(empty);
                
                if(empty === 0)
                {
                    e.preventDefault();
                    var controller          = $('#controller_name').val().trim();
                    var schedule_date       = $('#schedule_date').val();
                    var doctor              = $('#doctor').val();
                    var first_shift_start   = $('#first_shift_start').val();
                    var first_shift_end     = $('#first_shift_end').val();
                    var second_shift_start  = $('#second_shift_start').val();
                    var second_shift_end    = $('#second_shift_end').val();
                    var schedule_errors    = $('#schedule_errors').val();

                    var data = {'schedule_date': schedule_date, 'doctor': doctor, 'first_shift_start': first_shift_start, 
                    'first_shift_end': first_shift_end, 'second_shift_start': second_shift_start, 'second_shift_end': second_shift_end, 'schedule_errors': schedule_errors};
                    
                    jQuery.ajax({
                        url: '/a/' + controller + '/get_modal/' + 'edit_popup',
                        method: 'post',
                        data: data,
                        success: function(data)
                        {
                            // alert(data);
                            var modal = "<?= $this->session->userdata('modal'); ?>";
                                jQuery('body').append(data);
                                "<?= $this->session->unset_userdata('edit'); ?>";
                                "<?= $this->session->unset_userdata('insert'); ?>";

                            if(modal === 'edit')
                            {
                                $("#edit_schedule_modal").modal({backdrop: "static", toggle: true});
                            }
                            else
                            {
                                $("#inserted_schedule_modal").modal({backdrop: "static", toggle: true});
                            }
                        },
                        error: function()
                        {
                            alert('Something went wrong!');
                        }
                    });
                }
            });
    </script>

    <script>
    function todayDate()
    {
        var today_date = new Date();
        var month = today_date.getMonth()+1;
        var day = today_date.getDate();
        var today_date = today_date.getFullYear() + '-' +
            ((''+month).length < 2 ? '0' : '') + month + '-' +
            ((''+day).length < 2 ? '0' : '') + day;
        return today_date;
    }

    $('#date').fullCalendar({

        dayClick: function(date, jsEvent, view) 
        {

            var clicked_date = date.format();
            
            var today_date = todayDate();

            if(clicked_date < today_date)
            {
                localStorage.removeItem("date");
                getModal(0, '', 'appointment');
            }            
            else
            {
                if( a = $('td').filter('.selected_date'))
                {
                    //console.log($('td').hasClass('selected_date'));
                    a.removeClass('selected_date');
                }
                $(this).addClass('selected_date');

                localStorage.setItem("date", clicked_date);
                
                <!-- // Appointment Date at add_appointment_lookup -->
                $.ajax({

                    url: '/f/appointment/get_doctors_by_date_lookup/' + clicked_date,
                    success: function(data)
                    {
                        $('#doctor').html(data);
                        $('#doctor').selectpicker('refresh');
                    },
                    error: function()
                    {
                        alert('Something went wrong!');
                    }
                });

            }                
        },

        dayRender: function (date, cell) {
            var today_date = new Date();
            var month = today_date.getMonth()+1;
            var day = today_date.getDate();
            var today_date = today_date.getFullYear() + '-' +
                ((''+month).length < 2 ? '0' : '') + month + '-' +
                ((''+day).length < 2 ? '0' : '') + day;

            if (date.format() < today_date) {
                cell.css("background-color", "#68B8E3");
            }
        }
    });

    if($('#edit_appt_date').val() !== undefined)
    {
        if($('#edit_appt_date').val().length === 10)
        {
            $('#date').fullCalendar('select', $('#edit_appt_date').val());
        }
    }


    </script>    

    <script>
    $('#dashboard_date').fullCalendar({
        dayClick: function(date, jsEvent, view) 
        {
            var clicked_date = date.format();
            var today_date = new Date();
            var month = today_date.getMonth()+1;
            var day = today_date.getDate();

            var today_date = today_date.getFullYear() + '-' +
                ((''+month).length < 2 ? '0' : '') + month + '-' +
                ((''+day).length < 2 ? '0' : '') + day;



            if(clicked_date.length === 10)
            {
                localStorage.setItem("dashboard_date", clicked_date);
                getModal(clicked_date, '', 'autocomplete');

                if( a = $('td').filter('.dashboard_selected_date'))
                {
                    a.removeClass('dashboard_selected_date');
                }
                $(this).addClass('dashboard_selected_date');
            }            
        },        
        dayRender: function (date, cell) {
            var today_date = new Date();
            var month = today_date.getMonth()+1;
            var day = today_date.getDate();
            var today_date = today_date.getFullYear() + '-' +
                ((''+month).length < 2 ? '0' : '') + month + '-' +
                ((''+day).length < 2 ? '0' : '') + day;

            if (date.format() < today_date) {
                cell.css("background-color", "#C3D6AA");
            }
    } 
    }); 

    </script>

    <script>
        $(window).on('load', function() {
            var controller = "<?= $this->uri->segment(2) ?>";
            if(controller === 'schedule')
            {
                $('#edit').on('click', function(e) {
                    e.preventDefault();
                    var date = $('#schedule_date').val();
                    var doctor = $('#doctor').val();
                    var first_shift_start = $('#first_shift_start').val();
                    var first_shift_end = $('#first_shift_end').val();
                    var second_shift_start = $('#second_shift_start').val();
                    var second_shift_end = $('#second_shift_end').val();
                    $.ajax({
                        url: '/a/appointment/get_appointments_by_date_lookup/',
                        method: 'post',
                        data: {'date': date, 'doctor': doctor, 'first_shift_start': first_shift_start, 'first_shift_end': first_shift_end,
                                'second_shift_start': second_shift_start, 'second_shift_end': second_shift_end},
                        success: function(data)
                        {
                         if(data === 'No Change')
                         {
                            window.location.replace("<?= site_url('a/schedule'); ?>");
                         }
                         else
                         {
                            jQuery('body').append(data);
                            $("#reschedule_form_modal").modal({backdrop: "static", toggle: true});
                         }
                        },
                        error: function()
                        {
                            alert('Something went wrong!');
                        }
                    });
                });
            }
        });
    </script>

    <script>
    
    // Function to preview image after validation
    $(window).on('load', function()
    {
        $('#loading').hide();
        $("#image").on('change', function() {
            // // $("#message").empty(); // To remove the previous error message
            var file = this.files[0];
            console.log($(this).serialize());
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            var max_size = 10000000;
            var max_size_mb = formatBytes(max_size);
            if(!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
            {
                $('#previewing').attr('src',"<?= ADMIN_ASSETS . 'images/doctors/no_image_600.png' ?>");
                $("#message").html("<p class='image_error'>Please Select A valid Image File</p>"+"<h4 class='image_error'>Note</h4>"+"<span class='image_error'>Only jpeg, jpg and png Images types are allowed!</span>");
                $("#image").css("background-color","#F2003C");
                $("#image").css("color","#FFFFF");
                $("#image").val('');
                
                return false;
            }
            else if(file['size'] > max_size)
            {
                $('#previewing').attr('src',"<?= ADMIN_ASSETS . 'images/doctors/no_image_600.png' ?>");
                $("#message").html("<p class='image_error'>Please Select A valid Image File</p>"+"<h4 class='image_error'>Note</h4>"+"<span class='image_error'>Image size should be less than 10 " + max_size_mb + "!</span>");                
                $("#image").css("background-color","#F2003C");
                $("#image").css("color","#FFFFF");
                $("#image").val('');
            }
            else
            {
                var image = $('#image').val();
                $("#message").empty();
                var reader = new FileReader();
                $('#loading').show();
                reader.onload = imageIsLoaded;
                $('#loading').hide();
                reader.readAsDataURL(this.files[0]);
            }
        });
        });
        function imageIsLoaded(e) {
    $("#image").css("background-color","#8BF1B0");
    $("#image").css("color","#FFFFF");
    // $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    // $('#previewing').attr('width', '250px');
    // $('#previewing').attr('height', '230px');
    };
    
    function formatBytes(bytes,decimals) {
       if(bytes == 0) return '0 Byte';
       var k = 1000;
       var dm = decimals + 1 || 3;
       var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
       var i = Math.floor(Math.log(bytes) / Math.log(k));
       return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    </script>

<footer class="text-center"> AMS Admin v1.0 &copy; 2016</footer>

</body>

</html> 