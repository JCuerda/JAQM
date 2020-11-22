<div class="col-md-12">
	<div class="panel panel-color panel-inverse" id="job-details-panel">
		<div class="panel-heading">
            <h3 class="panel-title" style="display: inline-block;">ID:<?php echo $job_detail->job_id; ?> - Jobs Details</h3>      
            <div>
                <?php if(!$is_applied):?>
                    <button class="btn btn-xs btn-primary btn-linkedin" id="btn-apply" data-job-id="<?php echo $job_detail->job_id; ?>" data-applicant-id=<?php echo $applicant_id; ?> role="button"><i class="fa fa-edit"></i> Apply Now</button>
                <?php endif;?>
                <?php if(!$is_favorite): ?>
                    <button class="btn btn-xs btn-info" id="btn-favorite" data-job-id="<?php echo $job_detail->job_id; ?>" data-applicant-id=<?php echo $applicant_id; ?> role="button"><i class="icon ion-star"></i> Add to Favorites</button>
                <?php else: ?>
                    <button class="btn btn-xs btn-danger" id="btn-remove-favorite" data-job-id="<?php echo $job_detail->job_id; ?>" data-applicant-id=<?php echo $applicant_id; ?> role="button"><i class="fa fa-trash"></i> Remove to Favorites</button>
                <?php endif;?>
            </div>
            <div class="clearfix"></div>
        </div>

		<div class="panel-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="card m-t-20">
						<div class="media m-b-30 ">
							<div class="media-body">
								<span class="media-meta pull-right">
									Date Posted: <?php echo date_format(new DateTime($job_detail->date_posted), 'Y-m-d'); ?></span>
								<h3 class="text-primary m-0">
									<?php echo $job_detail->title; ?>
								</h3>
								<b class="text-muted">
                                    <a href="<?php echo base_url('client/view_company/'.$job_detail->comp_id)?>"><?php echo $job_detail->name; ?></a>
                                </b>
							</div>
						</div> <!-- media -->

						<p><b>Description</b></p>
						<p>
							<?php echo htmlspecialchars_decode($job_detail->description);?>
						</p>
					</div>
                    <!-- card -->
                    <hr>
                    <!-- <p>Expire At: <?php #echo date_format(new DateTime($job_detail->will_expire_at), "Y-m-d");?></p> -->
                    
				</div> <!-- end col -->
			</div> <!-- end row -->
		</div>
	</div>
</div>
