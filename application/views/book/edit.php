<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Book Edit</h3>
            </div>
			<?php echo form_open('book/edit/'.$book['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="category_id" class="control-label"><span class="text-danger">*</span>Category</label>
						<div class="form-group">
							<select name="category_id" class="form-control">
								<option value="">select category</option>
								<?php 
								foreach($all_categories as $category)
								{
									$selected = ($category['id'] == $book['category_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$category['id'].'" '.$selected.'>'.$category['name'].'</option>';
								} 
								?>
							</select>
							<span class="text-danger"><?php echo form_error('category_id');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="author" class="control-label"><span class="text-danger">*</span>Author</label>
						<div class="form-group">
							<input type="text" name="author" value="<?php echo ($this->input->post('author') ? $this->input->post('author') : $book['author']); ?>" class="form-control" id="author" />
							<span class="text-danger"><?php echo form_error('author');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="publisher" class="control-label"><span class="text-danger">*</span>Publisher</label>
						<div class="form-group">
							<input type="text" name="publisher" value="<?php echo ($this->input->post('publisher') ? $this->input->post('publisher') : $book['publisher']); ?>" class="form-control" id="publisher" />
							<span class="text-danger"><?php echo form_error('publisher');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="price" class="control-label">Price</label>
						<div class="form-group">
							<input type="text" name="price" value="<?php echo ($this->input->post('price') ? $this->input->post('price') : $book['price']); ?>" class="form-control" id="price" />
							<span class="text-danger"><?php echo form_error('price');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="discount" class="control-label">Discount</label>
						<div class="form-group">
							<input type="text" name="discount" value="<?php echo ($this->input->post('discount') ? $this->input->post('discount') : $book['discount']); ?>" class="form-control" id="discount" />
							<span class="text-danger"><?php echo form_error('discount');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="published_date" class="control-label">Published Date</label>
						<div class="form-group">
							<input type="text" name="published_date" value="<?php echo ($this->input->post('published_date') ? $this->input->post('published_date') : $book['published_date']); ?>" class="form-control" id="published_date" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="number_of_sales" class="control-label">Number Of Sales</label>
						<div class="form-group">
							<input type="text" name="number_of_sales" value="<?php echo ($this->input->post('number_of_sales') ? $this->input->post('number_of_sales') : $book['number_of_sales']); ?>" class="form-control" id="number_of_sales" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label"><span class="text-danger">*</span>Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $book['name']); ?>" class="form-control" id="name" />
							<span class="text-danger"><?php echo form_error('name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="ISBN" class="control-label"><span class="text-danger">*</span>ISBN</label>
						<div class="form-group">
							<input type="text" name="ISBN" value="<?php echo ($this->input->post('ISBN') ? $this->input->post('ISBN') : $book['ISBN']); ?>" class="form-control" id="ISBN" />
							<span class="text-danger"><?php echo form_error('ISBN');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="description" class="control-label">Description</label>
						<div class="form-group">
							<textarea name="description" class="form-control" id="description"><?php echo ($this->input->post('description') ? $this->input->post('description') : $book['description']); ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>