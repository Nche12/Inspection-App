<?php
include 'config.php';
include 'includes/login_register_header.php';
include 'message.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="p-4">
        <form action="admin/inspection_codes.php" method="POST" class="border shadow p-3 rounded" style="width: 450px;" enctype="multipart/form-data">
            <h1 class="text-center p-3">SIGN UP</h1>
            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Username">
            </div>

            <div class="mb-3">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="cpass" placeholder="Repeat Password">
            </div>

            <div class="mb-1">
                <label class="form-label">Select User Type: </label>
            </div>

            <select class="form-select mb-3" aria-label="Default select example" name="user_type" aria-placeholder="User Role">
                <option selected value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <div class="mb-3">
                <input type="file" class="form-control" name="image" accept="image/jpg,image/png, image/jpeg">
            </div>

            <p>Already have an Account? <a href="login.php">Login Now</a></p>

            <div class="text-center">
                <button type="submit" name="register_user" class="btn btn-primary">SIGN UP</button>
            </div>
        </form>
    </div>

</div>

<?php include 'includes/footer.php' ?>