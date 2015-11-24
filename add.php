<?php

session_start();

require_once (dirname( __FILE__ ) . '/core/load.php');

check_permissions( array('user','admin'), is_user_logged_in() );

global $lang;

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Add</title>

    <?php include_once (dirname( __FILE__ ) . '/includes/html/header-scripts.php'); ?>

</head>
<body>

<?php include_once (dirname( __FILE__ ) . '/includes/html/menu.php'); ?>

<div class="container dashboard">

    <p><?php echo $lang->translate('text_logged_in'); ?> <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] . ' (' . $_SESSION['user_rights'] . ')'; ?></p>

    <?php get_add_content($_GET) ?>

</div>

<?php include_once (dirname( __FILE__ ) . '/includes/html/footer-scripts.php'); ?>

</body>
</html>