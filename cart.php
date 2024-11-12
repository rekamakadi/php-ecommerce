<?php
include('functions/common_function.php');
include('includes/connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website - Cart Details</title>
    <!-- bootsstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info">
            <div class="container-fluid">
                <img src="./images/logo.webp" alt="logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='user_area/profile.php'>My Account</a>
                            </li>";
                        } else {
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='user_area/user_registration.php'>Register</a>
                            </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item() ?></sup></a>
                        </li>
                    </ul>
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
                    <a href='./user_area/user_login.php' class='nav-link'>Login</a>
                </li>
                ";
            } else {
                echo "<li class='nav-item'>
                    <a href='#' class='nav-link'>Welcome " . $_SESSION['username'] . "</a>
                </li>
                <li class='nav-item'>
                    <a href='./user_area/user_login.php' class='nav-link'>Logout</a>
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

    <!-- table -->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">


                    <?php
                    global $con;
                    $ip = getIPAddress();
                    $total = 0;
                    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "<thead>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </thead> 
                    <tbody>";

                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                            $result_products = mysqli_query($con, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $total += $product_price * $row['quantity'];
                    ?>
                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="/admin_area/product_images/<?php echo $product_image1 ?>" alt="" class="cart-img"></td>
                                    <td>
                                        <?php
                                        if (isset($_POST['update_cart'])) {
                                            foreach ($_POST['qty'] as $product_id => $quantity) {
                                                if (is_numeric($quantity) && $quantity > 0) {
                                                    $update_cart = "UPDATE cart_details SET quantity = $quantity WHERE ip_address = '$ip' AND product_id = $product_id";
                                                    $result_products_quantity = mysqli_query($con, $update_cart);

                                                    if (!$result_products_quantity) {
                                                        echo "Error updating cart: " . mysqli_error($con);
                                                    }
                                                }
                                            }
                                            echo "<script>alert('Cart updated successfully!'); window.location.href='cart.php';</script>";
                                        }
                                        ?> <input type="number" name="qty[<?php echo $product_id; ?>]" class="form-input w-50" min="1" value="<?php echo $row['quantity']; ?>">
                                    </td>
                                    <td><?php echo $product_price * $row['quantity'] ?>/-</td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                                    <td>
                                        <input type="submit" value="Update cart" class="bg-info p-3 border-0" name="update_cart">
                                        <!-- <button type="submit" class="bg-info p-3 border-0" name="remove_item" value="<?php echo $product_id; ?>">Remove</button> -->
                                        <input type="submit" value="Remove from cart" class="bg-info p-3 border-0" name="remove_cart">
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                    }
                    ?>
                    </tbody>
                </table>
                <!-- subtotal -->
                <div class="d-flex mb-5">
                    <?php
                    global $con;
                    $ip = getIPAddress();
                    $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "<h4 class='px-3'>Subtotal: <strong class='text-info'> $total/-</strong></h4>
                    <input type='submit' value='Continue Shopping' class='bg-info p-3 border-0' name='continue_shopping'>
                    <button class='bg-secondary  p-3 border-0 text-light'><a href='user_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button>";
                    } else {
                        echo "<input type='submit' value='Continue Shopping' class='bg-info p-3 border-0' name='continue_shopping'>";
                    }

                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.open('index.php', '_self')</script>";
                    }
                    ?>

                </div>
        </div>
    </div>
    </form>

    <!-- remove cart item -->
    <?php
    function remove_cart_item()
    {
        global $con;
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                $delete_query = "DELETE FROM cart_details WHERE product_id = $remove_id";
                $run_delete = mysqli_query($con, $delete_query);
                if ($run_delete) {
                    echo "<script>window.open('cart.php', '_self')</script>";
                }
            }
        }
    }
    echo $remove_item = remove_cart_item();
    ?>

    <!-- footer -->
    <?php include("./includes/footer.php") ?>

    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>