<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Books Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('book/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Category Id</th>
						<th>Author</th>
						<th>Publisher</th>
						<th>Price</th>
						<th>Discount</th>
						<th>Published Date</th>
						<th>Number Of Sales</th>
						<th>Name</th>
						<th>ISBN</th>
						<th>Description</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($books as $b){ ?>
                    <tr>
						<td><?php echo $b['id']; ?></td>
						<td><?php echo $b['category_id']; ?></td>
						<td><?php echo $b['author']; ?></td>
						<td><?php echo $b['publisher']; ?></td>
						<td><?php echo $b['price']; ?></td>
						<td><?php echo $b['discount']; ?></td>
						<td><?php echo $b['published_date']; ?></td>
						<td><?php echo $b['number_of_sales']; ?></td>
						<td><?php echo $b['name']; ?></td>
						<td><?php echo $b['ISBN']; ?></td>
						<td><?php echo $b['description']; ?></td>
						<td>
                            <a href="<?php echo site_url('book/edit/'.$b['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('book/remove/'.$b['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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
