<div class="page-header-menu">
    <div class="container">
<!--         BEGIN HEADER SEARCH BOX 
        <form class="search-form" action="page_general_search.html" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="query">
                <span class="input-group-btn">
                    <a href="javascript:;" class="btn submit">
                        <i class="icon-magnifier"></i>
                    </a>
                </span>
            </div>
        </form>
         END HEADER SEARCH BOX -->
        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
        <?php if(Yii::app()->user->roles=='Admin'){?>
        <div class="hor-menu ">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/dashboard/index') ?>"><i class="fa fa-dashboard"></i> Dashboard
                        <span class="arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/order/index') ?>"><i class="fa fa-bars"></i> Order
                        <span class="arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/user') ?>"><i class="fa fa-users"></i> Users
                        <span class="arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/products') ?>"><i class="fa fa-bars"></i> Product & Service
                        <span class="arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/album') ?>"><i class="fa fa-image"></i> Album & Gallery
                        <span class="arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/jobList') ?>"><i class="fa fa-bars"></i> Career
                        <span class="arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/eposterList') ?>"><i class="fa fa-image"></i> 212Poster
                        <span class="arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/settings') ?>"><i class="fa fa-cogs"></i> Settings
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
        </div>
        <?php }elseif(Yii::app()->user->roles=='ePosterAdmin'){
            ?>

            <div class="hor-menu ">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/eposterList') ?>"><i class="fa fa-image"></i> 212Poster
                        <span class="arrow"></span>
                    </a>
                </li>
                <?php 
                        $profileData=Profile::model()->find("user_id=".Yii::app()->user->userId);
                        if(count($profileData)==0)
                            $proLink=Yii::app()->createUrl('//admin/user/profileCreate');
                        else
                            $proLink=Yii::app()->createUrl('//admin/user/profileUpdate',array('id'=>$profileData->id));
                    ?>
                <li>
                    <a href="<?= $proLink ?>"><i class="fa fa-user"></i> Profile
                        <span class="arrow"></span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::app()->createUrl('//admin/user/changePassword') ?>"><i class="fa fa-key"></i> Change Password
                        <span class="arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= Yii::app()->createUrl('//site/logout') ?>"><i class="fa fa-sign-out"></i> Logout
                        <span class="arrow"></span>
                    </a>
                </li>
            </ul>
        </div>
        <?php } ?>
        <!-- END MEGA MENU -->
    </div>
</div>