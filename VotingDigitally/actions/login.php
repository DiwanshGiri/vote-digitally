<?php
session_start();

include('connect.php');

$username = $_POST['username'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$std = $_POST['std'];

$sql = "SELECT * FROM userdata WHERE username = '$username' AND mobile = '$mobile' AND password = '$password' AND standard = '$std' AND approved = 1";

$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) > 0){
    $sql = "SELECT username, photo, votes, id FROM userdata WHERE standard = 'group'";
    
    $resultgroup = mysqli_query($con, $sql);

    if(mysqli_num_rows($resultgroup) > 0){
        $groups = mysqli_fetch_all($resultgroup, MYSQLI_ASSOC);
        $_SESSION['groups'] = $groups;
    }

    $data = mysqli_fetch_array($result);

    $_SESSION['id'] = $data['id'];
    $_SESSION['status'] = $data['status'];
    $_SESSION['data'] = $data;

    echo '<script>
    window.location="../partials/home.php";
    </script>';
} else {
    echo '<script>
    alert("Your account is not approved by the admin yet.");
    window.location="../";
    </script>';
}
?>
