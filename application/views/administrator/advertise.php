<table  id="advertise-table" class="table m-0 table-colored table-inverse table-hover table-colored-bordered table-bordered-inverse">
    <thead>
        <tr>
        
            <th>Company Logo</th>
            <th>Company ID</th>
            <th>Company Name</th>
            <th>Date Registered</th>
            <!-- <th>Advertisement Position</th> -->
        </tr>
    </thead>
    <tbody>

        <?php $i=1; foreach($companies as $c):?>
            <tr height="50" data-company-id="<?php echo $c->id;?>" data-position="<?php echo $c->ads_position;?>">
                <td><?php echo ($c->logo === '' || empty($c->logo)) ? '<img src="'.base_url('assets/uploads/no-img.png').'" alt="image" class="img-rounded img-responsive thumb-lg">' : '<img src="'.base_url('assets/uploads/'.$c->logo).'" alt="image" class="img-rounded img-responsive thumb-lg">';?></td>
                <td><?php echo $c->id?></td>
                <td><?php echo $c->name;?></td>
                <td><?php echo $c->date_registered;?></td>
                <!-- <td><?php #echo $c->ads_position;?></td> -->
            </tr>
        <?php $i++; endforeach;?>
    </tbody>
</table>

