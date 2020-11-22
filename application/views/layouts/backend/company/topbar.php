<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="<?php echo base_url('company');?>" class="logo"><span>JA<span>QM</span></span><i class="mdi mdi-layers"></i></a>
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
            <li class="dropdown user-box">
                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                <img src="<?php echo base_url('assets/images/icons/organization.svg');?>" alt="user-img" class="img-circle user-img">
                </a>

                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                    <li>
                        <h5>Hi, <?php echo ($this->session->userdata('name') !== '') ? $this->session->userdata('name') : 'User' ?></h5>
                    </li>
                    <li><a href="<?php echo base_url('company/profile');?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                    <li><a href="<?php echo base_url('company/logout');?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                </ul>
            </li>

        </ul> <!-- end navbar-right -->

    </div><!-- end container -->
</div><!-- end navbar -->
</div>
