<div class="col-md-12">
    <div class="panel panel-color panel-inverse" id="job-list-table">
        <div class="panel-heading">
            <h3 class="panel-title text-center">Jobs</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="job-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center"><strong>Position</strong> </td>
                            <td class="text-center"><strong>Date Posted</strong> </td>
                            <td class="text-center"><strong>Action</strong> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($jobs as $job):?>
                        <tr>
                            <td class="text-center"><?php echo $i; $i++;?></td>
                            <td class="text-center" width="auto"><?php echo $job->title;?></td>
                            <td class="text-center"><?php echo date_format(new DateTime($job->date_posted), "F j, Y");?></td>
                            
                            <td class="text-center">
                                <!-- <button class="btn btn-xs btn-success">View</button> -->
                                <button class="btn btn-xs btn-primary" id="edit-job" data-job-id='<?php echo $job->jq_id;?>'><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-xs btn-danger" id="delete-job" data-company-id="<?php echo $company_id; ?>" data-job="<?php echo $job->id;?>" data-job-id='<?php echo $job->jq_id;?>'><i class="fa fa-trash"></i> Remove</button>
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
<div id="edit-posted-job" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse m-t-10" id="job-details-panel">
                <div class="panel-heading" id="job-panel-header">
                    <h3 class="panel-title">Job Details</h3>
                </div>
                <div class="panel-body" id="edit-job-body">
                  
                </div>
                <div class="panel-footer clearfix">
                    <button 
                        class="btn btn-primary pull-right" 
                        id="save-edit-post-job"><i class="fa fa-save"></i> Save Changes
                    </button>
                </div>
            </div>  
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->