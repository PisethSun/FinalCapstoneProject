<?php
require_once('../../private/initialize.php');
require_login();  // Ensure the user is logged in
$page_title = 'Create New Task';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume post data are sanitized and validated appropriately
    $task_name = $_POST['task_name'] ?? '';
    $task_description = $_POST['task_description'] ?? '';
    $task_price = $_POST['task_price'] ?? 0;
    $task_estimate_time = $_POST['task_estimate_time'] ?? 0;

    // Prepare SQL to insert task
    $sql = "INSERT INTO task (task_name, task_description, task_price, task_estimate_time) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssdi", $task_name, $task_description, $task_price, $task_estimate_time);
    $result = $stmt->execute();

    if ($result) {
        // Redirect to task list page or display success message
        $_SESSION['message'] = 'Task created successfully.';
        redirect_to(url_for('/tasks.php')); // Define redirect_to() and url_for() if not defined
    } else {
        // Error handling
        echo "Error: " . $db->error;
    }
}

include(SHARED_PATH . '/admins_header.php');
?>

<div class="container-md mt-4">
<h2 class="text-center">Create New Task</h2>
    <form action="task_create.php" method="post">
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <label for="task_description" class="form-label">Description</label>
                <textarea class="form-control" id="task_description" name="task_description" rows="3" required></textarea>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <label for="task_price" class="form-label">Price</label>
                <input type="number" class="form-control" id="task_price" name="task_price" step="0.01" required>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <label for="task_estimate_time" class="form-label">Estimated Time (minutes)</label>
                <input type="number" class="form-control" id="task_estimate_time" name="task_estimate_time" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>




<?php include(SHARED_PATH . '/admins_footer.php'); ?>
