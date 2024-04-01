<?php require_once('../../private/initialize.php');?>
<?php $page_title = 'Booking';?>
<?php include(SHARED_PATH .'/users_header.php');?>
<?php require_login(); ?>
<?php



// Fetch technicians (employees)
$technicians = $db->query("SELECT employee_id, employee_first_name, employee_last_name FROM employee");

// Fetch tasks
$tasks = $db->query("SELECT task_id, task_name, task_description, task_price, task_estimate_time FROM task");
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
<div class="container-xxl ">
    
             <div class="container-sm .container-lg" style="height: 200px;">
                    <hr class="border border-primary border-3 opacity-75">
                    <h2 style="text-align: center;">Book a Service</h2>

                        <form action="submit_booking.php" method="post" onsubmit="return validateForm();"> <!-- Adjust action as necessary -->
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" required><br>

                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" class="form-control" required><br>

                            
                            <label for="technician">Technician:</label>
                    <select class="form-select" id="technician" name="technician" required>
                        <?php while ($tech = $technicians->fetch_assoc()): ?>
                            <option value="<?= $tech['employee_id'] ?>"><?= $tech['employee_first_name'] . ' ' . $tech['employee_last_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
            </div>
        <br>
        <div class="container-sm .container-lg .fs-4 " style="height: 200px ;">
            <hr class="border border-primary border-3 opacity-75">

            
        <fieldset>
            <h2 style="text-align: center;">Select Tasks</h2>
            <?php while ($task = $tasks->fetch_assoc()): ?>
                <div class="form-check fs-4 ">
                    <input type="checkbox" id="task_<?= $task['task_id'] ?>" name="tasks[]" value="<?= $task['task_id'] ?>">
                    <label for="task_<?= $task['task_id'] ?>"><?= $task['task_name'] . " - " . $task['task_description'] . " - $" . $task['task_price'] . " - Estimated Time: " . $task['task_estimate_time'] ?></label>
                </div>
            <?php endwhile; ?>
        </fieldset>

        
        
 
        <form action="submit_booking.php" method="post" onsubmit="return validateForm();">
        <input type="submit" class="btn btn-primary btn-lg" value="Book Now">
        </form>



    </div>
    </form>


 </div>

 <?php while ($task = $tasks->fetch_assoc()): ?>
                <div class="form-check fs-4 ">
                    <input type="checkbox" id="task_<?= $task['task_id'] ?>" name="tasks[]" value="<?= $task['task_id'] ?>">
                    <label for="task_<?= $task['task_id'] ?>"><?= $task['task_name'] . " - " . $task['task_description'] . " - $" . $task['task_price'] . " - Estimated Time: " . $task['task_estimate_time'] ?></label>
                </div>
            <?php endwhile; ?>



