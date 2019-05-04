<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TLibrary</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Datetimepicker -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
    </head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <h1 style="display: inline"><span class="logo-lg"><b>TL</b>ibrary</span></h1>
        <img width="100" height="100" src="<?php echo site_url('resources/img/1.png');?>" class="user-image" alt="User Image">
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
         <?php
        echo form_open('login', 'class="form-horizontal tasi-form"');
        ?>
        <?php echo form_error('Email', '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>', '</div>'); ?>
        <?php echo form_error('Password', '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>', '</div>'); ?>

        <?php
        if(isset($result_message_success) && $result_message_success != "")
        echo '<div class="alert alert-success" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">success:</span> '.$result_message_success.'</div>';
        else if(isset($result_message_fail) && $result_message_fail != "")
        echo '<div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">invalid add:</span> '.$result_message_fail.'</div>';?>

            <div class="form-group has-feedback">
                <?php
                        $emailData = array(
                        'name' => 'Email',
                        'class' => 'form-control',
                        'placeholder' => 'Email'
                        );
                        echo form_input($emailData);
                ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?php
                        $passwordData = array(
                        'name' => 'Password',
                        'class' => 'form-control',
                        'placeholder' => '******',
                        'style' => '',
                        'value' => ''
                );
                echo form_password($passwordData);
                ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

        <div class="row">
            <div class="col-xs-4 col-md-offset-4">
                <?php
                echo form_submit('login_submit', 'Sign In', "class='btn btn-primary btn-block btn-flat'");
                ?>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
</body>
</html>
