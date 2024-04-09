<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<div class="container-xl">
    <!-- HTML form for creating a new customer or account -->
    <h2>All Users</h2>

    <!-- Button to create a new user -->
    <a href="create.php" class="btn btn-primary mb-3">Create New User</a>

    <!-- Table to display users -->
    <table class="uk-table uk-table-hover uk-table-divider">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Retrieve users from the database
            $sql = "SELECT * FROM customer";
            $result = $db->query($sql);

            // Check if there are users
            if ($result->num_rows > 0) {
                // Loop through each user and display their information
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['customer_first_name'] . "</td>";
                    echo "<td>" . $row['customer_last_name'] . "</td>";
                    echo "<td>" . $row['customer_email'] . "</td>";
                    // Edit button
                    echo "<td><a href='edit.php?id=" . $row['customer_id'] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>";
                    // Delete button
                    echo "<a href='delete.php?id=" . $row['customer_id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include(SHARED_PATH . '/admins_footer.php'); ?>
