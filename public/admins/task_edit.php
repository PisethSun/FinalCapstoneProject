<?php
require_once('../../private/initialize.php');
require_login();  // Ensure the user is logged in
$page_title = 'Edit Task';
include(SHARED_PATH . '/admins_header.php');

// Fetch the task details
$task_id = $_GET['id'] ?? '';  // Get the task ID from the URL

if ($task_id != '') {
    // Fetch the existing task data
    $stmt = $db->prepare("SELECT * FROM task WHERE task_id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();
    
    if (!$task) {
        redirect_to('tasks.php');  // Redirect if task not found
    }
} else {
    redirect_to('tasks.php');  // Redirect if ID not provided
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and prepare data for update
    $task_name = $_POST['task_name'] ?? '';
    $task_description = $_POST['task_description'] ?? '';
    $task_price = $_POST['task_price'] ?? '';
    $task_estimate_time = $_POST['task_estimate_time'] ?? '';

    // Update task details in the database
    $stmt = $db->prepare("UPDATE task SET task_name=?, task_description=?, task_price=?, task_estimate_time=? WHERE task_id=?");
    $stmt->bind_param("ssdii", $task_name, $task_description, $task_price, $task_estimate_time, $task_id);
    $result = $stmt->execute();
    
    if ($result) {
        redirect_to('tasks.php');  // Redirect back to the task list after updating
    } else {
        echo "Error updating record: " . $db->error;
    }
    $stmt->close();
}
?>

<div class="container-md mt-2">
    <h2>Edit Task</h2>
    <form action="task_edit.php?id=<?php echo u($task_id); ?>" method="post">
        <div class="form-group mb-3">
            <label for="task_name">Task Name</label>
            <input type="text" class="form-control" id="task_name" name="task_name" value="<?php echo htmlspecialchars($task['task_name']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="task_description">Description</label>
            <textarea class="form-control" id="task_description" name="task_description" required><?php echo htmlspecialchars($task['task_description']); ?></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="task_price">Price ($)</label>
            <input type="number" class="form-control" id="task_price" name="task_price" value="<?php echo htmlspecialchars($task['task_price']); ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="task_estimate_time">Estimated Time (minutes)</label>
            <input type="number" class="form-control" id="task_estimate_time" name="task_estimate_time" value="<?php echo htmlspecialchars($task['task_estimate_time']); ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Task</button>
        </div>
    </form>
</div>


<?php include(SHARED_PATH . '/admins_footer.php'); ?>
