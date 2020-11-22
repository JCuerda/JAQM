
<div class="col-lg-12">
   
    <div id="search-result">
        <div class="col-lg-10">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><b>Jobs Matching based on your Qualification</b></h3>
                </div>
                <?php if(count($jobs) > 0):?>				
                <div class="panel-body">               
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="search-result-box m-t-30">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php for ($i = 0; $i < count($jobs); $i++):?>
                                            <div class="search-item">
                                                <h3 class="h4 font-600 m-b-5"><a href="<?php echo base_url('client/view-job/'.$jobs[$i]->id);?>"><?php echo $jobs[$i]->title;?></a></h3>
                                                <div class="font-13 text-success m-b-10">
                                                    <?php echo $jobs[$i]->name;?>
                                                    <span class="pull-right" style="font-size: 18px;"><strong><?php echo bcdiv($jobs[$i]->percentage_match, 1, 2); ?> %</strong></span>
                                                </div>
                                                <p class="m-b-0">
                                                    <?php 
                                                        $description = strip_tags($jobs[$i]->description);
                                                        if(strlen($description) > 500){
                                                        
                                                            $start = substr($description, 0, 500);
                                                            $endPoint = strrpos($start, '');

                                                            $sd = $endPoint ? substr($start, 0, $endPoint) : substr($start, 0);
                                                            $sd .= ' .. <a href='. base_url('client/view-job/'.$jobs[$i]->id) .'>View More Details</a>';

                                                            echo strip_tags(htmlspecialchars_decode($sd));
                                                        } else {
                                                            echo strip_tags(htmlspecialchars_decode($description));
                                                        }
                                                    ?>
                                                   
                                                    <!-- <div class="clearfix"></div> -->
                                                </p>
                                            </div>
                                        <?php endfor;?>
                                        <?php #echo $links;?>
                                        <!-- <ul class="pagination pagination-split pull-right">
                                            <li class="disabled">
                                                <a href="#"><i class="fa fa-angle-left"></i></a>
                                            </li>
                                            <li>
                                                <a href="#">1</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">2</a>
                                            </li>
                                            <li>
                                                <a href="#">3</a>
                                            </li>
                                            <li>
                                                <a href="#">4</a>
                                            </li>
                                            <li>
                                                <a href="#">5</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-angle-right"></i></a>
                                            </li>
                                        </ul> -->

                                        <div class="clearfix"></div>
                                    </div>

                                    <!-- end All results tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else:?>
                <div class="panel-body" style="height: 100%;">
                    <div class="row">
                        <div class="col-sm-12 text-center">

                            <div class="wrapper-page">
                                <img src="<?php echo base_url("assets/build/images/animat-search-color.gif")?>" alt="" height="120">
                                <h2 class="text-uppercase text-danger">No Matching jobs found</h2>
                                <p class="text-muted">Sorry, The system cannot find any matching jobs based
                                    on your qualification. Please try again later.</p>

                                <a class="btn btn-success waves-effect waves-light m-t-20" href="<?php echo base_url("client/")?>"> Return Home</a>
                            </div>

                        </div>
                    </div>
                    <h4 class="text-center"></h4>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div id="ads">
        <div class="col-lg-2">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"> Top Companies </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <!-- <div class="portlet-body"> -->
                        <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum. -->
                        <?php foreach ($companies as $c):?>
                            <p>
                            <?php echo ($c->logo === '' || empty($c->logo)) ? '<img src="'.base_url('assets/uploads/no-img.png').'" alt="image" class="img-rounded img-responsive m-t-10 m-b-10">' : '<img src="'.base_url('assets/uploads/'.$c->logo).'" alt="image" class="img-rounded img-responsive m-t-10 m-b-10">';?>
                            </p>
                        <?php endforeach;?>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
