<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Registered Companies</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="client-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                        <th class="text-center"></th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Location</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Date Registered</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($applicants as $a):?>
                        <tr>
                            <td class="text-center">
                                <img src="<?php echo base_url('assets/images/icons/businessman.svg');?>" alt="user" class="thumb-sm img-circle">
                            </td>
                            <td class="text-center"><strong><?php echo ($a->id != '') ? $a->id : 'N/A';?></strong></td>
                            <td class="text-center">
                                <h5 class="m-0"><?php echo ($a->first_name !='' && $a->last_name != '' ) ? $a->first_name.' '.$a->last_name : 'N/A'; ?></h5>
                                <p class="m-0 text-muted font-13"><small><?php echo $a->course?></small></p>
                            </td>
                            <td class="text-center"><?php echo ($a->contact_number != '') ? $a->contact_number : 'N/A';?></td>
                            <td class="text-center"><?php echo ($a->address != '') ? $a->address : 'N/A';?></td>
                            <td class="text-center"><?php echo ($a->email != '') ? $a->email : 'N/A';?></td>
                            <td class="text-center"><?php echo ($a->date_registered != '') ? date_format(new DateTime($a->date_registered), 'M d, Y') : 'N/A'?></td>
                            <td class="text-center">
                                <button type="button" id="btn-matched-jobs" data-applicant-id="<?php echo $a->id;?>" class="btn btn-primary waves-effect">View Job Match</button>
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
<div id="job-matched" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse m-t-10" id="">
                <div class="panel-heading" id="">
                    <h3 class="panel-title">Matching Jobs</h3>
                </div>
                <div class="panel-body" id="matched-job-body">
                  
                </div>
            </div>  
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->