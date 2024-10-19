<?php
require 'dbconn.php';

if(isset($_POST['book'])){
    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $Nroom = $_POST['noOfRooms'];
    $phone = $_POST['phone'];
    $roomType = $_POST['roomtype'];
    $bedding = $_POST['beddingType'];
    $meal = $_POST['meal'];
    $facility = $_POST['facility'];  // Assuming you're using this somewhere else
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $roomno = $_POST['roomno'];
    $status = "Not paid";

    $sql = "INSERT INTO bookings (fullname, email, country, noOfRooms, phone, roomType, beddingType, meal, checkin, checkout, roomno, status) 
            VALUES ('$fname', '$email', '$country', '$Nroom', '$phone', '$roomType', '$bedding', '$meal', '$checkin', '$checkout', '$roomno', '$status')";

    $res = mysqli_query($conn, $sql);
    if($res){
        echo "
            <script>
               alert('Booking details stored successfully!');
               window.location.href = 'mpesaform.php';
            </script>
        ";
    } else {
        echo "
            <script>
               alert('Booking could not be processed!');
               window.location.href = 'book.php';
            </script>
        ";
    }
}
?>
