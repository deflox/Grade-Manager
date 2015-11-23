<?php global $lang ?>

<nav class="navbar navbar-default">

    <div class="container dashboard">

        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="dashboard.php"><i class="fa fa-home fa-1x"></i> <?php echo $lang->translate('link_home'); ?></a></li>
                    <li><a href="settings.php"><i class="fa fa-cog fa-1x"></i> <?php echo $lang->translate('link_settings'); ?></a></li>
                    <li><a href="#"><i class="fa fa-cog fa-1x"></i> <?php echo $lang->translate('link_admin_settings'); ?></a></li>
                    <li><a href="#"><i class="fa fa-user fa-1x"></i> <?php echo $lang->translate('link_user'); ?></a></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-1x"></i> <?php echo $lang->translate('link_logout'); ?></a></li>
                </ul>

            </div>
        </div>

    </div>

</nav>
