<div class="col-lg-12">
    <div class="panel panel-color panel-inverse m-t-10" id="basic-info-panel">
        <div class="panel-heading" id="info-header">
            <h3 class="panel-title">Company Details</h3>
            <p class="panel-sub-title font-13 text-muted">Basic information about your company.</p>
            <div id="info-button-container" hidden>
                <button 
                    class="btn btn-primary btn-xs waves-effect waves-light m-b-10" 
                    id="edit-info-btn"
                    hidden><i class="fa fa-edit"></i> Add / Edit Company Information
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <input type="hidden" id="company-id" value="<?php echo (empty($company)) ? '' : $company->id; ?>">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="" class="control-label">Company Name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="company-name" name="company_name" class="form-control " placeholder="Company Name" value="<?php echo (empty($company)) ? '' : $company->name;?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="" class="control-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="address" name="address" class="form-control "  placeholder="Address" value="<?php echo (empty($company)) ? '' : $company->address;?>">
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 col-xs-12">
                    <label for="" class="control-label">Contact Number</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" id="contact-number" name="contact_number" class="form-control "  placeholder="Contact Number" value="<?php echo (empty($company)) ? '' : $company->contact_number;?>">
                    </div>
                </div>

                <div class="col-md-12 m-t-10">
                    <label for="" class="control-label">Company Description</label>
                    <textarea disabled class="form-control" name="company_description" id="company-description" cols="30" rows="10"><?php echo (empty($company)) ? '' : $company->description;?></textarea>
                </div>

            </div>
            <!-- form-group -->
        </div>
        <div class="panel-footer clearfix" id="company-footer">
            <button 
                class="btn btn-primary pull-right" 
                id="save-company-profile-changes"><i class="fa fa-save"></i> Save Changes
            </button>
        </div>
    </div>
</div>
