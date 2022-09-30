<?php
require('config.php');
include 'includes/header.php';
?>
<div class="container mt-3">
    <?php include('message.php') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Inspection
                        <a href="inspections.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $inspection_id = $_GET['id'];
                        $select = $conn->prepare("SELECT * FROM `inspections` WHERE id = ?");
                        $select->execute([$inspection_id]);

                        $inspection_detail = $select->fetch(PDO::FETCH_ASSOC);
                        if ($select->rowCount() > 0) {
                    ?>
                            <form action="admin/inspection_codes.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="inspection_id" value="<?= $inspection_detail['id']; ?>">
                                <div class="mb-3">
                                    <input type="text" name="address" value="<?= $inspection_detail['address']; ?>" class="form-control" placeholder="Address">
                                </div>

                                <div class="mb-3">
                                    <select class="form-select" name="status" value="<?= $inspection_detail['status']; ?>" placeholder="Status" aria-label="Status">
                                        <option selected>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Assigned">Assigned</option>
                                        <option value="Started">Started</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="comments" value="<?= $inspection_detail['comments']; ?>" class="form-control" placeholder="Comments">
                                </div>

                                <div class="mb-3">
                                    <select class="form-select" name="inspection_type" value="<?= $inspection_detail['inspection_type']; ?>" aria-label="Inspection Type" placeholder="Inspection Type">
                                        <option selected>Inspection Type</option>
                                        <option value="Inventory / Schedule of Condition">Inventory / Schedule of Condition</option>
                                        <option value="Check In / Move In">Check In / Move In</option>
                                        <option value="Check Out / Move Out">Check Out / Move Out</option>
                                        <option value="Self Service Inspection">Self Service Inspection</option>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <input type="file" class="form-control" name="images[]" accept="image/jpg, image/png, image/jpeg" multiple>
                                </div>

                                <div class="mb-3 gallery-body">
                                    <?php
                                    $select_images = $conn->prepare("SELECT * FROM `images` WHERE inspection_id = ?");
                                    $select_images->execute([$inspection_id]);
                                    foreach ($select_images as $image) {
                                    ?>
                                        <div class="gallery">
                                            <img src="uploaded_img/<?= $image['img_name'] ?>" alt="" width="50px" height="50px">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>


                                <button type="submit" class="btn btn-primary" name="update_inspection">Update</button>

                            </form>
                    <?php

                        } else {
                            echo "<h4>No Id Found</h4>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>