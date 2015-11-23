<?php global $lang, $msg; ?>

<?php

if ( is_post_submitted() ) {

    if ( validate_semester_input($_POST) ) {

        insert_semester($_POST);

    }

}

?>

<h1 class="site-title"><?php echo $lang->translate('title_add_semester'); ?></h1>

<?php $msg->get_error_message(); ?>

<form action="add.php?type=semester" method="post">

    <div class="form-group">
        <label for="semester_name"><?php echo $lang->translate('input_description_semester_name'); ?>:</label>
        <input type="text" class="form-control" id="semester_name" name="semester_name" value="<?php echo get_post('semester_name'); ?>">
    </div>

    <input type="submit" class="btn btn-primary btn-right btn-right" value="<?php echo $lang->translate('btn_add_semester'); ?>">

</form>