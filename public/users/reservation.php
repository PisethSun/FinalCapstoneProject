<?php require_once('../../private/initialize.php'); ?>
<?php $page_title = 'Booking'; ?>
<?php include(SHARED_PATH .'/users_header.php'); ?>
<?php require_login(); ?>

<!-- Fetch technicians (employees) -->
<?php 
$technicians = $db->query("SELECT employee_id, employee_first_name, employee_last_name FROM employee"); 
if(!$technicians) {
    die("Database query failed.");
}

// Fetch tasks
$tasks = $db->query("SELECT task_id, task_name, task_description, task_price, task_estimate_time FROM task");
if(!$tasks) {
    die("Database query failed.");
}
?>

<script>
    function validateForm() {
        var checkedCount = document.querySelectorAll('input[name="tasks[]"]:checked').length;
        if (checkedCount < 1 || checkedCount > 2) {
            alert("Please select between 1 and 2 tasks.");
            return false;
        }
        return true;
    }
</script>

<div class="container-lg">
    <fieldset>
        <form action="submit_booking.php" method="post" onsubmit="return validateForm();">
            <h2 style="text-align: center;">SELECT YOUR SERVICES</h2>
            <div class="d-flex flex-wrap justify-content-start"> <!-- Flex container for tasks -->
                <?php while ($task = $tasks->fetch_assoc()): ?>
                    <div class="card p-2 mx-2 my-2" style="width: 18rem;">
                        <div class="card-body form-check">
                            <input type="checkbox" class="form-check-input" id="task_<?= $task['task_id'] ?>" name="tasks[]" value="<?= $task['task_id'] ?>">
                            <label class="form-check-label" for="task_<?= $task['task_id'] ?>">
                                <h5 class="card-title"><?= $task['task_name'] ?></h5>
                                <p class="card-text"><?= $task['task_description'] ?> - $<?= $task['task_price'] ?> - Estimated Time: <?= $task['task_estimate_time'] ?></p>
                            </label>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <br>
            <div class="container-lg">
                <hr class="border border-primary border-3 opacity-75">
                <h2 style="text-align: center;">SELECT TIME & DATE </h2>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required><br>
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" class="form-control" required min="08:00" max="19:00"><br>
                <label for="technician">Technician:</label>
                <select class="form-select" id="technician" name="technician" required>
                    <?php while ($tech = $technicians->fetch_assoc()): ?>
                        <option value="<?= $tech['employee_id'] ?>"><?= $tech['employee_first_name'] . ' ' . $tech['employee_last_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-primary btn-lg" value="Book Now">
            </div>
        </form>
    </fieldset>

    <?php include(SHARED_PATH .'/users_footer.php');?>



</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("date").setAttribute('min', today);
    });
</script>
