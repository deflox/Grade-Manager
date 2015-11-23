<?php

session_start();

require_once (dirname( __FILE__ ) . '/core/load.php');

redirect_if_logged_in();

global $msg, $lang;

if ( is_post_submitted() ) {

    if ( validate_reset_password($_POST) ) {

        if ( verify_password_reset($_POST) ) {

            //do_reset($_POST);

        }

    }

}

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Grade Manager - Login</title>

    <link href="includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<div class="container login">

    <h1><?php echo $lang->translate('title_forgot_password'); ?></h1>

    <?php $msg->get_error_message(); ?>

    <form action="reset-password.php" method="post">

        <div class="form-group">
            <label for="user_email"><?php echo $lang->translate('input_description_email'); ?>:</label>
            <input type="email" class="form-control" id="user_email" name="user_email">
        </div>

		<a href="index.php"><?php echo $lang->translate('link_go_login'); ?></a>
        <input type="submit" value="<?php echo $lang->translate('btn_reset'); ?>" class="btn btn-primary btn-right">

    </form>

</div>

<script src="includes/js/jquery.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>

</body>
</html>