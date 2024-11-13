<?php
$username = $_SESSION['username'];
$get_user = "SELECT * FROM user_table where username = '$username'";
$result = mysqli_query($con, $get_user);
$row_fetch = mysqli_fetch_assoc($result);
$user_id = $row_fetch['user_id'];
?>


<h3 class="text-success">My Orders</h3>
<table class="table table-bordered mt-5">
    <thead>
        <tr>
            <th>Sl no</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get_order_deteails = "SELECT * FROM user_orders WHERE user_id = $user_id";
        $result_orders = mysqli_query($con, $get_order_deteails);
        while ($row_orders = mysqli_fetch_assoc($result_orders)) {
            $order_id = $row_orders['order_id'];
            $amount_due = $row_orders['amount_due'];
            $total_products = $row_orders['total_products'];
            $invoice_number = $row_orders['invoice_number'];
            $order_status = $row_orders['order_status'] == 'pending' ? 'Incomplete' : 'Complete';
            $order_date = $row_orders['order_date'];
            $number = 1;
            echo "<tr style='background-color: #6c757d; color: #ffffff;'>
                        <td>$number</td>
                        <td>$amount_due</td>
                        <td>$total_products</td>
                        <td>$invoice_number</td>
                        <td>$order_date</td>
                        <td>$order_status<td>";
            echo $order_status == 'Complete'
                ? 'Paid'
                : "<a href='confirm_payment.php?order_id=$order_id'>Confirm</a>";
            echo "</td>
                </tr>";
            $number++;
        }
        ?>
    </tbody>
</table>