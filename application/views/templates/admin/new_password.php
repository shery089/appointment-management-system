<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= ADMIN_ASSETS; ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= ADMIN_ASSETS; ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= ADMIN_ASSETS; ?>dist/css/sb-admin-2.css?v1" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= ADMIN_ASSETS; ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Password</h3>
                    </div>
                            <?php if($this->session->flashdata('email_not_found')): ?>
            <p style="margin-left: 16px; margin-right: 16px;" class="alert alert-danger alert-dismissable fade in text-center top-height">
                <?= $this->session->flashdata('email_not_found');  ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </p>
                <?php endif; ?>
                    <div class="panel-body">
                        <?= form_open('a/admin/new_password/','role="form"'); ?>
                        <form>
                            <?= form_fieldset(); ?>
                                <div class="form-group">
                                    <?php 
                                        $data = array(
                                            'name'          => 'password',
                                            'id'            => 'password',
                                            'placeholder'   => 'Password',
                                            'class'         => 'form-control',
                                            'autofocus'     => 'autofocus',
                                            'style'         => 'padding: 20px;'
                                        );
                                    ?>
                            
                                <?= form_password($data); ?>
                                <?= form_error('password') ?>
                                    <input type="hidden" name="token" value="<?= bin2hex(openssl_random_pseudo_bytes(32)); ?>">
                                </div>                                

                                <div class="form-group">
                                    <?php 
                                        $data = array(
                                            'name'          => 'confirm_password',
                                            'id'            => 'confirm_password',
                                            'placeholder'   => 'Confirm Password',
                                            'class'         => 'form-control',
                                            'autofocus'     => 'autofocus',
                                            'style'         => 'padding: 20px;'
                                        );
                                    ?>
                            
                                <?= form_password($data); ?>
                                <?= form_error('confirm_password') ?>
                                </div>
                                    <?php 
                                        $data = array(
                                            'name'          => 'recover_password',
                                            'class'          => 'btn btn-lg btn-block',
                                            'value'          => 'Recover Password',
                                            'style'         => 'background: #1B96FE; color: #ffffff'
                                        );
                                    ?>
        
                                    <?= form_submit($data); ?>
                            <?= form_fieldset_close(); ?>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= ADMIN_ASSETS; ?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= ADMIN_ASSETS; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?= ADMIN_ASSETS; ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?= ADMIN_ASSETS; ?>dist/js/sb-admin-2.js"></script>

</body>

</html>
