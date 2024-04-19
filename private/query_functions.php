<?php

  // Admins

  // Find all admins, ordered last_name, first_name
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  function validate_admin($admin, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters ba.";
    }

    if(is_blank($admin['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($admin['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($admin['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($admin['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($admin['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($admin['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($admin['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($admin['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      } elseif($admin['username'] == $admin['password']) {
        $errors[] = "Username and password must be different";
      }

      if(is_blank($admin['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($admin['password'] !== $admin['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
      }
    }

    return $errors;
  }

  function insert_admin($admin) {
    global $db;

    $errors = validate_admin($admin);
    if (!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $admin['first_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['last_name']) . "',";
    $sql .= "'" . db_escape($db, $admin['email']) . "',";
    $sql .= "'" . db_escape($db, $admin['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_admin($admin) {
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . db_escape($db, $admin['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $admin['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $admin['email']) . "', ";
    if($password_sent) {
      $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
      $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $admin['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_admin($admin) {
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . db_escape($db, $admin['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // USERS

  function find_user_by_email($email) {
    global $db;

    $sql = "SELECT account_id, account_password, access_level FROM account WHERE account_email = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->num_rows === 1 ? $result->fetch_assoc() : null;
    $stmt->close();

    return $user; // returns an assoc. array or null if not found
}

function process_signup($db, $username, $email, $password, $firstName, $lastName, $phone) {
  $errors = []; // Initialize an array to collect potential errors

  $password = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
  $accessLevel = 1; // Default access level for new accounts
  $accountStatus = 1; // Default account status for new accounts

  // Start a database transaction
  mysqli_begin_transaction($db);

  try {
      // Insert into account table
      $stmt = mysqli_prepare($db, "INSERT INTO account (account_username, account_email, account_password, access_level, account_status) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $password, $accessLevel, $accountStatus);
      mysqli_stmt_execute($stmt);
      $accountId = mysqli_insert_id($db); // Get the last inserted ID for future use

      // Insert into customer table
      $stmt = mysqli_prepare($db, "INSERT INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES (?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $phone);
      mysqli_stmt_execute($stmt);

      // Commit the transaction if all operations succeed
      mysqli_commit($db);
      mysqli_stmt_close($stmt);

      return ['success' => true];
  } catch (Exception $e) {
      // Rollback the transaction in case of an error
      mysqli_rollback($db);
      mysqli_stmt_close($stmt);

      $errors[] = "Error: " . $e->getMessage();
      return ['success' => false, 'errors' => $errors];
  }
}


// for 

// In functions.php or a similar included file
function sanitize_and_collect_user_input($db, $post_data) {
  return [
      'username' => mysqli_real_escape_string($db, $post_data['username']),
      'email' => mysqli_real_escape_string($db, $post_data['email']),
      'password' => $post_data['password'], // Password is hashed later, no need for escaping
      'confirm_password' => $post_data['confirm_password'], // Add confirm password field
      'firstName' => mysqli_real_escape_string($db, $post_data['firstName']),
      'lastName' => mysqli_real_escape_string($db, $post_data['lastName']),
      'phone' => mysqli_real_escape_string($db, $post_data['phone']),
  ];
}


// Assuming process_signup is already defined as per previous instructions


function updateCustomer($db, $user_id, $first_name, $last_name, $email) {
  // Prepare the SQL statement
  $stmt = $db->prepare("UPDATE customer SET customer_first_name = ?, customer_last_name = ?, customer_email = ? WHERE customer_id = ?");
  // Bind the parameters to the prepared statement
  $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
  // Execute the statement and return the result
  $stmt->execute();
  // Check if the update was successful
  $wasSuccessful = $stmt->affected_rows === 1;
  // Close the statement
  $stmt->close();
  // Return the result of the update operation
  return $wasSuccessful;
}

