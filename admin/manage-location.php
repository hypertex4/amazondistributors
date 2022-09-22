<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Location Management<small>Amazon Distributors Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Manage Areas</li>
                        <li class="breadcrumb-item active">Add/Edit</li>
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
                        <h5>Area Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="Add Location Area" data-target="#addModal">Add Area</button>

                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="editModalLabel">Edit Area (Location)</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form name="updateLocation" id="updateLocation">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="edit_loc_area" class="font-weight-bold mb-1">Location Area</label>
                                                        <input class="form-control" id="edit_loc_area" name="edit_loc_area" type="text">
                                                        <input type="hidden" id="edit_loc_id" name="edit_loc_id">
                                                        <input type="hidden" name="action_code" value="901">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_loc_area_dest" class="font-weight-bold mb-1">Location Area</label>
                                                        <input class="form-control" id="edit_loc_area_dest" name="edit_loc_area_dest" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_loc_amt" class="font-weight-bold mb-1">Delivery Amount</label>
                                                        <input class="form-control" id="edit_loc_amt" name="edit_loc_amt" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_loc_state" class="font-weight-bold mb-1">State</label>
                                                        <input class="form-control" id="edit_loc_state" name="edit_loc_state" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_loc_country" class="font-weight-bold mb-1">Country</label>
                                                        <input class="form-control" id="edit_loc_country" name="edit_loc_country" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="updateLocationBtn">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Update
                                                </button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="editModalLabel">Add Area (Location)</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form name="addLocation" id="addLocation">
                                            <div class="modal-body">
                                                <div class="form">
                                                    <div class="form-group">
                                                        <label for="loc_area" class="font-weight-bold mb-1">Location Pickup Area</label>
                                                        <input class="form-control" id="loc_area" name="loc_area" type="text">
                                                        <input type="hidden" name="action_code" value="902">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="loc_area_dest" class="font-weight-bold mb-1">Location Destination Area</label>
                                                        <input class="form-control" id="loc_area_dest" name="loc_area_dest" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="loc_amt" class="font-weight-bold mb-1">Delivery Amount</label>
                                                        <input class="form-control" id="loc_amt" name="loc_amt" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="loc_state" class="font-weight-bold mb-1">State</label>
                                                        <input class="form-control" id="loc_state" name="loc_state" type="text" value="Lagos">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="loc_country" class="font-weight-bold mb-1">Country</label>
                                                        <input class="form-control" id="loc_country" name="loc_country" type="text" value="Nigeria">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="addLocationBtn">Save</button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered display" id="Location">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pickup Area</th>
                                <th>Destination Area</th>
                                <th>Delivery Fee</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $adm = $admin->list_location_areas();
                            if ($adm->num_rows > 0) { $n=0;
                            while ($admin = $adm->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= ++$n;?></td>
                                    <td><b><?= $admin['loc_area']; ?></b></td>
                                    <td><b><?= $admin['loc_area_dest']; ?></b></td>
                                    <td><b>₦ <?= number_format($admin['loc_amount'],0); ?></b></td>
                                    <td><?= $admin['loc_state']; ?></td>
                                    <td><?= $admin['loc_country']; ?></td>
                                    <td><?= date("d/m/Y H:i:s", strtotime($admin['loc_created_on'])); ?></td>
                                    <td>
                                        <div>
                                            <i style="cursor: pointer;" class="fa fa-edit mr-2 font-success" id="edit_location"  data-toggle="modal" data-target="#editModal"
                                               data-lid="<?=$admin['loc_id'];?>" data-loc_area="<?=$admin['loc_area'];?>" data-loc_amt="<?=$admin['loc_amount'];?>"
                                               data-loc_area_dest="<?=$admin['loc_area_dest'];?>"
                                               data-loc_state="<?=$admin['loc_state'];?>" data-loc_country="<?=$admin['loc_country'];?>">
                                            </i>
                                            <i style="cursor: pointer;" class="fa fa-trash font-danger" id="delete_location" data-loc_id="<?=$admin['loc_id']; ?>"></i>
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
        $('#Location').DataTable({
            "bSort":false
        });
    });
</script>