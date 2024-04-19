<?php
session_start();

$con = mysqli_connect("localhost","root","","votingsystem");

if(!$con){
    die(mysqli_error($con));
}
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Voting System</title>

  <link rel="website icon" type="png" href="partials/img/logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h4 class="center-align">Login</h4>
      <form action="./actions/login.php" method="POST">
        
      <div class="input-field">
          <input id="username" type="text" name="username" class="validate" required>
          <label for="username">Username</label>
        </div>
        
        <div class="input-field">
          <input id="mobile_number" type="text" name="mobile" class="validate" required maxlength="10" minlength="10">
          <label for="mobile_number">Mobile Number</label>
        </div>
        
        <div class="input-field">
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Password</label>
        </div>
        
        <div class="input-field">
          <select id="userType" name="std" required>
             <option value="" disabled selected>Choose your option</option>
             <option value="voter">Voter</option>
            <option value="group">Group</option>
          </select>
        </div>
        
        <div class="center-align">
            <p>Don't have an account? <a href="./partials/registration.php">Register Here</a></p>
            <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
        </div>
      
    </form>
    </div>
  </div>

  <?php
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $std = $_POST['std'];

    $select = mysqli_query($con, "SELECT * FROM userdata WHERE username = '$username' AND mobile = '$mobile'  AND password = '$password' AND standard = '$std'");
    $row = mysqli_fetch_array($select);

    $eligible = $row['eligible'];

    $select2 = mysqli_query($con, "SELECT * FROM userdata WHERE username = '$username' AND mobile = '$mobile'  AND password = '$password' AND standard = '$std'");
    $check_user = mysqli_num_rows($select2);

    if ($check_user == 1){
        $_SESSION["eligible"] = $row['eligible'];
        $_SESSION["username"] = $row['username'];
        $_SESSION["mobile"] = $row['mobile'];
        $_SESSION["password"] = $row['password'];
        $_SESSION["standard"] = $row['standard'];
    }

    if($eligible == "approved"){
        echo '<script>
        alert("login Succuss!");
        window.location="../partials/home.php";
        </script>';
    }
    elseif($eligible == "pending"){
        echo '<script>
        alert("Your Account Is Still Pending For Approval!");
        window.location="../";
        </script>';
    }
    else{
        echo '<script>
        alert("Invalid Credentials");
        window.location="../";
        </script>';
    }
}

?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
