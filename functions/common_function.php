<?php

//getting products
function getproducts()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM products ORDER BY RAND() LIMIT 0,3";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];

                echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
            };
        }
    }
}

//getting unique categories
function get_unique_categories()
{
    global $con;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM products WHERE category_id=$category_id";
        $result_query = mysqli_query($con, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
        };
    }
}

//getting unique brands
function get_unique_brands()
{
    global $con;

    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM products WHERE brand_id=$brand_id";
        $result_query = mysqli_query($con, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this brand</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
        };
    }
}


//displaying brands in sidenav
function getbrands()
{
    global $con;
    $select_brands = "SELECT * FROM brands";
    $result_brands = mysqli_query($con, $select_brands);

    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo "<li class='nav-item'>
                    <a href='index.php?brand={$brand_id}' class='nav-link text-light'>{$brand_title}</a>
                </li>";
    }
}

//displaying categories in sidenav
function getcategories()
{
    global $con;
    $select_categories = "SELECT * FROM categories";
    $result_categories = mysqli_query($con, $select_categories);

    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'>
        <a href='index.php?category={$category_id}' class='nav-link text-light'>{$category_title}</a>
    </li>";
    };
}


// searching products
function search_product()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM products WHERE product_keyword LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No products found on this keyword!</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image1 = $row['product_image1'];

            echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
        };
    }
}


//getting all of products
function get_all_products()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM products ORDER BY RAND()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image1 = $row['product_image1'];

                echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
            };
        }
    }
}

// view details function
function view_details()
{
    global $con;
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM products WHERE product_id=$product_id";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];

                    echo "<div class='col-md-4 mb-2'>
                            <div class='card' style='width: 18rem;'>
                                <img src='./admin_area/product_images/{$product_image1}' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$product_title}</h5>
                                    <p class='card-text'>{$product_description}</p>
                                    <p class='card-text'>Price: {$product_price}/-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='index.php' class='btn btn-secondary'>Go Home</a>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-8'>
                    <!-- related cards -->
                    <div class='row'>
                        <div class='col-md-12'>
                            <h4 class='text-center text-info mb-5'>Related Products</h4>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/{$product_image2}' class='card-img-top' alt='...'>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/{$product_image3}' class='card-img-top' alt='...'>
                        </div>
                    </div>
                </div>";
                };
            }
        }
    }
}


// get ip address
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;


// cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id='$get_product_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present inside cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$get_product_id', '$ip', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}


// get cart item numbers
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}

// total price
function total_cart_price()
{
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
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }
    echo $total;
}

// get user order details
function get_user_order_details(){
    global $con;
    $username = $_SESSION['username'];
    $get_details = "SELECT * FROM user_table WHERE username = '$username'";
    $result_query = mysqli_query($con, $get_details);
    while($row_query = mysqli_fetch_array($result_query)){
        $user_id = $row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders = "SELECT * FROM user_orders WHERE user_id =$user_id and order_status 'pending'";
                    $result_orders_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_orders_query);
                    if($row_count > 0){
                        echo "<h3 class='text-center text-success my-5'>You have <span class='text-danger'>$row_count</span> pending orders</h3>";
                    }
                }
            }
        }

    }

}