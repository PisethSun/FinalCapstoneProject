<?php
require_once('../../private/initialize.php');
$page_title = 'Welcome Admins';
include(SHARED_PATH .'/admins_header.php');
require_login();

// Fetch total number of customers
$total_customers_query = "SELECT COUNT(*) AS total_customers FROM customer";
$total_customers_result = mysqli_query($db, $total_customers_query);
$total_customers = mysqli_fetch_assoc($total_customers_result)['total_customers'];

// Fetch total number of reservations
$total_reservations_query = "SELECT COUNT(*) AS total_reservations FROM reservation";
$total_reservations_result = mysqli_query($db, $total_reservations_query);
$total_reservations = mysqli_fetch_assoc($total_reservations_result)['total_reservations'];

// Existing invoices fetching code
// ...
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="card-text fs-4"><?php echo $total_customers; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Reservations</h5>
                    <p class="card-text fs-4"><?php echo $total_reservations; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
    <a href="create.php" class="text-decoration-none"> <!-- Makes the entire card a link -->
        <div class="card text-center bg-danger text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Add New Users</h5>
                <p class="card-text fs-4">Add Here</p>
            </div>
        </div>
    </a>
</div>

        <!-- You might want to add more cards here for other information -->
    </div>
</div>

<!-- The existing table and other page content -->
<div class="d-flex justify-content-center">
    <div class="container-lg fs-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Table and other content as already implemented -->
            </div>
        </div>
    </div>
</div>

