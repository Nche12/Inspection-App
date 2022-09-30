<?php
require('config.php');
include 'includes/header.php';
?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>View Inspection Details
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
                            <form action="admin/inspection_codes.php" method="POST">
                                <div class="mb-3">
                                    <p class="form-control">
                                        <?= $inspection_detail['address']; ?>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <p class="form-control">
                                        <?= $inspection_detail['status']; ?>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <p class="form-control">
                                        <?= $inspection_detail['comments']; ?>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <p class="form-control">
                                        <?= $inspection_detail['inspection_type']; ?>
                                    </p>
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

<?php include 'includes/footer.php' ?>