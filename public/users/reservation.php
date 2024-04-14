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
        <div class="card p-3 mx-4 my-4" style="width: 25rem;">
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
                
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="position: fixed; bottom: 20px; right: 20px; z-index: 1030; font-size: 1rem; padding: 1.25rem 1.75rem;">Book Now</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Book Your Appointment</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Select date and time form --> 
        <form action="submit_booking.php" method="post" onsubmit="return validateForm();">
            <label for="date" class="form-label">Date:</label>
            <input type="date" id="date" name="date" class="form-control" required>

            <label for="time" class="form-label">Time:</label>
            <input type="time" id="time" name="time" class="form-control" required min="08:00" max="19:00">

            <label for="technician" class="form-label">Technician:</label>
            <select class="form-select" id="technician" name="technician" required>
                <?php while ($tech = $technicians->fetch_assoc()): ?>
                    <option value="<?= $tech['employee_id'] ?>"><?= $tech['employee_first_name'] . ' ' . $tech['employee_last_name'] ?></option>
                <?php endwhile; ?>
            </select>
            <div class="d-grid gap-2 mt-5">
    <input type="submit" class="btn btn-primary btn-lg" value="Book Now">
</div>

        </form>
        <!-- End Select date and time form -->
    </div>
</div>

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
