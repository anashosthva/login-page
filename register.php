<?php
  $servername = "localhost";
  $username = "user";
  $password = "user";
  $dbname = "users-db";

  // Connect to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check if the connection is successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Get the posted data from the form
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Check if the username already exists
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // If the username already exists, display a message
    header("Location: register.html?error=username_exists");
    exit;
  } else {
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
      // Redirect the user to the login page after successful registration
      header("Location: login.html");
      exit;
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  // Close the database connection
  $conn->close();
?>

