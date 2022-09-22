<?php require_once('inc/header.inc.php'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Dashboard <small>Amazon Distributors Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden widget-cards">
                    <div class="bg-success card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Pickup</span>
                                <h3 class="mb-0"><span class="counter"><?=$admin->count_all_pickup();?></span><small> No of pickup</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="message-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-primary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Delivery Total Amount</span>
                                <h3 class="mb-0">₦ <span class="counter"><?= number_format($admin->today_booking_amt(),0);?></span><small> Today</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-primary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Delivery Total Amount</span>
                                <h3 class="mb-0">₦ <span class="counter"><?= number_format($admin->month_booking_amt(),0);?></span><small> This Month</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5 col-md-5 mx-auto">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget">
                            <div class="media-body"><span class="m-0">Total Delivery Sales</span>
                                <h3 class="mb-0">₦ <span class="counter"><?=number_format($admin->total_booking_amt(),0);?></span><small> Total</small></h3>
                            </div>
                            <div class="icons-widgets">
                                <i data-feather="box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 xl-100">
                <div class="card">
                    <div class="card-header">
                        <h5>Latest Pickup Request</h5>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive latest-order-table">
                            <table class="table table-bordernone">
                                <thead>
                                <tr>
                                    <th>s/n</th>
                                    <th>Pickup ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Requested On</th>
                                </thead>
                                <tbody>
                                <?php
                                $ord = $admin->list_latest_five_pickup_request();
                                if ($ord->num_rows > 0) {$n=0;
                                while ($order = $ord->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?=++$n;?></td>
                                    <td>#<?=$order['pickup_id'];?></td>
                                    <td class="font-success digits">₦ <?=number_format($order['p_amount'],0);?></td>
                                    <td>
                                        <?php
                                        if($order['pickup_status']=='New Pickup') {
                                            echo '<span class="badge badge-dark">New Pickup</span>';
                                        } elseif ($order['pickup_status']=='In Transit'){
                                            echo '<span class="badge badge-info">In Transit</span>';
                                        } else {
                                            echo '<span class="badge badge-success">Delivered</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= date("d/m/Y H:i:s", strtotime($order['p_created_on'])); ?></td>
                                </tr>
                            <?php } } ?>
                                </tbody>
                            </table>
                            <a href="delivery-request" class="btn btn-primary">View All Delivery</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('inc/footer.inc.php'); ?>