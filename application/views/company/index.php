<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">
                   Welcome to JAQM
                </h3>
                <div class="portlet-widgets">
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div> <!-- End row -->

<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Applicant's List</h3>
        </div>
        <div class="panel-body">
            <div class="">
                <table id="applicants-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Applicant ID</strong> </td>
                            <td class="text-center"><strong>Applicant Name</strong> </td>
                            <td class="text-center"><strong>Position Applied</strong> </td>
                            <td class="text-center"><strong>Date Applied</strong> </td>
                            <td class="text-center"><strong>Current Status</strong> </td>
                            <td class="text-center"><strong>Resume</strong> </td>
                            <td class="text-center"><strong>Action</strong> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicants as $a):?>
                        <tr>
                            <td class="text-center"><?php echo $a->applicant_id;?></td>
                            <td class="text-center"><?php echo $a->first_name .' '. $a->last_name;?></td>
                            <td class="text-center"><?php echo $a->title;?></td>
                            <td class="text-center"><?php echo date_format(new datetime($a->date_applied), "F j, Y")?></td>
                            <td class="text-center"><?php echo $a->status;?></td>
                            <td class="text-center"><a href="<?php echo ($a->resume != '') ? base_url('Viewer/web/viewer.html?file='.$a->resume) : '#';?>"><i class="fa fa-file"></i></a></td>
                            <td class="text-center">
                                <!-- <button class="btn-xs btn-primary"><i class="fa fa-edit"></i> Shorlist</button>
                                <button class="btn-xs btn-inverse"><i class="fa fa-phone-square"></i> Interview</button> -->
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-primary btn-xs dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false"> Mark as <span class="caret"></span> </button> -->
                                    <!-- <ul class="dropdown-menu"> -->
                                        
                                        <!-- <li> -->
                                            <button id="shortlist-applicant" class="btn-info btn-xs" data-applicant-id="<?php echo $a->applicant_id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark Applicant as Shortlisted"><i class="fa fa-list-alt"></i></button>
                                        <!-- </li> -->
                                        <!-- <li> -->
                                            <button id="interview-applicant" class="btn-success btn-xs" data-applicant-id="<?php echo $a->applicant_id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as Interview"><i class="fa fa-phone-square"></i></button>
                                        <!-- </li> -->
                                    <!-- </ul> -->
                                </div>
                            </td>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
