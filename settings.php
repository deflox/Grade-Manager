<?php

session_start();

require_once (dirname( __FILE__ ) . '/core/load.php');

check_permissions( array('user','admin'), is_user_logged_in() );

global $lang, $msg;

if ( is_post_submitted() ) {

	if ( isset($_POST['save_user_info'] ) ) {
	
		if ( validate_user_settings_change($_POST) ) {
		
			update_user_info ($_POST);
		
		}
	
	} 
 
	if ( isset($_POST['save_password_change'] ) ) {
		
		if ( validate_user_password_change($_POST) ) {

			update_user_password ($_POST);
		
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

    <title>Settings</title>

    <?php include_once (dirname( __FILE__ ) . '/includes/html/header-scripts.php'); ?>

</head>
<body>

<?php include_once (dirname( __FILE__ ) . '/includes/html/menu.php'); ?>

<div class="container dashboard">

	<p><?php echo $lang->translate('text_logged_in'); ?> <?php echo $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] . ' (' . $_SESSION['user_rights'] . ')'; ?></p>
	
    <h1 class="site-title"><?php echo $lang->translate('title_user_settings'); ?>:</h1>
	
	<?php $msg->get_success_message(); ?>
	<?php $msg->get_error_message(); ?>
	
	<form action="settings.php" method="post">
	
		<div class="form-group">
            <label for="user_email"><?php echo $lang->translate('input_description_email'); ?>:</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo get_post('user_email', $_SESSION['user_email']); ?>">
        </div>
		
		<div class="row">
			
			<div class="col-md-6">
				
				<div class="form-group">
					<label for="user_firstname"><?php echo $lang->translate('input_description_firstname'); ?>:</label>
					<input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?php echo get_post('user_firstname' , $_SESSION['user_firstname']); ?>">
				</div>
				
			</div>
			<div class="col-md-6">
			
				<div class="form-group">
					<label for="user_lastname"><?php echo $lang->translate('input_description_lastname'); ?>:</label>
					<input type="text" class="form-control" id="user_lastname" name="user_lastname" value="<?php echo get_post('user_lastname', $_SESSION['user_lastname']); ?>">
				</div>
			
			</div>
			
		</div>
		
		<div class="row">
			
			<div class="col-md-6">

                <?php echo get_drop_down(array('de_DE' => 'Deutsch (Deutschland)', 'en_US' => 'English (USA)'), 'user_language', $lang->translate('input_description_settings_language') . ':', 'form-control', $_SESSION['user_language']); ?>
				
			</div>
			<div class="col-md-6">

                <?php echo get_drop_down(array('Y-m-d' => 'yyyy-mm-dd', 'Y/m/d' => 'yyyy/mm/dd', 'Y.m.d' => 'yyyy.mm.dd', 'd-m-Y' => 'dd-mm-yyyy', 'd/m/Y' => 'dd/mm/yyyy', 'd.m.Y' => 'dd.mm.yyyy', 'm/d/Y' => 'mm/dd/yyyy'), 'user_date_format', $lang->translate('input_description_settings_date_format') . ':', 'form-control', $_SESSION['user_date_format']); ?>

			</div>
			
		</div>
		
		<input type="submit" class="btn btn-primary btn-right m-t-20" value="<?php echo $lang->translate('btn_save'); ?>" name="save_user_info">
		<div class="clearfix"></div>
		
	</form>
	
	<form action="settings.php" method="post">
		
		<h2><?php echo $lang->translate('title_change_password'); ?>:</h2>
		
		<div class="form-group">
            <label for="user_current_password"><?php echo $lang->translate('input_description_current_password'); ?>:</label>
            <input type="password" class="form-control" id="user_current_password" name="user_current_password">
        </div>
		
		<div class="form-group">
            <label for="user_new_password"><?php echo $lang->translate('input_description_password_new'); ?>:</label>
            <input type="password" class="form-control" id="user_new_password" name="user_new_password">
        </div>
		
		<div class="form-group">
            <label for="user_new_password_repeat"><?php echo $lang->translate('input_description_password_new_repeat'); ?>:</label>
            <input type="password" class="form-control" id="user_new_password_repeat" name="user_new_password_repeat">
        </div>
		
		<input type="submit" class="btn btn-primary btn-right" value="<?php echo $lang->translate('btn_save'); ?>" name="save_password_change">
		<div class="clearfix"></div>
	
	</form>
	
</div>

<?php include_once (dirname( __FILE__ ) . '/includes/html/footer-scripts.php'); ?>

</body>
</html>