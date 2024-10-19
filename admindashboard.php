<?php
require 'dbconn.php';

// Simulating WiFi connection status
$wifi_connected = true;

// Fetching the count of bookings for each room type
$luxury_sql = "SELECT COUNT(*) AS count FROM bookings WHERE roomType = 'Luxury'";
$luxury_res = mysqli_query($conn, $luxury_sql);
$luxury_count = mysqli_fetch_assoc($luxury_res)['count'];

$double_sql = "SELECT COUNT(*) AS count FROM bookings WHERE roomType = 'Double'";
$double_res = mysqli_query($conn, $double_sql);
$double_count = mysqli_fetch_assoc($double_res)['count'];

$single_sql = "SELECT COUNT(*) AS count FROM bookings WHERE roomType = 'Single'";
$single_res = mysqli_query($conn, $single_sql);
$single_count = mysqli_fetch_assoc($single_res)['count'];

$guest_sql = "SELECT COUNT(*) AS count FROM bookings WHERE roomType = 'Guest'";
$guest_res = mysqli_query($conn, $guest_sql);
$guest_count = mysqli_fetch_assoc($guest_res)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light border" style="min-width: 250px; height: 100vh; padding: 20px;">
            <h4 class="text-center">Admin Menu</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-3">
                    <a href="adduser.php" class="nav-link btn btn-light">Add User</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="addroom.php" class="nav-link btn btn-light">Add Room</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="addmeal.php" class="nav-link btn btn-light">Add Meal</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="adminrooms.php" class="nav-link btn btn-light">Manage Rooms</a>
                </li>
                <li class="nav-item mb-3">
                    <a href="adminstaffs.php" class="nav-link btn btn-light">Manage Staff</a>
                </li>
            </ul>

            <!-- WiFi Signal Indicator -->
            <div class="mt-5 text-center">
                <?php if ($wifi_connected): ?>
                    <i class="bi bi-wifi" style="font-size: 2rem; color: green;"></i>
                <?php else: ?>
                    <i class="bi bi-wifi" style="font-size: 2rem; color: red;"></i>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="container-fluid m-2">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <img src="img/worldskills.jpg" class="logo" alt="">
                        <a href="admindashboard.php" class="navbar-brand">DASHBOARD ADMIN</a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div class="navbar-nav">
                                <a href="adminroombooking.php" class="nav-item nav-link">ROOM BOOKING</a>
                                <a href="adminpayment.php" class="nav-item nav-link">PAYMENT</a>
                                <a href="adminrooms.php" class="nav-item nav-link">ROOMS</a>
                                <a href="adminstaffs.php" class="nav-item nav-link">STAFFS</a>
                            </div>
                            <div class="navbar-nav ms-auto">
                                <a href="home.php" class="nav-item nav-link btn btn-danger">View website</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- Card Section -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <?php
                                  $sql = "SELECT * FROM rooms";
                                  $res = mysqli_query($conn, $sql);
                                  $count = mysqli_num_rows($res);
                                ?>
                                <p class="card-text">ROOMS</p>
                                <h1 class="card-title">TOTAL <span><?= $count?></span></h1>
                                <a href="adminrooms.php" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-primary">
                            <div class="card-body">
                                <?php
                                  $sql = "SELECT * FROM meals";
                                  $res = mysqli_query($conn, $sql);
                                  $count = mysqli_num_rows($res);
                                ?>
                                <p class="card-text">MEALS</p>
                                <h1 class="card-title">TOTAL <span><?= $count?></span></h1>
                                <a href="adminmeal.php" class="btn btn-primary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-success">
                            <div class="card-body">
                                <?php
                                  $sql = "SELECT * FROM bookings";
                                  $res = mysqli_query($conn, $sql);
                                  $count = mysqli_num_rows($res);
                                ?>
                                <p class="card-text">BOOKINGS</p>
                                <h1 class="card-title">TOTAL <span><?= $count?></span></h1>
                                <a href="adminroombooking.php" class="btn btn-success">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card border-warning">
                            <div class="card-body">
                                <?php
                                  $sql = "SELECT * FROM users";
                                  $res = mysqli_query($conn, $sql);
                                  $count = mysqli_num_rows($res);
                                ?>
                                <p class="card-text">USERS</p>
                                <h1 class="card-title">TOTAL <span><?= $count?></span></h1>
                                <a href="adminstaffs.php" class="btn btn-warning">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Room Booking Chart -->
            <div class="container mt-5">
                <h2>Room Bookings by Type</h2>
                <canvas id="bookingChart" width="400" height="200"></canvas>
            </div>

            <!-- Room Table -->
            <div class="container mt-3">
                <h2>LIST OF ROOMS</h2>  
                <a href="addroom.php" class="btn btn-primary mt-2">ADD ROOM</a>         
                <table border="2" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>ROOM NO</th>
                            <th>ROOM TYPE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM rooms";
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['type'] ?></td>
                                    <td>
                                        <a href="removeroom.php" class="btn btn-danger">REMOVE</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        var ctx = document.getElementById('bookingChart').getContext('2d');
        var bookingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Luxury', 'Double', 'Single', 'Guest'],
                datasets: [{
                    label: 'Number of Bookings',
                    data: [<?= $luxury_count ?>, <?= $double_count ?>, <?= $single_count ?>, <?= $guest_count ?>],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
