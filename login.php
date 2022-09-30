<?php
include 'includes/login_register_header.php';
// include 'message.php';

?>


<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="p-4">
        <form action="admin/inspection_codes.php" method="POST" class="border shadow p-3 rounded" style="width: 450px;" enctype="multipart/form-data">
            <h1 class="text-center p-3">LOGIN</h1>

            <div class="mb-3">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>

            <p>Don't have an Account? <a href="register.php">Register Now</a></p>

            <div class="text-center">
                <button type="submit" name="login_user" class="btn btn-primary">Login</button>
            </div>

        </form>
    </div>

</div>

<?php include 'includes/footer.php' ?>