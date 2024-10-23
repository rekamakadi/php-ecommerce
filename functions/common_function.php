<?php
// including connet file
include('./includes/connect.php');

//getting products
function getproducts()
{
    global $con;
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
                                    <a href='#' class='btn btn-info'>Add to cart</a>
                                    <a href='#' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
    };
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