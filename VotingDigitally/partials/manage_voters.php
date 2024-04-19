<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: adminlogin.php");
    exit;
}

$con = mysqli_connect("localhost", "root", "", "votingsystem");

if(!$con){
    die(mysqli_error($con));
}

$sql = "SELECT id, username, mobile, photo FROM userdata WHERE standard = 'voter'";
$result = $con->query($sql);
$voters = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $voters[] = $row;
    }
}

if(isset($_POST['action']) && $_POST['action'] === 'delete'){
    $voter_id = $_POST['voter_id'];

    $sql = "DELETE FROM userdata WHERE id=$voter_id";
    if ($con->query($sql) === TRUE) {
        header("Location: manage_voters.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

$con->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Voters</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        background-image: url('img/vottingimg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .container {
        width: 80%;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: burlywood;
        opacity: 0.8;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: blanchedalmond;
    }

    button[type="submit"] {
        padding: 8px 16px;
        border-radius: 5px;
        background-color: brown;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    button[type="submit"]:hover {
        background-color: crimson;
    }

    </style>
</head>

<body>
    <h2>Manage Voters</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Mobile</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
        <?php 
        foreach($voters as $voter){
            echo "<tr>
                    <td>{$voter['id']}</td>
                    <td>{$voter['username']}</td>
                    <td>{$voter['mobile']}</td>
                    <td>{$voter['photo']}</td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='voter_id' value='{$voter['id']}'>
                            <button type='submit'>Delete</button>
                        </form>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>

</html>
