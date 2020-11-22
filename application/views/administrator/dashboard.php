<div class="col-md-12">
<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="card-box widget-box-one">
        <i class="fa fa-edit widget-one-icon"></i>
        <div class="wigdet-one-content">
            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Number of Posted Jobs</p>
            <h2><?php echo $job_count;?><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
        </div>
    </div>
</div><!-- end col -->

<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="card-box widget-box-one">
        <i class="fa fa-building widget-one-icon"></i>
        <div class="wigdet-one-content">
            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Number Company Registered</p>
            <h2><?php echo $company_count;?><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
        </div>
    </div>
</div><!-- end col -->

<div class="col-lg-4 col-md-4 col-sm-4">
    <div class="card-box widget-box-one">
        <i class="fa fa-users widget-one-icon"></i>
        <div class="wigdet-one-content">
            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">Total Number of Users</p>
            <h2><?php echo $client_count;?><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
        </div>
    </div>
</div><!-- end col --> 
</div>

<div class="col-md-6">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">Recently Registered Companies</h4>
        <div class="table-responsive">
            <table class="table table table-hover m-0">
                <thead>
                     <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Subscription</th>
                        <th class="text-center">Date Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($company as $c):?>
                    <tr>
                        <th class="text-center">
                            <img src="<?php echo base_url('assets/images/icons/organization.svg');?>" alt="company" class="thumb-sm img-circle">
                        </th>
                        <td class="text-center"><h5 class="m-0"><?php echo ($c->name != '') ? $c->name : 'N/A';?></h5></td>
                        <td class="text-center"><?php echo ($c->address != '') ? $c->address : 'N/A';?></td>
                        <td class="text-center"><?php echo ($c->contact_number != '') ? $c->contact_number : 'N/A';?></td>
                        <td class="text-center"><?php echo ($c->subscription != '') ? $c->subscription : 'N/A';?></td>
                        <td class="text-center"><?php echo ($c->date_registered != '') ? $c->date_registered : 'N/A';?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div> <!-- table-responsive -->
    </div>
</div>

<div class="col-md-6">
    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">Recently Registered Users</h4>
        <div class="table-responsive">
            <table class="table table table-hover m-0">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Date Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($applicants as $a):?>
                    <tr>
                        <th class="text-center">
                            <img src="<?php echo base_url('assets/images/icons/businessman.svg');?>" alt="user" class="thumb-sm img-circle">
                        </th>
                        <td class="text-center">
                            <h5 class="m-0"><?php echo ($a->first_name !='' && $a->last_name != '' ) ? $a->first_name.' '.$a->last_name : 'N/A'; ?></h5>
                            <p class="m-0 text-muted font-13"><small><?php echo $a->course?></small></p>
                        </td>
                        <td class="text-center"><?php echo ($a->contact_number != '') ? $a->contact_number : 'N/A';?></td>
                        <td class="text-center"><?php echo ($a->address != '') ? $a->address : 'N/A';?></td>
                        <td class="text-center"><?php echo ($a->email != '') ? $a->email : 'N/A';?></td>
                        <td class="text-center"><?php echo ($a->date_registered != '') ? date_format(new DateTime($a->date_registered), 'M d, Y') : 'N/A'?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div> <!-- table-responsive -->
    </div>
</div>