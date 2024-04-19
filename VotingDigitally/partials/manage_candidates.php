<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: adminlogin.php");
    exit;
}

$con = mysqli_connect("localhost","root","","votingsystem");

if(!$con){
    die(mysqli_error($con));
}

$sql = "SELECT * FROM userdata WHERE standard = 'group'";
$result = $con->query($sql); 
$users = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

if(isset($_POST['action'])){
    $action = $_POST['action'];
    
    if ($action === 'add') {
        $username = $_POST['username'];
        $position = $_POST['position'];
    
        $photoName = $_FILES['photo']['name'];
        $photoTmpName = $_FILES['photo']['tmp_name'];
        $photoSize = $_FILES['photo']['size'];
        $photoError = $_FILES['photo']['error'];
    
        if ($photoError === 0) {
            $photoDestination = 'uploads/' . $photoName;
            move_uploaded_file($photoTmpName, $photoDestination);
        } else {
            echo "Error uploading photo.";
            exit;
        }
    
        $stmt = $con->prepare("INSERT INTO userdata (username, position, photo) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $position, $photoName);
        if ($stmt->execute()) {
            $stmt->close();
            echo "<script>window.location.href = 'manage_candidates.php';</script>";
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    
    if ($action === 'edit') {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $position = $_POST['position'];
    
        if ($_FILES['photo']['name']) {
            $photoName = $_FILES['photo']['name'];
            $photoTmpName = $_FILES['photo']['tmp_name'];
            $photoSize = $_FILES['photo']['size'];
            $photoError = $_FILES['photo']['error'];
    
            if ($photoError === 0) {
                $photoDestination = 'uploads/' . $photoName;
                move_uploaded_file($photoTmpName, $photoDestination);
                $stmt = $con->prepare("UPDATE userdata SET username=?, position=?, photo=? WHERE id=?");
                $stmt->bind_param("sssi", $username, $position, $photoName, $user_id);
            } else {
                echo "Error uploading photo.";
                exit;
            }
        } else {
            $stmt = $con->prepare("UPDATE userdata SET username=?, position=? WHERE id=?");
            $stmt->bind_param("ssi", $username, $position, $user_id);
        }
    
        if ($stmt->execute()) {
            $stmt->close();
            echo "<script>window.location.href = 'manage_candidates.php';</script>";
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
    
    elseif($action === 'delete'){
        $user_id = $_POST['user_id'];
        $stmt = $con->prepare("DELETE FROM userdata WHERE id=?"); 
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            header("Location: manage_candidates.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
$con->close(); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Candidate</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        background-image: url('img/logibbackgrouhnd.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: blanchedalmond;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        opacity: 0.9;
    }

    h2 {
        text-align: center;
        color: darkcyan;
    }

    form {
        margin-bottom: 20px;
    }

    input[type="text"] {
        width: calc(100% - 100px);
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-right: 10px;
        font-size: 16px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        border-radius: 15px;
        background-color: darkcyan;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
        display: block;
        margin: 0 auto;
        margin-top: 10px;
    }

    input[type="file"i] {
        appearance: none;
        background-color: initial;
        cursor: default;
        align-items: baseline;
        color: inherit;
        text-overflow: ellipsis;
        text-align: start;
        padding: initial;
        border: initial;
        white-space: pre;
        overflow: hi10px;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: darkseagreen;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: darkcyan;
        color: #fff;
    }

    td:last-child {
        text-align: center;
    }

    .delete-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 10%;
        border-radius: 10px;
    }

    .modal-button {
        background-color: brown;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 15px;
        cursor: pointer;
    }

    .modal-button:hover {
        background-color: #d32f2f;
    }

    .modal-button.cancel {
        background-color: red;
        margin-left: 10px;
        margin-top: 20px;
    }

    .modal-button.cancel:hover {
        background-color: #bbb;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manage Candidate</h2>

        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <input type="text" name="username" placeholder="Enter PartyName/Candidate Name" required>
            <input type="text" name="position" placeholder="Enter Position" required>
            <input type="file" name="photo" required>
            <button type="submit">Add Candidate</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Photo</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
            <?php 
            foreach($users as $user){
                echo "<tr>
                        <td>{$user['id']}</td>
                        <td>{$user['username']}</td>
                        <td><img src='{$user['photo']}' alt='User Photo' style='width: 100px;'></td>
                        <td>{$user['position']}</td> <!-- Display position -->
                        <td>
                            <!-- Update form -->
                            <form method='post' action='' enctype='multipart/form-data'>
                            <input type='hidden' name='action' value='edit'>
                             <input type='hidden' name='user_id' value='{$user['id']}'>
                             <input type='text' name='username' value='{$user['username']}' required>
                             <input type='text' name='position' value='{$user['position']}' required>
                             <input type='file' name='photo'> <!-- Update photo -->
                             <button type='submit'>Update</button>
                            </form>

                            <!-- Delete button -->
                            <button class='modal-button' onclick='openModal({$user['id']})'>Delete</button>
                            <!-- Delete modal -->
                            <div id='modal{$user['id']}' class='delete-modal'>
                                <div class='modal-content'>
                                    <p>Are you sure you want to delete this user?</p>
                                    <form method='post' action=''>
                                        <input type='hidden' name='action' value='delete'>
                                        <input type='hidden' name='user_id' value='{$user['id']}'>
                                        <button type='submit' class='modal-button'>Delete</button>
                                        <button type='button' class='modal-button cancel' onclick='closeModal({$user['id']})'>Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>

    <script>
    function openModal(userId) {
        var modal = document.getElementById("modal" + userId);
        modal.style.display = "block";
    }

    function closeModal(userId) {
        var modal = document.getElementById("modal" + userId);
        modal.style.display = "none";
    }
    </script>
</body>

</html>