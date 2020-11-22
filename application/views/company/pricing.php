<?php if(!empty($subscription)):?>
<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info"></i> Subscription Details</h3>
    </div>
    <div class="panel-body">
        <p><strong><i class="fa fa-gear"></i> Current Subscription:</strong> <?php echo $subscription->description;?></p>
        <p><strong><i class="fa fa-edit"></i> Max Post:</strong> <?php echo $subscription->max_post;?></p>
        <p><strong><i class="fa fa-money"></i> Price:</strong> $ <?php echo $subscription->pricing;?></p>
    </div>
</div>
<?php endif;?>
<div class="row">
    <div class="col-lg-9 center-page">
        <div class="text-center">
            <h3 class="m-b-30 m-t-20">Choose your perfect Subscription Plan</h3>
            <p>
                JAQM Subscription Details
            </p>
        </div>
        <div class="row m-t-50">
            <?php $i = 1; foreach($rates as $rate):?>
                <?php if($rate->id != 9): ?>
                <article class="pricing-column col-lg-4 col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title"><?php echo $rate->description.' '.'Subscription';?></h3>
                            <h2 class="plan-price"><?php echo '$ '.$rate->pricing;?></h2>
                            <div class="plan-duration"><strong><?php echo $rate->description?></strong></div>
                        </div>
                        <ul class="plan-stats list-unstyled text-center">
                            <li>Maximum of <?php echo $rate->max_post; ?> post allowerd</li>
                            
                        </ul>
                        <div class="text-center">
                            <button id="process-subscription-<?php echo $i; $i++;?>" data-company-id="<?php echo $company_id;?>" data-rate-type="<?php echo $rate->id;?>" data-rate-price="<?php echo $rate->pricing;?>" class="btn-link waves-effect waves-light"></button>
                        </div>
                    </div>
                </article>
                <?php endif;?>
            <?php endforeach;?>
        </div>
    </div><!-- end col -->
</div>