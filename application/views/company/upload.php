<div class="col-lg-6 col-md-offset-3 m-t-50">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h3 class="panel-title">Upload Company Logo</h3>
        </div>
        <div class="panel-body">
            <p>
                Note: <span style="color:red;">*</span> 
                Please upload <strong>JPG, GIF or PNG</strong> files only. Max file size should be <strong>1 MB</strong>.
                Other format will be rejected automatically.
            </p>
            <form  class="form" id="upload-logo-form" enctype="multipart/form-data">
                <div class="col-sm-4">
                    <?php if($filename->logo != null || !empty($filename->logo)): ?>
                        <img src="<?php echo base_url('assets/uploads/'.$filename->logo)?>" alt="image" class="img-responsive img-thumbnail" width="200">
                    <?php endif;?>
                    <!-- <img src="<?php #echo base_url('assets/uploads/'.$filename->logo)?>" alt="image" class="img-responsive img-thumbnail" width="200"> -->
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="" class="control-label m-t-10">Logo</label>
                    <div class="form-group">
                        <input type="file" id="company-logo" name="company_logo" class="filestyle" data-buttonbefore="true">
                    </div>
                </div>
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button id="upload-logo-btn" type="submit" class="btn btn-default btn-block"><i class="fa fa-cloud-upload"></i> Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>