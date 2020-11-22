<div class="col-lg-12">
    <div class="panel panel-color panel-inverse m-t-10" id="job-details-panel">
        <div class="panel-heading" id="job-panel-header">
            <h3 class="panel-title">Job Details</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label for="" class="control-label">Job Position</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" id="job-position" name="job_position" class="form-control "  placeholder="" value="">
                    </div>
                </div>
            </div>
            <!-- form-group -->

            <div class="form-group">
                <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Specialization </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                        <select class="form-control select2" id="specialization" name="specialization" placeholder="" value="">
                            <option value="0">-- Select --</option>
                            <?php foreach ($specialization as $s): ?> 
                                <optgroup label="<?php echo $s->description;?>">
                                    <?php foreach ($sub_specialization as $sub): ?>
                                        <?php if($s->id == $sub->specialization_id):?>
                                            <option value="<?php echo $sub->id;?>"><?php echo $sub->description;?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </optgroup>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Field of Study</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                        <select class="form-control select2" id="FOS" name="fos" placeholder="" value="">
                            <option value = "0">-- Select --</option>
                            <?php foreach ($fos as $f): ?> 
                                <option value="<?php echo $f->id;?>"><?php echo $f->description;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Educational Attainment</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                        <select class="form-control select2" id="educ-attainment" name="educ_attainment" placeholder="" value="">
                            <option value="0">-- Select --</option>
                            <?php foreach($eas as $e):?>
                                <option value="<?php echo $e->id;?>"><?php echo $e->description;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <!-- Second Layer -->
                <div class="col-md-6 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Work Experience </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <select class="form-control select2" id="year-of-exp" name="year_of_exp" placeholder="" value="">
                            <option value="0">-- Select --</option>
                            <?php foreach ($work_exps as $w): ?>
                                <option value="<?php echo $w->id?>"><?php echo $w->description;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <!-- <div class="col-md-4 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Work Location</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                        <select class="form-control select2" id="work-location" name="work_location" placeholder="" value="">
                            <option value = "0">-- Select --</option>
                            <?php foreach ($locations as $location): ?> 
                                <option value="<?php echo $location->id;?>"><?php echo $location->description;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div> -->
                
                <div class="col-md-6 col-sm-12 col-xs-12 m-t-10">
                    <label for="" class="control-label">Salary</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                        <select class="form-control select2" id="salary" name="salary" placeholder="" value="">
                            <option value="0">-- Select --</option>
                            <?php foreach($salaries as $s):?>
                                <option value="<?php echo $s->id;?>"><?php echo $s->from .' - '. $s->to .'pesos'; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 m-t-10">
                    <label for="" class="control-label">Job Description </label>
                    <textarea class="form-control" id="job-description" name="job_description"></textarea>
                </div>
            </div>

        </div>
        <div class="panel-footer clearfix">
            <button 
                class="btn btn-primary pull-right" 
                id="post-job"><i class="fa fa-save"></i> Save Changes
            </button>
        </div>
    </div>
</div>

