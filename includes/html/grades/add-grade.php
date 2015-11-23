<?php global $lang, $msg; ?>

<?php

if ( is_post_submitted() ) {

    if ( validate_grade_input($_POST) ) {

        insert_grade($_POST);

    }

}

?>

<h1 class="site-title"><?php echo sprintf( $lang->translate('title_add_grade'), get_subject_name($_GET['subject'])); ?></h1>

<?php $msg->get_error_message(); ?>

<form action="add.php?type=grade&semester=<?php echo $_GET['semester']; ?>&subject=<?php echo $_GET['subject']; ?>" method="post">

    <input type="hidden" name="semester_id" value="<?php echo $_GET['semester']; ?>">
    <input type="hidden" name="subject_id" value="<?php echo $_GET['subject']; ?>">

    <div class="form-group">
        <label for="grade_name"><?php echo $lang->translate('input_description_grade_name'); ?>: *</label>
        <input type="text" class="form-control" id="grade_name" name="grade_name" value="<?php echo get_post('grade_name'); ?>">
    </div>

    <div class="row">

        <div class="col-md-4">

            <div class="form-group">
                <label for="grade_value"><?php echo $lang->translate('input_description_grade_value'); ?>: *</label>
                <input type="text" class="form-control" id="grade_value" name="grade_value" value="<?php echo get_post('grade_value'); ?>">
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="grade_counting"><?php echo $lang->translate('input_description_grade_counting'); ?>: *</label>
                <input type="text" class="form-control" id="grade_counting" name="grade_counting" value="<?php echo empty(get_post('grade_counting')) ? 1 : get_post('grade_counting'); ?>">
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="grade_date"><?php echo $lang->translate('input_description_grade_date'); ?>:</label>
                <input type="text" class="form-control" id="grade_date" name="grade_date" value="<?php echo get_post('grade_date'); ?>" placeholder="<?php echo $_SESSION['user_date_format_nice']; ?>">
            </div>

        </div>

    </div>

    <div class="form-group">
        <label for="grade_description"><?php echo $lang->translate('input_description_grade_description'); ?>:</label>
        <textarea class="form-control default-textarea" id="grade_description" name="grade_description"><?php echo get_post('grade_description'); ?></textarea>
    </div>

    <input type="submit" class="btn btn-primary btn-right btn-right" value="<?php echo $lang->translate('btn_add_grade'); ?>">

</form>