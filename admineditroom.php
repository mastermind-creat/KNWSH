<?php
require 'dbconn.php';

if(isset($_POST['update'])){

    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $room = $_POST['no_of_rooms'];
    $phone = $_POST['phone'];
    $bedding = $_POST['bedding'];
    $meal = $_POST['meal'];
    $checkin= $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $sql = "INSERT INTO bookings (fullname, email, country, phone,roomType, beddingType,noOfRooms,meal,checkin,checkout) VALUES
    ('$fname','$email','$country','$phone','$room','$bedding','$room','$meal','$checkin','$checkout')";
    $res =  mysqli_query($conn, $sql);
    if($res){
        echo "
            <script>
               alert('Room Booking Details Updated successful!');
               window.location.href = 'adminroombooking.php';
            </script>
            ";
    }else{
        echo "
            <script>
               alert('Booking details could not be updated!');
               window.location.href = 'adminroombooking.php';
            </script>
            ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="style.css"> 
   <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
   <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="main">
      <a href="adminroombooking.php" class="btn btn-danger" style="position: absolute; left: 30px;">BACK</a>
        <h1 style="color: white" >Edit room details</h1>
        <form action="" method="POST" class="reservation">
            <div class="info">
                <?php
                if(isset($_GET['id'])){
    $bookingid = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE id = '$bookingid'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res) > 0){
        if(isset($_GET['id'])){
            $bookingid = $_GET['id'];
            $sql = "SELECT * FROM bookings WHERE id = '$bookingid'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res) > 0){
        ?>
                <div class="left">
                    <input type="text" name="fullname" value="<?= $row['fullname'] ?>" placeholder="Enter fullname" required>
                    <input type="email" name="email" value="<?= $row['email'] ?>" placeholder="Enter Email" required>
                    <select required name="country">
                       <option default><?= $row['country'] ?></option>
                       <option >Burundi</option>
                       <option >Tanzania</option>
                    </select>
                    <input type="text" name="phone"id="phone" value="<?= $row['phone'] ?>" placeholder="Enter Phone no" required>
                </div>
                <div class="right">
                  <select required name="roomtype">
                    <option default><?= $row['roomType'] ?></option>
                    <option >luxury room</option>
                    <option >guest room</option>
                    <option >double room</option>
                    <option >single room</option>
                  </select>
                  <select required name="bedding">
                    <option default><?= $row['beddingType'] ?></option>
                    <option >one bed</option>
                    <option >two bed</option>
                  </select>
                  <select required name="no_of_rooms">
                    <option default><?= $row['noOfRooms'] ?></option>
                    <option >1</option>
                    <option >2</option>
                    <option >3</option>
                    <option >4</option>
                  </select>
                  <select name="meal">
                    <option default><?= $row['meal'] ?></option>
                    <option >ugali</option>
                    <option >meat</option>
                    <option >chips</option>
                  </select>
                  <div class="check">
                <div class="checkin">
                    <p>Check in</p>
                    <input type="date" name="checkin" value="<?= $row['checkin'] ?>">
                </div>
                <div class="checkout">
                    <p>Check out</p>
                    <input type="date" name="checkout" value="<?= $row['checkout'] ?>">
                </div>
                </div>
                </div>
                
            </div>
                        <?php
        }
    }
    }
}
?>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            
        </form>
    </div>
</body>
</html>