<div class="col-md-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Subscription Rates Table</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="rate-list" 
                       class="table table-striped table-bordered dt-responsive nowrap"
                       cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <td class="text-center"><strong>ID</strong> </td>
                            <td class="text-center"><strong>Description</strong> </td>
                            <td class="text-center"><strong>Max Allowed Post</strong> </td>
                            <td class="text-center"><strong>Pricing</strong> </td>
                            <td class="text-center"><strong>Action</strong> </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rates as $rate):?>
                        <tr>
                            <td class="text-center"><?php echo $rate->id;?></td>
                            <td class="text-center"><?php echo $rate->description;?></td>
                            <td class="text-center"><?php echo $rate->max_post;?></td>
                            <td class="text-center"><?php echo '$' .$rate->pricing; ?></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-primary waves-effect" id="edit-rate-btn" data-rate-id="<?php echo $rate->id;?>">Edit</button>
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
<div id="edit-rates-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-inverse m-t-10" id="job-details-panel">
                <div class="panel-heading" id="job-rate-header">
                    <h3 class="panel-title">Rate Details</h3>
                </div>
                <div class="panel-body" id="edit-rate-body">
                  
                </div>
                <div class="panel-footer clearfix">
                    <button 
                        class="btn btn-primary pull-right waves-effect" 
                        id="save-edit-rate-details"><i class="fa fa-save"></i> Save Changes
                    </button>
                </div>
            </div>  
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->
