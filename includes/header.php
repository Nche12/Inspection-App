<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if ($user_id) {
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="../navbar/background_styles.css">
    <link rel="stylesheet" href="../navbar/styles.css">
    <script src="../navbar/script.js" defer></script>

    <script>
        $(document).on('click', '.deleteInspection', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                a;ert('Am in');
            }
        });
    </script>

    <title>Inspections</title>
</head>

<body>

    <nav class="navbar">
        <div class="brand-title">Inspections</div>
        <!-- <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a> -->
        <!-- <div class="navbar-links">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div> -->
        <div class="navbar-brand">
            <img src="../uploaded_img/<?= $fetch_profile['image'] ?>" width="40" height="40" class="rounded-circle" alt="logo">
            <a type="button" href="../logout.php" class="btn btn-outline-light btn-sm"> Logout</a>
        </div>

    </nav>