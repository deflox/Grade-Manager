<?php global $lang, $msg; ?>

<h1 class="site-title">
    <?php echo sprintf( $lang->translate('title_grades'), get_subject_name( $_GET['subject'] ) ); ?>
    <a href="add.php?type=grade&semester=<?php echo $_GET['semester'] ?>&subject=<?php echo $_GET['subject'] ?>">
        <button class="btn btn-success btn-right">
            <?php echo $lang->translate('btn_add_grade'); ?>
        </button>
    </a>
</h1>

<?php $msg->get_success_message(); ?>

<?php $grades = get_grades_for_subject($_GET['subject']) ?>

<?php if ( $grades !== null ): ?>

    <?php foreach ( $grades as $grade ): ?>

        <div class="list-item">
            <h3><?php echo $grade['grade_name']; ?> <small><?php print_date($grade['grade_date']); ?></small> </h3>
            <div class="tool-buttons hide">
                <button class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger" data-id="<?php echo $grade['grade_id']; ?>"><i class="fa fa-trash-o"></i></button>
            </div>
            <div class="clearfix"></div>
        </div>

    <?php endforeach; ?>

<?php else: ?>

    <?php echo $lang->translate('error_noting_here'); ?>

<?php endif; ?>

<script>

    $('.btn-danger').click(function() {

        var grade_id = $(this).attr("data-id");
        var row = $(this).parent().parent();

        swal({

            title: "Are you sure?",
            text: "This can't be undone.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete this grade!",
            cancelButtonText: "No, cancel.",
            closeOnConfirm: false,
            closeOnCancel: false },

            function(isConfirm) {

                if (isConfirm) {

                    // Do request
                    $.post('core/ajax/delete-grade.php', {
                        'grade_id': grade_id
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
