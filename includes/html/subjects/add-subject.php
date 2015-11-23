<?php global $lang, $msg; ?>

<?php

if ( is_post_submitted() ) {

    if ( validate_subject_input($_POST) ) {

        insert_subject($_POST);

    }

}

?>

<h1 class="site-title"><?php echo sprintf( $lang->translate('title_add_subject'), get_current_semester_name($_GET['semester'])); ?></h1>

<?php $msg->get_error_message(); ?>

<form action="add.php?type=subject&semester=<?php echo $_GET['semester']; ?>" method="post">

    <input type="hidden" name="semester_id" value="<?php echo $_GET['semester']; ?>">

    <div class="form-group">
        <label for="subject_name"><?php echo $lang->translate('input_description_subject_name'); ?>:</label>
        <input type="text" class="form-control" id="subject_name" name="subject_name" value="<?php echo get_post('subject_name'); ?>">
    </div>

    <div class="row">

        <div class="col-md-6">

            <div class="form-group">
                <label for="subject_counting"><?php echo $lang->translate('input_description_subject_counting'); ?>:</label>
                <input type="text" class="form-control" id="subject_counting" name="subject_counting" value="<?php echo empty(get_post('subject_counting')) ? 1 : get_post('subject_counting'); ?>">
            </div>

        </div>

        <div class="col-md-6">

            <?php echo get_drop_down(array('1' => 'Yes', '0' => 'No'), 'subject_counts_to_average', $lang->translate('input_description_subject_counts') . ':'); ?>

        </div>

    </div>

    <input type="submit" class="btn btn-primary btn-right btn-right" value="<?php echo $lang->translate('btn_add_subject'); ?>">

</form>