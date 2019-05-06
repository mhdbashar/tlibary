<section class="content-header">
    <div class="box ">
        <div class="box-header with-border">
        <h1 class="box-title">
            TLibrary Statistics
        </h1>
    </div>   
    </div>    

    </section>
<div class="row">
    <div class="col-md-12">
        <!-- <div class="row"> -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3><?php echo $books_count;?></h3>

                    <p>Number of Books</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo site_url('book');?>" class="small-box-footer">
                    more <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3><?php echo $orders_count;?></h3>

                    <p>Number of Orders</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo site_url('order');?>" class="small-box-footer">
                    more <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>
        <!-- </div> -->
    </div>
</div>