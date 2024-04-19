<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
header("Location: adminlogin.php");
exit;
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
*{
    margin: 0;
    padding: 0;
}

        body {
            background-image: url('img/darkbg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #212121; 
            color: #fff;
            font-family: 'Roboto', sans-serif;
            padding-top: 50px;
            margin: 0;
        }
        .container {
            margin-top: 20px;
            text-align: center;
        }
        .dashboard-links {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .dashboard-links a {
            display: inline-block;
            margin-bottom: 50px;
            margin-top: 50px;
            padding: 50px 50px;
            background-color: #03a9f4; 
            border-radius: 50px;
            text-decoration: cadetblue;
            color: #fff;
            font-size: 25px;
            font-weight: bold; 
            letter-spacing: 1px; 
            text-transform: uppercase; 
            transition: background-color 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); 
            text-align: center; 
        }
        .dashboard-links a:hover {
            background-color: #0288d1; 
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin!</h2>
        <div class="dashboard-links">
            <a href="manage_candidates.php" class="waves-effect waves-light btn">Manage Candidates</a>
            <a href="manage_voters.php" class="waves-effect waves-light btn">Manage Voters</a>
            <a href="vote_results.php" class="waves-effect waves-light btn">View Vote Results</a>
            <a href="admin_approval.php" class="waves-effect waves-light btn">Approve Candidates</a>
            <a href="logout.php" class="waves-effect waves-light btn">Logout</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>