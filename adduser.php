<?php
require 'dbconn.php';

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check if passwords match
    if ($password !== $cpassword) {
        echo "
          <script>
            alert('Passwords do not match!');
            window.location.href = 'signup.php';
          </script>
        ";
        exit(); // Stop further execution
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$name', '$email', '$hashed_password')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "
          <script>
            alert('User account registered successfully!');
            window.location.href = 'index.php';
          </script>
        ";
    } else {
        echo "
          <script>
            alert('User could not be registered! Error: " . mysqli_error($conn) . "');
            window.location.href = 'signup.php';
          </script>
        ";
    }
}
?>
