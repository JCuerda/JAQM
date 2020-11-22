<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">List of Favorite Jobs</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="application-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <td class="text-center">Job ID</td>
                            <td class="text-center"><strong>Position</strong> </td>
                            <td class="text-center"><strong>Company</strong> </td>
                            <td class="text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $job): ?>
                            <tr>
                                <td class="text-center"><?php echo $job->id;?></td>
                                <td class="text-center"><?php echo $job->title;?></td>
                                <td class="text-center"><?php echo $job->company_id;?></td>
                                <td class="text-center">
                                    <a class="btn-primary btn-xs btn-block" href="<?php echo base_url('client/view_job/'.$job->id)?>"><i class="fa fa-search"></i> View</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>