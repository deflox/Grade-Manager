<?php

session_start();

require_once (dirname( __FILE__ ) . '/core/load.php');

redirect_if_logged_in();

global $msg, $lang;

if ( is_post_submitted() ) {

    if ( validate_login_input($_POST) ) {

        if ( verify_user_credentials($_POST) ) {

            do_login($_POST);

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

    <title>Login</title>

    <?php include_once (dirname( __FILE__ ) . '/includes/html/header-scripts.php'); ?>

</head>
<body>

<div class="container login">

    <h1><?php echo $lang->translate('title_login'); ?></h1>

    <?php $msg->get_error_message(); ?>

    <form action="index.php" method="post">

        <div class="form-group">
            <label for="user_email"><?php echo $lang->translate('input_description_email'); ?>:</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo get_post('user_email'); ?>">
        </div>

        <div class="form-group">
            <label for="user_password"><?php echo $lang->translate('input_description_password'); ?>:</label>
            <input type="password" class="form-control" id="user_password" name="user_password">
        </div>

        <a href="reset.php"><?php echo $lang->translate('link_forgot_password'); ?></a>
        <input type="submit" value="<?php echo $lang->translate('btn_login'); ?>" class="btn btn-primary btn-right">

    </form>

</div>

<?php include_once (dirname( __FILE__ ) . '/includes/html/footer-scripts.php'); ?>

</body>
</html>