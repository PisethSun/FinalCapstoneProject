<?php

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  // has_unique_username('johnqpublic')
  // * Validates uniqueness of admins.username
  // * For new records, provide only the username.
  // * For existing records, provide current ID as second argument
  //   has_unique_username('johnqpublic', 4)
  function has_unique_username($username, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

    $result = mysqli_query($db, $sql);
    $admin_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $admin_count === 0;
  }










  // user validate, when sign up 

  function validate_user_input($user_input) {
    $errors = [];

    if (is_blank($user_input['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user_input['username'], ['min' => 4, 'max' => 255])) {
        $errors[] = "Username must be between 4 and 255 characters.";
    }

    if (is_blank($user_input['email'])) {
        $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($user_input['email'])) {
        $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user_input['password'])) {
        $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user_input['password'], ['min' => 8])) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    if (is_blank($user_input['firstName'])) {
        $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user_input['firstName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($user_input['lastName'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user_input['lastName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($user_input['phone'])) {
        $errors[] = "Phone cannot be blank.";
    } elseif (!preg_match('/^[0-9]{10}$/', $user_input['phone'])) {
        $errors[] = "Phone must be 10 digits long.";
    }

    return $errors;
}

// validate log in input 
function validate_login_input($user_input) {
  $errors = [];

  if (is_blank($user_input['email'])) {
      $errors[] = "Email cannot be blank.";
  } elseif (!has_valid_email_format($user_input['email'])) {
      $errors[] = "Email must be a valid format.";
  }

  if (is_blank($user_input['password'])) {
      $errors[] = "Password cannot be blank.";
  } elseif (!has_length($user_input['password'], ['min' => 8])) {
      $errors[] = "Password must be at least 8 characters long.";
  }

  return $errors;
}


?>
