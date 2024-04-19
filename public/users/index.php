<?php require_once('../../private/initialize.php');?>
<?php $page_title = 'Welcome You';?>
<?php include(SHARED_PATH .'/users_header.php');?>
<?php require_login(); ?>

<?php
// Fetch the latest 5 invoices for the logged-in customer
$query = "SELECT i.invoice_date, i.invoice_status, e.employee_first_name, e.employee_last_name, t.task_name, t.task_description, t.task_price, t.task_estimate_time
          FROM invoice i
          JOIN reservation r ON i.reservation_id = r.reservation_id
          JOIN employee e ON r.employee_id = e.employee_id
          JOIN selected_tasks st ON r.reservation_id = st.reservation_id
          JOIN task t ON st.task_id = t.task_id
          WHERE r.customer_id = ?
          ORDER BY i.invoice_date DESC
          LIMIT 5";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="d-flex justify-content-center">
    <div class="container-lg fs-5"> <!-- Bootstrap class for font size -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3 class="text-center fs-3">Upcoming Appointments</h3> <!-- Larger font size for headers -->
                <div class="table-responsive">
                    <table class="table fs-6"> <!-- Slightly larger font size for table -->
                        <thead>
                            <tr>
                                <th>Technician</th>
                                <th>Date</th>
                                <th>Task</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Estimated Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['employee_first_name'] . " " . $row['employee_last_name'] . "</td>";
                                    echo "<td>" . $row['invoice_date'] . "</td>";
                                    echo "<td>" . $row['task_name'] . "</td>";
                                    echo "<td>" . $row['task_description'] . "</td>";
                                    echo "<td>$" . $row['task_price'] . "</td>";
                                    echo "<td>" . ($row['task_estimate_time'] < 60 ? $row['task_estimate_time'] . " mins" : floor($row['task_estimate_time'] / 60) . " hours " . ($row['task_estimate_time'] % 60) . " mins") . "</td>";
                                    echo "<td style='color: " . ($row['invoice_status'] === 'Accepted' ? 'green' : 'red') . "'>" . $row['invoice_status'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No upcoming appointments found.</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include(SHARED_PATH .'/users_footer.php');?>
