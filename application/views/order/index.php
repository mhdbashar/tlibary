<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Orders Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('order/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Username</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Create Date</th>
						<th>Order Description</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($orders as $o){ ?>
                    <tr>
						<td><?php echo $o['id']; ?></td>
						<td><?php echo $o['username']; ?></td>
						<td><?php echo $o['phone']; ?></td>
						<td><?php echo $o['email']; ?></td>
						<td><?php echo $o['create_date']; ?></td>
						<td><?php echo $o['order_description']; ?></td>
						<td>
                            <a href="<?php echo site_url('order/edit/'.$o['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('order/remove/'.$o['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div class="pull-right">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>
