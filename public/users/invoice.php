<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Your Invoices';?>
<?php include(SHARED_PATH .'/users_header.php');?>
<?php require_login(); ?>
<?php
function displayNoInvoicesFound() {
    echo '<div class="alert alert-warning" role="alert">You have not made any reservations yet.</div>';
}


function echoInvoiceDetailsWithTime($row) {

    echo "Invoice ID: " . $row['invoice_id'] . "<br>";
    echo "Date: " . $row['invoice_date'] . "<br>";
    echo "Status: " . $row['invoice_status'] . "<br>";
    echo "Technician: " . $row['employee_first_name'] . " " . $row['employee_last_name'] . "<br>";
    echo "Task: " . $row['task_name'] . "<br>";
    echo "Description: " . $row['task_description'] . "<br>";
    echo "Price: $" . $row['task_price'] . "<br>";

    if ($row['task_estimate_time'] < 60) {
        echo "Estimated Time: " . $row['task_estimate_time'] . " mins<br><br>";
    } else {
        $hours = floor($row['task_estimate_time'] / 60);
        $minutes = $row['task_estimate_time'] % 60;
        echo "Estimated Time: " . $hours . " hours ";
        if ($minutes > 0) {
            echo $minutes . " mins";
        }
        echo "<br><br>";
    }
}

// Fetch invoice details including technician, task, and price
$query = "SELECT i.invoice_date, i.invoice_status, e.employee_first_name, e.employee_last_name, t.task_name, t.task_description, t.task_price, t.task_estimate_time
          FROM invoice i
          JOIN reservation r ON i.reservation_id = r.reservation_id
          JOIN employee e ON r.employee_id = e.employee_id
          JOIN selected_tasks st ON r.reservation_id = st.reservation_id
          JOIN task t ON st.task_id = t.task_id
          WHERE r.customer_id = ?";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="container-lg" >
    <table class="table-info table">
        <thead>
            <tr>
                <th class="fs-5" scope="col">Technician Name</th>
                <th  class="fs-5" scope="col">Date</th>
                <th class="fs-5" scope="col">Task</th>
                <th class="fs-5" scope="col">Description</th>
                <th class="fs-5" scope="col">Price</th>
                <th class="fs-5" scope="col">Estimated Time</th>
                <th class="fs-5" scope="col">Status</th>
            </tr>
        </thead>
        <tbody class="fs-5">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    
                    echo "<td>" . $row['employee_first_name'] . " " . $row['employee_last_name'] . "</td>";
                    echo "<td>" . $row['invoice_date'] . "</td>";
                    echo "<td>" . $row['task_name'] . "</td>";
                    echo "<td>" . $row['task_description'] . "</td>";
                    echo "<td>$" . $row['task_price'] . "</td>";
                    echo "<td>";
                    if ($row['task_estimate_time'] < 60) {
                        echo $row['task_estimate_time'] . " mins";
                    } else {
                        $hours = floor($row['task_estimate_time'] / 60);
                        $minutes = $row['task_estimate_time'] % 60;
                        echo $hours . " hours ";
                        if ($minutes > 0) {
                            echo $minutes . " mins";
                        }
                    }
                    echo "</td>";
                    echo "<td style='color: " . ($row['invoice_status'] == 'Accepted' ? 'green' : 'red') . "'>" . $row['invoice_status'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No invoices found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include(SHARED_PATH .'/users_footer.php');?>
