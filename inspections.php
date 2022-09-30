<?php
include 'config.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<div class="container p-4">

    <?php include('message.php') ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Inspections
                        <?php
                        if ($user_type == 'admin') {
                        ?>
                            <a href="create-inspection.php" class="btn btn-primary float-end">Add Inspection</a>
                        <?php
                        }

                        ?>

                    </h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Comments</th>
                                <th>Inspection Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_inspections = $conn->prepare("SELECT * FROM `inspections`");
                            $select_inspections->execute();
                            if ($select_inspections->rowCount() > 0) {
                                foreach ($select_inspections as $inspection) {
                            ?>
                                    <tr>
                                        <td><?= $inspection['id'] ?></td>
                                        <td><?= $inspection['address'] ?></td>
                                        <td><?= $inspection['status'] ?></td>
                                        <td><?= $inspection['comments'] ?></td>
                                        <td><?= $inspection['inspection_type'] ?></td>
                                        <td>
                                            <a href="inspection-view.php?id=<?= $inspection['id'] ?>" class="btn btn-info btn-sm">View</a>
                                            <?php
                                            if ($user_type == 'admin') {
                                            ?>
                                                <a href="inspection-edit.php?id=<?= $inspection['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                                                <form action="admin/inspection_codes.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_inspection" value="<?= $inspection['id'] ?>" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            <?php
                                            }
                                            ?>

                                        </td>

                                    </tr>
                            <?php

                                }
                            } else {
                                $_SESSION['message'] = 'No record found';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>