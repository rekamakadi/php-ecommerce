<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- bootsstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="rowd-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-outline m-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" placeholder="Enter your username" autocomplete="off" required="required" class="form-control" name="user_username">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" placeholder="Enter your email" autocomplete="off" required="required" class="form-control" name="user_email">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_image" class="form-label">User Image</label>
                        <input type="file" id="user_image" required="required" class="form-control" name="user_image">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" placeholder="Enter your password" autocomplete="off" required="required" class="form-control" name="user_password">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_user_password" placeholder="Confirm password" autocomplete="off" required="required" class="form-control" name="confirm_user_password">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" placeholder="Enter your address" autocomplete="off" required="required" class="form-control" name="user_address">
                    </div>
                    <div class="form-outline m-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input type="text" id="user_contact" placeholder="Enter your phone number" autocomplete="off" required="required" class="form-control" name="user_contact">
                    </div>
                    <div class="text-center mt-4 pt-2">
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>