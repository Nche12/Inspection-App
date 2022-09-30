<?php
    include 'includes/header.php';
?>


    <div class="container mt-3">
        <?php include('message.php') ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Inspection
                            <a href="inspections.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="admin/inspection_codes.php" method="POST">

                            <div class="mb-3">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>

                            <div class="mb-3">
                                <select class="form-select" name="status" placeholder="Status" aria-label="Status">
                                    <option selected>Select Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Assigned">Assigned</option>
                                    <option value="Started">Started</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>

                            <div class="mb-3">
                            <input type="text" name="comments" class="form-control" placeholder="comments">
                            </div>

                            <div class="mb-3">
                                <select class="form-select" name="inspection_type" aria-label="Inspection Type" placeholder="Inspection Type">
                                    <option selected>Inspection Type</option>
                                    <option value="Inventory / Schedule of Condition">Inventory / Schedule of Condition</option>
                                    <option value="Check In / Move In">Check In / Move In</option>
                                    <option value="Check Out / Move Out">Check Out / Move Out</option>
                                    <option value="Self Service Inspection">Self Service Inspection</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="add_inspection">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php include 'includes/footer.php' ?>