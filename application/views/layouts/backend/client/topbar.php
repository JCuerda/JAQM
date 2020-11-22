<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="<?php echo base_url('client');?>" class="logo"><span>JA<span>QM</span></span><i class="mdi mdi-layers"></i></a>
</div>

<!-- Button mobile view to collapse sidebar menu -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">

        <!-- Navbar-left -->
        <ul class="nav navbar-nav navbar-left">
            <li>
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

        <!-- Right(Notification) -->
        <ul class="nav navbar-nav navbar-right">
            <!-- <li>
                <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    <span class="badge up bg-success">4</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                    <li>
                        <h5>Notifications</h5>
                    </li>
                    <li>
                        <a href="#" class="user-list-item">
                            <div class="icon bg-info">
                                <i class="mdi mdi-account"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">New Signup</span>
                                <span class="time">5 hours ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="user-list-item">
                            <div class="icon bg-danger">
                                <i class="mdi mdi-comment"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">New Message received</span>
                                <span class="time">1 day ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="user-list-item">
                            <div class="icon bg-warning">
                                <i class="mdi mdi-settings"></i>
                            </div>
                            <div class="user-desc">
                                <span class="name">Settings</span>
                                <span class="time">1 day ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="all-msgs text-center">
                        <p class="m-0"><a href="#">See all Notification</a></p>
                    </li>
                </ul>
            </li> -->

            <li class="dropdown user-box">
                
                <a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                    <img src="<?php echo base_url('assets/images/icons/manager.svg');?>" alt="user-img" class="img-circle user-img">
                                
                    <strong>
                        <?php if($this->session->userdata('id')):?>
                            <?php echo $this->session->userdata('name');?>
                        <?php endif;?>
                    </strong>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                    <li>
                        <h5>Hi, 
                            <strong>
                                <?php if($this->session->userdata('id')):?>
                                    <?php echo $this->session->userdata('name');?>
                                <?php endif;?>
                            </strong>
                        </h5>
                    </li>
                    <li><a href="<?php echo base_url('client/show');?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                    <li><a href="<?php echo base_url('client/logout');?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                </ul>
            </li>

        </ul> <!-- end navbar-right -->

    </div><!-- end container -->
</div><!-- end navbar -->
</div>
