<?php global $lang, $msg; ?>

<h1 class="site-title">
    <?php echo $lang->translate('title_semesters'); ?>
    <a href="add.php?type=semester">
        <button class="btn btn-success btn-right">
            <?php echo $lang->translate('btn_add_semester'); ?>
        </button>
    </a>
</h1>

<?php $msg->get_success_message(); ?>

<?php $semesters = get_semesters_for_user() ?>

<?php if ( $semesters !== null ): ?>

    <?php foreach ( $semesters as $semester ): ?>

        <a href="dashboard.php?semester=<?php echo $semester['semester_id']; ?>">
            <div class="list-item">
                <h3><?php echo $semester['semester_name']; ?> <small><?php echo $semester['semester_average']; ?></small></h3>
                <div class="tool-buttons hide">
                    <a href="edit.php?type=semester&semester=<?php echo $semester['semester_id']; ?>"><button class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                    <button class="btn btn-danger" data-id="<?php echo $semester['semester_id']; ?>"><i class="fa fa-trash-o"></i></button>
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

        var semester_id = $(this).attr("data-id");
        var row = $(this).parent().parent();

        swal({

                title: "Are you sure?",
                text: "If you delete this semester, all subjects and grades will get deleted too. This can't be undone.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete this semester!",
                cancelButtonText: "No, cancel.",
                closeOnConfirm: false,
                closeOnCancel: false },

            function(isConfirm) {

                if (isConfirm) {

                    // Do request
                    $.post('core/ajax/delete-semester.php', {
                        'semester_id': semester_id
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
