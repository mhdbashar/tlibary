    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Books
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(''); ?>"><i class="fa fa-dashboard"></i>dashboard</a></li>
            <li><a href="#">books</a></li>
        </ol>
    </section>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
                <h3></h3>
                <br />
                <div class="box-body">
                <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Book</button>
                <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <br />
                <br />
                <table id="book-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Category</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Description</th>
                            <th>Published Date</th>
                            <th style="width:100px;">Photo</th>
                            <th style="width:15px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
        
                    <tfoot>
                    <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Description</th>
                            <th>Published Date</th>
                            <th style="width:100px;">Photo</th>
                            <th style="width:150px;">Action</th>
                    </tr>
                    </tfoot>
                </table>
        </div>

        </div>
    </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Book Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Category</label>
                            <div class="col-md-9">
                            <select name="category_id" class="form-control">
                                 <option value="" selected>-- Select Category --</option>                                                               
                                 <?php foreach ($Categories as $category) {
                                  ?>
                                  <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                   <?php
                                    } ?>
                                    </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ISBN</label>
                            <div class="col-md-9">
                                <input name="ISBN" placeholder="ISBN" class="form-control" type="text">
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Author</label>
                            <div class="col-md-9">
                                <input name="author" placeholder="Author" class="form-control" type="text">
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Publisher</label>
                            <div class="col-md-9">
                                <input name="publisher" placeholder="Publisher" class="form-control" type="text">
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-9">
                                <input name="price" placeholder="Price" class="form-control" type="number">
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Discount</label>
                            <div class="col-md-9">
                                <input name="discount" placeholder="Discount" class="form-control" type="number">
                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" placeholder="Description" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Published Date</label>
                            <div class="col-md-9">
                                <input name="published_date" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Photo </label>
                            <div class="col-md-9">
                                <input name="photo" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
 
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {    

$(document).ready(function() {
   //datatables
   table = $('#book-table').DataTable({ 

       "processing": true, //Feature control the processing indicator.
       "serverSide": true, //Feature control DataTables' server-side processing mode.
       "order": [], //Initial no order.

       // Load data for the table's content from an Ajax source
       "ajax": {
           "url": "<?php echo site_url('Book/ajax_list') ?>",
           "type": "POST"
       },

       //Set column definition initialisation properties.
       "columnDefs": [
           { 
               "targets": [ -1 ], //last column
               "orderable": false, //set not orderable
           },
           { 
               "targets": [ -2 ], //2 last column (photo)
               "orderable": false, //set not orderable
           },
           
       ],

   });

   //datepicker
   $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

    
    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    });
    });
</script>


<script type="text/javascript">
var save_method; //for save method string
var table;
var base_url = '<?php echo base_url();?>';
 
 
function add_book()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Book'); // Set Title to Bootstrap modal title
 
    $('#photo-preview').hide(); // hide photo preview modal
 
    $('#label-photo').text('Upload Photo'); // label photo upload
}
 
function edit_book(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
 
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('book/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
        // `id`, `name`, `category_id`, `ISBN`, `author`, `publisher`, `price`, `description`, `discount`, `published_date`, `photo`
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
            $('[name="category_id"]').val(data.category_id);
            $('[name="ISBN"]').val(data.ISBN);
            $('[name="author"]').val(data.author);
            $('[name="publisher"]').val(data.publisher);
            $('[name="price"]').val(data.price);
            $('[name="description"]').val(data.description);
            $('[name="discount"]').val(data.discount);
            $('[name="published_date"]').datepicker('update',data.published_date);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
 
            $('#photo-preview').show(); // show photo preview modal
 
            if(data.photo)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'upload/'+data.photo+'" class="img-responsive">'); // show photo
                $('#photo-preview div').append('<input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo
 
            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo-preview div').text('(No photo)');
            }
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
 
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
 
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    if(save_method == 'add') {
        url = "<?php echo site_url('book/ajax_add')?>";
    } else {
        url = "<?php echo site_url('book/ajax_update')?>";
    }
 
    // ajax adding data to database
 
    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}
 
function delete_book(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('book/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}
 
</script>