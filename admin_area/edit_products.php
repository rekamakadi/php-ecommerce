<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM products WHERE product_id = $edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $product_title = $row['product_title'];
    $product_description = $row['product_description'];
    $product_keyword = $row['product_keyword'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];


    // fetching category name
    $select_category = "SELECT * FROM categories WHERE category_id = $category_id";
    $result_category = mysqli_query($con, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_title'];

    // fetching brand name
    $select_brand = "SELECT * FROM brands WHERE brand_id = $brand_id";
    $result_brand = mysqli_query($con, $select_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_title'];
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" name="product_title" required="required" value="<?php echo $product_title ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" class="form-control" name="product_description" required="required" value="<?php echo $product_description ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keyword" class="form-label">Product Keywords</label>
            <input type="text" class="form-control" name="product_keyword" required="required" value="<?php echo $product_keyword ?>">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Product Category</label>
            <select name="product_category" id="" class="form-select">
                <option value='<?php echo $category_title ?>'><?php echo $category_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM categories";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $row_category_all['category_title'];
                    $category_id = $row_category_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brand" class="form-label">Product Brand</label>
            <select name="product_brand" id="" class="form-select">
                <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
                <?php
                $select_brand_all = "SELECT * FROM brands";
                $result_brand_all = mysqli_query($con, $select_brand_all);
                while ($row_brand_all = mysqli_fetch_assoc($result_brand_all)) {
                    $brand_title = $row_brand_all['brand_title'];
                    $brand_id = $row_brand_all['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image1</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image1" required="required">
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="w-25 m-auto object-fit-contain">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image2</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image2" required="required">
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="w-25 m-auto object-fit-contain">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image3</label>
            <div class="d-flex">
                <input type="file" class="form-control w-90 m-auto" name="product_image3" required="required">
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="w-25 m-auto object-fit-contain">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" name="product_price" required="required" value="<?php echo $product_price ?>">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" id="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>