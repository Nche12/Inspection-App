<?php
require '../config.php';
session_start();

if (isset($_POST['register_user'])) {
    $name = $_POST['name'];
    $name = htmlspecialchars($name);
    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    $pass = md5($_POST['pass']);
    $pass = htmlspecialchars($pass);
    $cpass = md5($_POST['cpass']);
    $cpass = htmlspecialchars($cpass);
    $user_type = $_POST['user_type'];
    $user_type = htmlspecialchars($user_type);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_img/' . $image;

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);

    if ($select->rowCount() > 0) {
        $_SESSION['message'] = 'User already exists';
        header('location: ../register.php');
        exit(0);
    } elseif ($image_size > 2000000) {
        $_SESSION['message'] = 'Image is too large';
        header('location: ../register.php');
        exit(0);
    } else {
        if ($pass != $cpass) {
            $_SESSION['message'] = 'Confirm password not matched!';
            header('location: ../register.php');
            exit(0);
        } else {
            $insert = $conn->prepare("INSERT INTO `users`(name, email, password, user_type, image) VALUES(?,?,?,?,?)");
            $insert->execute([$name, $email, $cpass, $user_type, $image]);
            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $_SESSION['message'] = 'Registered Successfully';
                header('location: ../login.php');
                exit(0);
            }
        }
    }
}

if (isset($_POST['login_user'])) {
    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    $pass = md5($_POST['pass']);
    $pass = htmlspecialchars($pass);

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {

        if (isset($row['id'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            header('location: ../inspections.php');
            exit(0);
        } else {
            $_SESSION['message'] = 'No user found';
            header('location: ../login.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = 'Incorrect email or password';
        header('location: ../login.php');
        exit(0);
    }
}

if (isset($_POST['delete_inspection'])) {
    $inspection_id = $_POST['delete_inspection'];

    $delete = $conn->prepare("DELETE FROM `inspections` WHERE id = ?");
    $delete->execute([$inspection_id]);

    if ($delete) {
        $_SESSION['message'] = "Inspection Deleted Successfully";
        header('location: ../inspections.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Inspection not Deleted";
        header("location: ../inspections.php");
        exit(0);
    }
}

if (isset($_POST['update_inspection'])) {
    $inspection_id = $_POST['inspection_id'];
    $inspection_id = htmlspecialchars($inspection_id);
    $address = $_POST['address'];
    $address = htmlspecialchars($address);
    $status = $_POST['status'];
    $status = htmlspecialchars($status);
    $comments = $_POST['comments'];
    $comments = htmlspecialchars($comments);
    $inspection_type = $_POST['inspection_type'];
    $inspection_type = htmlspecialchars($inspection_type);



    $update = $conn->prepare("UPDATE `inspections` SET address = ?, status = ?, comments = ?, inspection_type = ? WHERE id = ?");
    $update->execute([$address, $status, $comments, $inspection_type, $inspection_id]);

    if ($update) {
        $images = $_FILES['images'];
        $num_of_imgs = count($images['name']);
            if($_FILES['images']['size'][0] != 0) {
            for ($i = 0; $i < $num_of_imgs; $i++) {
                $image_name = $images['name'][$i];
                $tmp_name = $images['tmp_name'][$i];
                $error = $images['error'][$i];
                print_r($error);

                if ($error === 0) {
                    $img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;

                        $img_upload_path = '../uploaded_img/' . $new_img_name;

                        $insert_images = $conn->prepare("INSERT INTO `images`(img_name, inspection_id) VALUES (?,?)");
                        $insert_images->execute([$new_img_name, $inspection_id]);

                        move_uploaded_file($tmp_name, $img_upload_path);

                        $_SESSION['message'] = "Images uploaded Successfully";

                    } else {
                        $_SESSION['message'] = "You can't upload files of this type";
                        if ($i === ($num_of_imgs - 1)) {
                            header("location: ../inspection-edit.php");
                            exit(0);
                        }
                    }
                } else {
                    $_SESSION['message'] = "Unknown Error Occurred while uploading";
                    header("location: ../inspection-edit.php");
                    exit(0);
                }
            }
        }

        $_SESSION['message'] = 'Inspection Updated Successfully';
        header("location: ../inspections.php");
        exit(0);
    } else {
        $_SESSION['message'] = 'Inspection not Updated';
        header("location: ../inspections.php");
        exit(0);
    }
}

if (isset($_POST['add_inspection'])) {
    $address = $_POST['address'];
    $address = htmlspecialchars($address);
    $status = $_POST['status'];
    $status = htmlspecialchars($status);
    $comments = $_POST['comments'];
    $comments = htmlspecialchars($comments);
    $inspection_type = $_POST['inspection_type'];
    $inspection_type = htmlspecialchars($inspection_type);

    $insert = $conn->prepare("INSERT INTO  `inspections`(address, status, comments, inspection_type) VALUES(?,?,?,?)");
    $insert->execute([$address, $status, $comments, $inspection_type]);
    if ($insert) {
        $_SESSION['message'] = 'Inspection Created Successfully';
        header("location: ../inspections.php");
        exit(0);
    } else {
        $_SESSION['message'] = 'Inspection not Created';
        header("location: ../create-inspection.php");
        exit(0);
    }
}
