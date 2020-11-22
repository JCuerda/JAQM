<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Registered Companies</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="company-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Company Name</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Subscription</th>
                            <th class="text-center">Date Registered</th>
                            <th class="text-center">Is Active</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($companies as $c):?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?php echo base_url('assets/images/icons/organization.svg');?>" alt="company" class="thumb-sm img-circle">
                                </td>
                                <td class="text-center"><h5 class="m-0"><?php echo ($c->id) ? $c->id : 'N/A';?></h5></td>
                                <td class="text-center"><h5 class="m-0"><?php echo ($c->name) ? $c->name : 'N/A';?></h5></td>
                                <td class="text-center"><?php echo ($c->address != '') ? $c->address : 'N/A';?></td>
                                <td class="text-center"><?php echo ($c->contact_number != '') ? $c->contact_number : 'N/A';?></td>
                                <td class="text-center"><?php echo ($c->subscription != '') ? $c->subscription : 'N/A';?></td>
                                <td class="text-center"><?php echo ($c->date_registered != '') ? $c->date_registered : 'N/A';?></td>
                                <td class="text-center"><?php echo ($c->is_active != '') ? $c->is_active : 'N/A';?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button id="view-company-jobs" class="btn-primary btn-xs waves-effect" data-company-id="<?php echo ($c->id) ? $c->id : '#';?>" data-toggle="tooltip" data-placement="top" data-original-title="View Posted Jobs"><i class="fa fa-search"></i></button>
                                        <button id="btn-re-activate" class="btn-info btn-xs waves-effect" data-toggle="tooltip" data-company-id="<?php echo ($c->id) ? $c->id : '#';?>" data-placement="top" data-original-title="Re-Activate Company"><i class="fa fa-check-square"></i></button>
                                        <button id="btn-deactivate" class="btn-danger btn-xs waves-effect" data-toggle="tooltip" data-company-id="<?php echo ($c->id) ? $c->id : '#';?>" data-placement="top" data-original-title="Deactivate Company"><i class="fa fa-exclamation-triangle"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Panel Modal -->
<div id="company-jobs" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse m-t-10" id="">
                <div class="panel-heading" id="">
                    <h3 class="panel-title">Company Jobs</h3>
                </div>
                <div class="panel-body" id="job-list">
                  
                </div>
            </div>  
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->