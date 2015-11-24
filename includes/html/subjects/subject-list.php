<?php global $lang, $msg; ?>

<h1 class="site-title">
    <?php echo sprintf($lang->translate('title_subjects'), get_current_semester_name($_GET['semester']) ); ?>
    <a href="add.php?type=subject&semester=<?php echo $_GET['semester'] ?>">
        <button class="btn btn-success btn-right">
            <?php echo $lang->translate('btn_add_subject'); ?>
        </button>
    </a>
</h1>

<?php $msg->get_success_message(); ?>

<?php $subjects = get_subjects_for_semester($_GET['semester']) ?>

<?php if ( $subjects !== null ): ?>

    <?php foreach ( $subjects as $subject ): ?>

        <a href="dashboard.php?semester=<?php echo $_GET['semester']; ?>&subject=<?php echo $subject['subject_id']; ?>">
            <div class="list-item">
                <h3><?php echo $subject['subject_name']; ?> <small><?php echo $subject['subject_average']; ?></small></h3>
                <div class="tool-buttons hide">
                    <a href="edit.php?type=subject&semester=<?php echo $_GET['semester']; ?>&subject=<?php echo $subject['subject_id']; ?>"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                    <button class="btn btn-danger" data-id="<?php echo $subject['subject_id']; ?>"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
        </a>

    <?php endforeach; ?>

<?php else: ?>

    <?php echo $lang->translate('error_noting_here'); ?>

<?php endif; ?>

<script>

    $('.btn-danger').click(function() {

        var subject_id = $(this).attr("data-id");
        var row = $(this).parent().parent();

        swal({

                title: "Are you sure?",
                text: "If you delete this subject, all grades in it will be deleted too. This can't be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete this subject!",
                cancelButtonText: "No, cancel.",
                closeOnConfirm: false,
                closeOnCancel: false },

            function(isConfirm) {

                if (isConfirm) {

                    // Do request
                    $.post('core/ajax/delete-subject.php', {
                        'subject_id': subject_id
                    }, function (data) {

                        if (data == '1') {
                            $(row).slideUp();
                            swal("Deleted!", "Deletion was successful.", "success");
                        } else {
                            swal("Error!", "Server error while deletion.", "error");
                        }

                    });

                } else {
                    swal("Cancelled", "Deletion has been canceled.", "error");
                }
            }

        );

    });

</script>
