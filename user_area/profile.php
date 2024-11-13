<?php
include('../functions/common_function.php');
include('../includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!-- bootsstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="../images/logo.webp" alt="logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item() ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price() ?>/-</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- calling cart function -->
    <?php
    cart();
    ?>

    <!-- login -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">

            <?php
            if (!isset($_SESSION['username'])) {
                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome Guest</a>
                </li>
                <li class='nav-item'>
                    <a href='user_login.php' class='nav-link'>Login</a>
                </li>
                ";
            } else {
                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                </li>
                <li class='nav-item'>
                    <a href='user_login.php' class='nav-link'>Logout</a>
                </li>
                ";
            }
            ?>

        </ul>
    </nav>

    <!-- header -->
    <div class="bg-light">
        <h3 class="text-center">eCom Store</h3>
        <p class="text-center">With the right tools possibilities are endless</p>
    </div>
    <!-- content -->
    <div class="container d-flex align-items-start p-0 mx-0">
        <div class="col-md-2 h-100 p-0">
            <ul class="navbar-nav bg-secondary text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light">
                        <h4>Your Profile</h4>
                    </a>
                </li>
                <?php
                $username = $_SESSION['username'];
                $user_image = "SELECT * FROM user_table WHERE username = '$username'";
                $result_image_query = mysqli_query($con, $user_image);
                $row_image = mysqli_fetch_array($result_image_query);
                $user_image = $row_image['user_image'];
                echo "<li class='nav-item'>
                <img src='./user_images/$user_image' alt='' class='w-100 h-100 d-block m-auto p-4 object-fit-contain'>
            </li>"
                ?>


                <li class="nav-item">
                    <a href="profile.php" class="nav-link text-light">
                        <h4>Pending Orders</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php?edit_account" class="nav-link text-light">
                        <h4>Edit Account</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php?my_orders" class="nav-link text-light">
                        <h4>My Orders</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php?delete_account" class="nav-link text-light">
                        <h4>Delete Account</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-light">
                        <h4>Logout</h4>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 text-center">
            <?php get_user_order_details();
            if (isset($_GET['edit_account'])) {
                include('edit_account.php');
            }
            if (isset($_GET['my_orders'])) {
                include('user_orders.php');
            }
            if (isset($_GET['delete_account'])) {
                include('delete_account.php');
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <?php include("../includes/footer.php") ?>

    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>