<?php
include('functions/common_function.php');
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
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
                    <thead>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan="2">Operations</th>
                    </thead>
                    <tbody>
                        <?php
                        global $con;
                        $ip = getIPAddress();
                        $total = 0;
                        $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
                        $result = mysqli_query($con, $cart_query);
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
                                    <td><input type="checkbox" name="remove[]" value="<?php echo $product_id; ?>"></td>
                                    <td>
                                        <input type="submit" value="Update cart" class="bg-info p-3 border-0" name="update_cart">
                                        <button type="submit" class="bg-info p-3 border-0" name="remove_item" value="<?php echo $product_id; ?>">Remove</button>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <!-- subtotal -->
                <div class="d-flex mb-5">
                    <h4 class="px-3">Subtotal: <strong class="text-info"><?php echo $total ?>/-</strong></h4>
                    <a href="index.php"><button class="bg-info  p-3 border-0">Continue shopping</button></a>
                    <a href="#"><button class="bg-secondary  p-3 border-0 text-light">Checkout</button></a>
                </div>
        </div>
    </div>
    </form>

    <!-- footer -->
    <?php include("./includes/footer.php") ?>

    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>