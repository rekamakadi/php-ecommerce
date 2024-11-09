<?php
include('../functions/common_function.php');
include('../includes/connect.php');
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootsstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
        $user_ip = getIPAddress();
        $get_user = "SELECT * FROM user_table WHERE user_ip = '$user_ip'";
        $result = mysqli_query($con, $get_user);
        $run_query = mysqli_fetch_array($result);
        $user_id = $run_query['user_id'];

    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="blank"><img src="../images/payment_options.png" alt="" class="w-100% m-auto d-block"></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php
                
                ?>">
                    <h2 class="text-center">Pay Offline</h2>
                </a>
            </div>
        </div>
    </div>
</body>

</html>