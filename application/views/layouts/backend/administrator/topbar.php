<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="<?php echo base_url('administrator');?>" class="logo"><span>JA<span>QM</span></span><i class="mdi mdi-layers"></i></a>
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
                
                <a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                    <img src="<?php echo base_url('assets/images/icons/manager.svg');?>" alt="user-img" class="img-circle user-img">
                                
                    <strong>
                        <?php if($this->session->userdata('id')):?>
                            <?php echo $this->session->userdata('role');?>
                        <?php endif;?>
                    </strong>
                    <i class="fa fa-caret-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                    <li>
                        <h5>Hi, 
                            <strong>
                                <?php if($this->session->userdata('id')):?>
                                    <?php echo $this->session->userdata('role');?>
                                <?php endif;?>
                            </strong>
                        </h5>
                    </li>
                    <li><a href="<?php echo base_url('administrator/logout');?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                </ul>
            </li>

        </ul> <!-- end navbar-right -->

    </div><!-- end container -->
</div><!-- end navbar -->
</div>
