<div class="col-lg-12">
	<div class="panel panel-color panel-inverse">
		<div class="panel-heading">
			<h3 class="panel-title">Profile Information</h3>
		</div>
		<div class="panel-body">
			<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
				magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p> -->
			<div class="col-lg-12">
				<div class="panel panel-color panel-inverse m-t-10" id="basic-info-panel">
					<div class="panel-heading" id="info-header">
						<h3 class="panel-title">Personal Details</h3>
                        <p class="panel-sub-title font-13 text-muted">Basic information about yourself.</p>
                        <div id="info-button-container" hidden>
                            <button 
                                class="btn btn-primary btn-xs waves-effect waves-light m-b-10" 
                                id="edit-info-btn"
                                hidden><i class="fa fa-edit"></i> Add / Edit Personal Information
                            </button>
                        </div>
					</div>
					<div class="panel-body">
                        <?php 
                            if(!empty($client)){
                                if(!empty($client->id)){
                                    $value = (!empty($client)) ? $client->id : "";
                                    echo '<input type="hidden" id="client_id" name="id" class="form-control" value="'. $value . '">';
                                } 
                            }                            
                        ?>
                        
						<div class="form-group">
							<div class="col-md-4 col-sm-12 col-xs-12">
								<label for="" class="control-label">First Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" id="first-name" name="first_name" class="form-control info_disabled" disabled placeholder="First Name" value="<?php echo (!empty($client)) ? $client->first_name : '';?>">
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<label for="" class="control-label">Last Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" id="last-name" name="last_name" class="form-control info_disabled" disabled placeholder="Last Name" value="<?php echo (!empty($client)) ? $client->last_name : '';?>">
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12">
								<label for="" class="control-label">Middle Name</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" id="middle-name" name="middle_name" class="form-control info_disabled" disabled placeholder="Middle Name" value="<?php echo (!empty($client)) ? $client->middle_name : '';?>">
								</div>
							</div>
						</div>
						<!-- form-group -->

						<div class="form-group">
							<div class="col-md-6 col-sm-12 col-xs-12">
								<label for="" class="control-label m-t-10">Address</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
									<input type="text" id="address" name="address" class="form-control info_disabled" disabled placeholder="Address" value="<?php echo (!empty($client)) ? $client->address : '';?>">
								</div>
							</div>
							<div class="col-md-3 col-sm-12 col-xs-12">
								<label for="" class="control-label m-t-10">Contact Number</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa  fa-phone"></i></span>
									<input type="text" id="contact-number" name="contact_number" class="form-control info_disabled" disabled placeholder="Contact Number" value="<?php echo (!empty($client)) ? $client->contact_number : '';?>">
								</div>
							</div>
							<div class="col-md-3 col-sm-12 col-xs-12">
								<label for="" class="control-label m-t-10">Email Address</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									<input type="text" id="email" name="email" class="form-control info_disabled" disabled placeholder="Email Address" value="<?php echo (!empty($client)) ? $client->email_address : '';?>">
								</div>
							</div>
						</div>
						<!-- form-group -->
                    </div>
                    <div class="panel-footer clearfix" id="info-footer" hidden>
                        <button 
                            class="btn btn-primary pull-right" 
                            id="save-info-changes"><i class="fa fa-save"></i> Save Changes
                        </button>
                    </div>
				</div>
            </div>
            
			<div class="col-lg-6">
				<div class="panel panel-color panel-inverse" id="educ-panel">
					<div class="panel-heading" id="educational-attainment-header">
						<h3 class="panel-title">Educational Attainment</h3>
                        <p class="panel-sub-title font-13 text-muted">Educational attainments</p>
                        <div id="attainment-button-container" hidden>
                            <button 
                            class="btn btn-primary btn-xs waves-effect waves-light m-b-10" 
                            id="edit-educational-attainment"
                            hidden><i class="fa fa-edit"></i> Add / Edit Educational Attainment</button>
                        </div>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="" class="control-label">Primary Education</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
									<input type="text" id="elem-edu" name="prim_educ" class="form-control ea_disabled" disabled placeholder="Primary School" value="<?php echo (!empty($client)) ? $client->prim_educ : '';?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
								<label for="" class="control-label">Secondary Education</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
									<input type="text" id="sec-edu" name="sec_educ" class="form-control ea_disabled" disabled placeholder="Secondary School" value="<?php echo (!empty($client)) ? $client->sec_educ : '';?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
								<label for="" class="control-label">Tertiary Education</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
									<input type="text" id="ter-edu" name="ter_educ" class="form-control ea_disabled" disabled placeholder="Tertiary School" value="<?php echo (!empty($client)) ? $client->ter_educ : '';?>">
								</div>
							</div>
                        </div>
                        
                        <!-- <div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
								<label for="" class="control-label">Course Taken</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                                    <select name="course" id="course" class="form-control ea_disabled" disabled>
                                        <option value="BSIT">Bachelor of Science in Information Technology</option>
                                    </select>
								</div>
							</div>
						</div> -->
                    </div>
                    <div class="panel-footer" id="ea_footer" hidden>
                        <button class="btn btn-primary btn-block" id="save-ea-changes"><i class="fa fa-save"></i> Save Changes</button>
                    </div>
				</div>
				<div class="panel panel-color panel-inverse" id="upload-panel">
					<div class="panel-heading">
						<h3 class="panel-title">Upload Section</h3>
					</div>
					<div class="panel-body">
						<p>
                            Note: <span style="color:red;">*</span> 
                            Please upload <strong>PDF</strong> files only. Max file size should be <strong>2MB</strong>.
                            Other format will be rejected automatically.
                        </p>
                            <a href="<?php echo ($client->resume != '') ? base_url('viewer/web/viewer.html?file='.$client->resume) : '';?>" class="btn btn-primary">View Resume</a>
						<form  class="form" id="upload-form" enctype="multipart/form-data">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="" class="control-label m-t-10">Resume</label>
								<div class="form-group">
									<input type="file" id="resume" name="resume" class="filestyle" data-buttonbefore="true">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<button id="upload-btn" type="submit" class="btn btn-default btn-block"><i class="fa fa-cloud-upload"></i> Upload</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="panel panel-color panel-inverse" id="qualification-panel">
					<div class="panel-heading" id="qualification-header">
						<h3 class="panel-title">My Qualifications / Skills</h3>
                        <p class="panel-sub-title font-13 text-muted">List of Qualifications and Skills</p>
                        <div id="qualification-button-container" hidden>
                            <button 
                                class="btn btn-primary btn-xs waves-effect waves-light m-b-10" 
                                id="edit-qualification"
                                hidden><i class="fa fa-edit"></i> Add / Edit Qualifications
                            </button>
                        </div>
					</div>
					<div class="panel-body">
						<div class="col-md-12">

							<!-- <p class="text-muted m-b-10 font-13">
								<span style="color:red;">*</span>Note: &nbsp; You can edit each qualification by clicking it.
							</p>

							<button class="btn btn-primary waves-effect waves-light m-b-10" data-toggle="modal" data-target="#qualification-modal">Add
								Qualification</button>

							<div class="list-group">
								<button data-qualification-id="A" id="qualification" class="list-group-item waves-effect waves-light m-b-10">Cras justo odio</button>
								<button data-qualification-id="B" id="qualification" class="list-group-item waves-effect waves-light m-b-10">Morbi leo risus</button>
								<button data-qualification-id="C" id="qualification" class="list-group-item waves-effect waves-light m-b-10">Porta ac consectetur ac</button>
								<button data-qualification-id="D" id="qualification" class="list-group-item waves-effect waves-light m-b-10">Vestibulum at eros</button>
                            </div> list-group -->

                            <input type="hidden" id="aq_id" value="<?php echo $client->aq_id; ?>">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Specialization</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <!-- <input type="text" id="example-input1-group1" name="example-input1-group1" class="form-control" placeholder="Id"> -->
                                        <select class="form-control select2 q_disabled" disabled id="specialization" name="specialization" placeholder="" value="" selected>
                                            
                                            <!-- <option value="<?php #echo $qualifications['spec']['qualification_id']?>"><?php #echo $qualifications['spec']['description']?></option> -->
                                            <option value="0">-- Select --</option>
                                            <?php foreach ($specialization as $s): ?> 
                                                <optgroup label="<?php echo $s->description;?>">
                                                    <?php foreach ($sub_specialization as $sub): ?>
                                                        <?php if($s->id == $sub->specialization_id):?>
                                                            <?php if(empty($qualifications)):?>
                                                                <option value="<?php echo $sub->id;?>"><?php echo $sub->description;?></option>
                                                            <?php elseif($sub->id === $qualifications['spec']['qualification_id']):?>
                                                                <option value="<?php echo $sub->id;?>" selected><?php echo $sub->description;?></option>
                                                            <?php else: ?>
                                                                <option value="<?php echo $sub->id;?>"><?php echo $sub->description;?></option>
                                                            <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                </optgroup>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Field of Study</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="FOS" name="fos" placeholder="" value="">
                                            <option value="0">-- Select --</option>
                                            <?php foreach ($fos as $f): ?> 
                                                <?php if(empty($qualifications)):?>
                                                    <option value="<?php echo $f->id;?>"><?php echo $f->description;?></option>
                                                <?php elseif($f->id === $qualifications['fos']['qualification_id']):?>
                                                    <option value="<?php echo $f->id;?>" selected><?php echo $f->description;?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo $f->id;?>"><?php echo $f->description;?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Degree Level</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="educ-attainment" name="educ_attainment" placeholder="" value="">
                                            <option value="0">-- Select --</option>
                                            <?php foreach($eas as $e):?>
                                                <?php if(empty($qualifications)):?>
                                                    <option value="<?php echo $e->id;?>"><?php echo $e->description;?></option>
                                                <?php elseif($e->id === $qualifications['educ']['qualification_id']):?>
                                                    <option value="<?php echo $e->id;?>" selected><?php echo $e->description;?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo $e->id;?>"><?php echo $e->description;?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Work Experience </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="year-of-exp" name="year_of_exp" placeholder="" value="">
                                            <option value="0">-- Select --</option>
                                            <?php #for ($i=1; $i <= 15; $i++): ?> 
                                                <option value="<?php #echo $i?>"><?php #echo $i . ' year experience';?></option>
                                            <?php #endfor;?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Work Experience </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="year-of-exp" name="year_of_exp" placeholder="" value="">
                                            <option value="0">-- Select --</option>
                                            <?php foreach ($work_exps as $work): ?>
                                                <?php if(empty($qualifications)):?> 
                                                    <option value="<?php echo $work->id?>"><?php echo $work->description;?></option>
                                                <?php elseif($work->id === $qualifications['work']['qualification_id']):?>
                                                    <option value="<?php echo $work->id;?>" selected><?php echo $work->description;?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo $work->id;?>"><?php echo $work->description;?></option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Work Location</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-map"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="work-location" name="work_location" placeholder="" value="">
                                            <option value = "0">-- Select --</option>
                                            <?php foreach ($locations as $location): ?> 
                                                <option value="<?php echo $location->id;?>"><?php echo $location->description;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <label for="" class="control-label">Expected Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <select class="form-control select2 q_disabled" disabled id="salary" name="salary" placeholder="" value="">
                                            <option value="0">-- Select --</option>
                                            <?php foreach($salaries as $s):?>
                                                <?php if(empty($qualifications)):?> 
                                                    <option value="<?php echo $s->id?>"><?php echo $s->from .' - '. $s->to;?></option>
                                                <?php elseif($s->id === $qualifications['salary']['qualification_id']):?>
                                                    <option value="<?php echo $s->id;?>" selected> PHP <?php echo $s->from .' - '. $s->to;?> pesos</option>
                                                <?php else: ?>
                                                    <option value="<?php echo $s->id;?>">PHP <?php echo $s->from .' - '. $s->to;?> pesos</option>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>

						</div>
                    </div>

                    <div class="panel-footer" id="qualification-footer" hidden>
                        <button class="btn btn-primary btn-block" id="save-qualification-btn"><i class="fa fa-save"></i> Save Changes</button>
                    </div>
				</div>

				<div class="panel panel-color panel-inverse" id="action-panel" hidden>
					<div class="panel-heading">
						<h3 class="panel-title">Action</h3>
                    </div>
                        <?php 
                            $is_empty   = empty($client) ? '' : 'hidden';
                            $can_update = empty($client) ? 'hidden' : ''; 
                        ?>
					<div class="panel-body" <?php echo $is_empty; ?>>
                        <button id="save-details" class="btn btn-primary btn-block" ><i class="fa fa-save"></i>&nbsp;<strong>Save All Changes</strong></button>
                       <!-- <?php #echo (!empty($client)) ? ' <button id="update-details" class="btn btn-danger btn-block"><i class="fa fa-save"></i>&nbsp;<strong>Update All Changes</strong></button>' : '';?> -->
                    </div>
                    
                    <div class="panel-body" <?php echo $can_update;?>>
                        <button id="update-details" class="btn btn-primary btn-block" ><i class="fa fa-save"></i>&nbsp;<strong>Update All Changes</strong></button>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div id="qualification-modal1" class="modal-jaqm">
		<button type="button" class="close" onclick="Custombox.close();">
			<span>&times;</span><span class="sr-only">Close</span>
		</button>
		<h4 class="custom-modal-title">Modal title</h4>
		<div class="custom-modal-text">
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
			standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
			type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
			remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
			Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of
			Lorem Ipsum.
		</div>
	</div>

	<!-- Panel Modal -->
	<div id="qualification-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="QualificationModal" aria-hidden="true"
	 style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
                <form id="qualification-form">
                    <div class="panel panel-color panel-inverse">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:white;">×</button>
                            <h3 class="panel-title">Add Qualification / Skills</h3>
                        </div>
                        <div class="panel-body">
                            <div id="qualification-box">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="control-label">Qualification Description: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                                            <input type="text" id="qualification" name="qualifications[]" class="form-control" placeholder="Add new qualification / skills">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                    <button class="btn btn-block btn-info" id="add-qualification"><i class="fa fa-plus-circle"></i> Add More</button>
                                </div>
                            </div>
                            
                        </div>

                        <div class="panel-footer">
                            <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                <button id="save-qualifications" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save Qualification</button>
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
    <!-- /.modal -->

    
    <!-- Panel Modal -->
	<div id="edit-qualification-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="EditQualification" aria-hidden="true"
	 style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content p-0 b-0">
                <form id="qualification-form">
                    <div class="panel panel-color panel-inverse">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:white;">×</button>
                            <h3 class="panel-title">Edit Qualification</h3>
                        </div>
                        <div class="panel-body">
                            <div id="qualification-box">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="" class="control-label">Qualification Description: </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                                            <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Add new qualification / skills">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="col-md-12 col-sm-12 col-xs-12 m-t-10">
                                <button id="save-qualifications" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save Qualification</button>
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
    <!-- /.modal -->




</div>
