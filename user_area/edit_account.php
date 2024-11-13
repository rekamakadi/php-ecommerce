<?php
include('../includes/connect.php');

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please log in first');</script>";
    echo "<script>window.open('login.php', '_self');</script>";
    exit();
}

$user_session_name = $_SESSION['username'];

// fetch user data if editing
if (isset($_GET['edit_account'])) {
    $select_query = "SELECT * FROM user_table WHERE username = '$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    if ($row_fetch = mysqli_fetch_assoc($result_query)) {
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
        $user_image = $row_fetch['user_image'];
    }
}

// update user data
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    // If a new image is uploaded, move it to the folder and use it
    if (!empty($user_image)) {
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
    } else {
        // Keep existing image if no new image is uploaded
        $user_image = $row_fetch['user_image'];
    }


    // update query
    $update_data = "UPDATE user_table SET username = '$username', user_email = '$user_email', user_image = '$user_image', user_address = '$user_address', user_mobile = '$user_mobile' WHERE user_id = $update_id";
    $result_query_update = mysqli_query($con, $update_data);
    if ($result_query_update) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php', '_self')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <?php if (!empty($user_image)) { ?>
                <img src="./user_images/<?php echo $user_image ?>" alt="" class="d-block w-25 h-25 m-auto p-4 object-fit-contain">
            <?php } ?>
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0 mb-4" name="user_update">
    </form>
</body>

</html>