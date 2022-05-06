<div class="page-header-top">
    <div class="container">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= Yii::app()->homeUrl ?>">
                <img src="<?= $this->adminLogo?>" alt="logo" class="logo-default" height="55">
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                  
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user dropdown-dark">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-mobile btn btn-default"><?= Yii::app()->user->userFirstname?></span>
                    </a>
                    <?php 
                        $profileData=Profile::model()->find("user_id=".Yii::app()->user->userId);
                        if(count($profileData)==0)
                            $proLink=Yii::app()->createUrl('//admin/user/profileCreate');
                        else
                            $proLink=Yii::app()->createUrl('//admin/user/profileUpdate',array('id'=>$profileData->id));
                    ?>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?= $proLink?>">
                                <i class="fa fa-user"></i> Update Profile </a>
                        </li>
                        <li>
                            <a href="<?= $this->createUrl('//admin/user/changePassword')?>">
                                <i class="icon-key"></i> Change Password </a>
                        </li>
                        <li>
                            <a href="<?= $this->createUrl('//site/logout')?>">
                                <i class="fa fa-sign-out"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER 
                <li class="dropdown dropdown-extended quick-sidebar-toggler">
                    <span class="sr-only">Toggle Quick Sidebar</span>
                    <i class="icon-logout"></i>
                </li>
                END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
</div>