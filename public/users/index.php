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

<div class="container-fluid">
    <div class="row">
        <!-- Left Column for Upcoming Appointments -->
        <div class="col-md-6">
            <h3>Upcoming Appointments</h3>
            <div class="table-responsive">
                <table class="table">
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

        <!-- Right Column for Map -->
        <div class="col-md-6">
            <h3>Our Location</h3>
            <div class="map" style="width:100%; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; overflow: hidden; padding-bottom: 56.25%;position: relative;height: 100;">
   
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2942.602000004859!2d-70.95823012388458!3d42.478752771182116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e36d2f3a4feab1%3A0xb62e9630bc875f5b!2sCrystal%20Nails%20%26%20Spa!5e0!3m2!1sen!2sus!4v1696345659125!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width:120%; height: 800px; height: 100%;width: 100%;position: absolute;"></iframe>

</div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH .'/users_footer.php');?>
