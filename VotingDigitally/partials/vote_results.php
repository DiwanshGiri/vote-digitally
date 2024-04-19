<?php
session_start();
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header("Location: login.php");
//     exit;
// }

$con = mysqli_connect("localhost", "root", "", "votingsystem");

if(!$con){
    die(mysqli_error($con));
}


$sql = "SELECT username, votes FROM userdata WHERE standard = 'group'";

$result = $con->query($sql);
$vote_results = array();
$max_votes_candidate = null;
$max_votes = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vote_results[] = $row;

        if ($row['votes'] > $max_votes) {
            $max_votes = $row['votes'];
            $max_votes_candidate = $row;
        }
    }
}

$con->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Vote Results</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #000000;
        margin: 0;
        padding: 0;
        background-image: url('img/darkbg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    h2 {
        text-align: center;
        color: crimson;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        opacity: 0.8;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: grey;
        color: black;
    }

    tr:nth-child(even) {
        background-color: #514644;
        color: whitesmoke;
    }

    tr:nth-child(odd) {
        background-color: grey;
        color: whitesmoke;
    }

    tr:hover {
        background-color: dimgray;
    }
    </style>
</head>

<body>
    <h2>Vote Results</h2>

    <table border="1">
        <tr>
            <th>Candidate Name/Party Name</th>
            <th>Total Votes</th>
        </tr>
        <?php
        foreach ($vote_results as $result) {
            echo "<tr>
                    <td>{$result['username']}</td>
                    <td>{$result['votes']}</td>
                </tr>";
        }
        ?>
    </table>

    <?php if ($max_votes_candidate): ?>
    <p style="font-size: larger; font-weight: bold; text-align: center; color: green;">The candidate with the highest
        votes is: <?php echo $max_votes_candidate['username']; ?> with <?php echo $max_votes_candidate['votes']; ?>
        votes.</p>
    <?php endif; ?>


</body>

</html>