<?php
include('connect.php');

$username = $_POST['username'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$std = $_POST['std'];

move_uploaded_file($tmp_name, "../uploads/$image");

// Set the initial approval status to 0 (not approved)
$approved = 0;

$sql = "INSERT INTO userdata (username, mobile, password, photo, standard, status, votes, approved) VALUES ('$username', '$mobile', '$password', '$image', '$std', 0, 0, $approved)";
$result = mysqli_query($con, $sql);

if($result) {
    echo '<script>
    alert("Registration Successful. Your account will be activated once approved by the admin.");
    window.location="../";
    </script>';
    exit; 
} else {
    echo '<script>
    alert("Registration Failed. Please try again later.");
    window.location="../partials/registration.php";
    </script>';
    exit; 
}
?>
