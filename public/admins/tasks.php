<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php $page_title = 'Manage Tasks'; ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<style>
    .container-xl {
        font-size: 1.25rem; /* Increase base font size */
    }
    .table th, .table td {
        font-size: 1.2rem; /* Specific font size for table headers and cells */
    }
</style>

<div class="container-xl">
    <h2 style="font-size: 2rem;">Task Management</h2> <!-- Larger heading -->
    <a href="task_create.php" class="btn btn-primary mb-3 btn-lg">Create New Task</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Estimated Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM task";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['task_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['task_description']) . "</td>";
                    echo "<td>$" . number_format($row['task_price'], 2) . "</td>";
                    echo "<td>" . $row['task_estimate_time'] . " mins</td>";
                    echo "<td><a href='task_edit.php?id=" . u($row['task_id']) . "' class='btn btn-primary btn-lg mr-2'>Edit</a>";
                    echo "<a href='task_delete.php?id=" . u($row['task_id']) . "' class='btn btn-danger btn-lg'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No tasks found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include(SHARED_PATH . '/admins_footer.php'); ?>
