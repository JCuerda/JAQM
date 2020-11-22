<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-heading bg-inverse">
                <h3 class="portlet-title">
                   Welcome to <?php echo $this->session->userdata('name');?>
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
            <h3 class="panel-title">My Applications</h3>
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

