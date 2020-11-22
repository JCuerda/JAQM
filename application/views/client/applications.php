<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Application List</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="application-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>Position Applied</strong> </td>
                            <td class="text-center"><strong>Company</strong> </td>
                            <td class="text-center"><strong>Date Applied</strong> </td>
                            <td class="text-center"><strong>Status</strong> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $job):?>
                        <tr>
                            <td class="text-center"><?php echo $job->title;?></td>
                            <td class="text-center"><a href="<?php echo base_url('client/view_company/'.$job->company_id);?>"><?php echo $job->company_id;?></a></td>
                            <td class="text-center"><?php echo date_format(new DateTime($job->date_applied), "M d, Y");?></td>
                            <td class="text-center"><?php echo $job->status; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>