<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Pickup Request<small>Amazon Distributors Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Pickup Request</li>
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
                        <h5>Pickup Requests</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered display table-responsive" id="Payment" style="font-size:11px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pickup ID</th>
                                <th>S.State</th>
                                <th>SenderArea</th>
                                <th>SenderAddress</th>
                                <th>Sender Name</th>
                                <th>Sender Email</th>
                                <th>Sender Phone</th>
                                <th>R.State</th>
                                <th>ReceiverArea</th>
                                <th>ReceiverAddress</th>
                                <th>Receiver Name</th>
                                <th>Receiver Email</th>
                                <th>Receiver Phone</th>
                                <th>Weight</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
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
                                        <td><?= $admin['from_state']; ?></td>
                                        <td><?= $admin['from_area']; ?></td>
                                        <td><?= $admin['from_address']; ?></td>
                                        <td><?= $admin['from_fullname']; ?></td>
                                        <td><?= $admin['from_email']; ?></td>
                                        <td><?= $admin['from_phone']; ?></td>
                                        <td><?= $admin['to_state']; ?></td>
                                        <td><?= $admin['to_area']; ?></td>
                                        <td><?= $admin['to_address']; ?></td>
                                        <td><?= $admin['to_firstname']." ".$admin['to_lastname']; ?></td>
                                        <td><?= $admin['to_email']; ?></td>
                                        <td><?= $admin['to_phone']; ?></td>
                                        <td><?= $admin['p_weight']; ?> Kg</td>
                                        <td><?= $admin['p_amount']; ?></td>
                                        <td>
                                            <?php
                                                if($admin['pickup_status']=='New Pickup') {
                                                    echo '<span class="badge badge-dark">New Pickup</span>';
                                                } elseif ($admin['pickup_status']=='In Transit'){
                                                    echo '<span class="badge badge-info">In Transit</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">Delivered</span>';
                                                }
                                            ?>
                                        </td>
                                        <td><?= date("d/m/Y H:i:s", strtotime($admin['p_created_on'])); ?></td>
                                        <td>
                                            <div style="width:150px;">
                                                <?php if($admin['pickup_status']=='New Pickup' && $admin['pickup_status'] !='Delivered') { ?>
                                                <button class="btn btn-info btn-xs py-2 rounded-0" id="statusBtn" data-status="In Transit"
                                                        data-pickup_id="<?= $admin['pickup_id']; ?>"
                                                        data-s_name="<?= $admin['to_firstname']." ".$admin['to_lastname']; ?>"
                                                        data-s_email="<?= $admin['to_email']; ?>" type="button">
                                                    In transit
                                                </button>
                                                <?php } ?>
                                                <?php if($admin['pickup_status']=='In Transit') { ?>
                                                <button class="btn btn-success btn-xs py-2 rounded-0" id="statusBtn" data-status="Delivered"
                                                        data-pickup_id="<?= $admin['pickup_id']; ?>"
                                                        data-s_name="<?= $admin['to_firstname']." ".$admin['to_lastname']; ?>"
                                                        data-s_email="<?= $admin['to_email']; ?>" type="button">
                                                    Delivered
                                                </button>
                                                <?php } ?>
                                            </div>
                                        </td>
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