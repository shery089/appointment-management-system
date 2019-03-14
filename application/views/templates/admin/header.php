    <?php  
    if(!$this->session->userdata['logged_in'])
    {
        redirect('/a/login/');
    }

?>
<!DOCTYPE html>
<html lang="en" moznomarginboxes='' mozdisallowselectionprint=''>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $layout_title ?></title>

    <?php //$this->layouts->print_css_includes(); ?>

    <!-- CSS includes -->
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- MetisMenu CSS -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bower_components/metisMenu/dist/metisMenu.min.css">
    
    <!-- Bootstrap Select -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bootstrap-select/dist/css/bootstrap-select.css">

    <!-- Timeline CSS -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>dist/css/timeline.css">
        
    <!-- Custom CSS -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>dist/css/sb-admin-2.css?v1">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?= ADMIN_ASSETS ?>timepicki/css/timepicki.css"/>
    
    <link href="<?= ADMIN_ASSETS ?>fullcalendar-2.9.0/fullcalendar.min.css" rel="stylesheet" type="text/css">
    
    <link href="<?= ADMIN_ASSETS ?>fullcalendar-2.9.0/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print">

    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>jquery-ui/jquery-ui.min.css">
    
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    
    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>bootstrap-timepicker/css/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href= "<?= ADMIN_ASSETS ?>jquery-print-preview-plugin-master/src/css/print-preview.css" media="print">
        
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</script>

</head>

<body>
    
    <div id="wrapper">
    
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url('a/dashboard') ?>">AMS Admin v1.0</a> <!--  - Appointment Management System -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?= site_url('a/login/logout_lookup'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->