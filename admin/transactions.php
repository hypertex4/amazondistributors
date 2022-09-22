<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Payments<small>Amazon Distributors Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Payments</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Transactions</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered display" id="Payment">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pickup ID</th>
                                <th>Amount</th>
                                <th>Payment Reference</th>
                                <th>Status</th>
                                <th>Created On</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $adm = $admin->list_pickup_request();
                            if ($adm->num_rows > 0) { $n=0;
                                while ($admin = $adm->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= ++$n;?></td>
                                        <td><b><?= $admin['pickup_id']; ?></b></td>
                                        <td><b>₦ <?= number_format($admin['payment_amount'],0); ?></b></td>
                                        <td><?= $admin['payment_ref']; ?></td>
                                        <td>
                                            <?=($admin['payment_status']=='Unverified')?
                                                '<span class="badge badge-danger">Pending</span>':
                                                '<span class="badge badge-success">Paid</span>';?>
                                        </td>
                                        <td><?= date("d/m/Y H:i:s", strtotime($admin['p_created_on'])); ?></td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
<script>
    $(document).ready(function() {
        $('#Payment').DataTable({
            "bSort":false
        });
    });
</script>