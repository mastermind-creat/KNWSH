<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css"> 
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="main">
        <a href="home.php" class="btn btn-danger" style="position: absolute; left: 30px;">Go to home</a>
        <h1>RESERVATION</h1>

        <form action="booking.php" method="POST" class="reservation">
            <div class="info">
                <div class="left">
                    <?php 
                    // Assume $id and $roomno are dynamic values you want to pass
                    $id = 4; 
                    $roomno = 4; 
                    ?>
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <input type="hidden" value="<?= $roomno ?>" name="roomno">
                    <input type="text" name="fullname" placeholder="Enter fullname" required>
                    <input type="email" name="email" placeholder="Enter Email" required>
                    <select required name="country">
                        <option default>Kenya</option>
                        <option>Burundi</option>
                        <option>Tanzania</option>
                    </select>
                    <input type="number" name="phone" id="phone" placeholder="Enter Phone no" required>
                </div>

                <div class="right">
                    <select required name="roomtype">
                        <option default>Type of room</option>
                        <?php
                        // Database connection
                        require 'dbconn.php';
                        
                        // Fetch the available rooms from the 'rooms' table
                        $query = "SELECT DISTINCT type FROM rooms";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            // Loop through and display each room type
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['type'] . "'>" . ucfirst($row['type']) . "</option>";
                            }
                        } else {
                            echo "<option disabled>No rooms available</option>";
                        }
                        ?>
                    </select>

                    <select required name="bedding">
                        <option default>Bedding type</option>
                        <option>one bed</option>
                        <option>two bed</option>
                    </select>

                    <select required name="noOfRooms">
                        <option default>No of rooms</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>

                    <select name="meal">
                        <option default>Meal</option>
                        <option>ugali</option>
                        <option>meat</option>
                        <option>chips</option>
                    </select>

                    <select name="facility">
                        <option default>Facility (optional)</option>
                        <option>Gym</option>
                        <option>Swimming pool</option>
                        <option>SPA</option>
                        <option>Restaurant</option>
                    </select>

                    <div class="check">
                        <div class="form-control">
                            <p>Check in</p>
                            <input type="date" name="checkin" class="form-control mt-8 text-dark" placeholder="Date In">
                        </div>

                        <div class="form-control mr-3">
                            <p>Check out</p>
                            <input type="date" name="checkout" class="form-control mt-7 text-dark" placeholder="Date Out">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="book">Submit</button>
        </form>
    </div>
</body>
</html>
