<div class="col-lg-12">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-building"></i> <?php echo $company->name;?></h2>
            <p class="panel-sub-title font-15 text-muted"><i class="fa fa-map"></i> Address: <?php echo $company->address;?></p>
            <p class="panel-sub-title font-15 text-muted"><i class="fa fa-phone"></i> Contact #: <?php echo $company->contact_number;?></p>
            <p class="panel-sub-title font-15 text-muted"><i class="fa fa-certificate text-success"></i> Status: <strong class="text-success"><?php echo ($company->is_active == 'Y') ? 'Active' : 'Inactive';?></strong></p>
        </div>
        <div class="panel-body">
            <?php echo $company->description;?>
        </div>
    </div>
</div>