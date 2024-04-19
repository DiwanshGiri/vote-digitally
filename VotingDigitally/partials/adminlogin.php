<?php
session_start();
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: admin_pannel.php");
    exit;
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if($username === 'admin' && $password === 'admin123'){
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_pannel.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
            background: rgba(0, 0, 0, 0.7) url(img/bgvote.jpg);
            background-size: cover;
            background-blend-mode: exclusion;
        }

        .card-panel {
            opacity: 0.8;
            border-radius: 18px;
            background-color: lightgoldenrodyellow;
  }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="center-align">Admin Login</h2>
        <?php if(isset($error)) echo "<p class='red-text'>$error</p>"; ?>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel">
                    <form method="post" action="">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" type="text" name="username" class="validate" required>
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" name="password" class="validate" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
