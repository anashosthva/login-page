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

  // Query the database for the user
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  // If the user is found
  if ($result->num_rows > 0) {
    // Start a session
    session_start();

    // Store the username in a session variable
    $_SESSION["username"] = $username;

    // Redirect to the home page
    header("Location: home.html");
  } else {
    // If the user is not found, redirect back to the login page
    header("Location: login.html");
  }

  // Close the database connection
  $conn->close();
?>
