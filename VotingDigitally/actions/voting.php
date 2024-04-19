<?php
session_start();
include('connect.php'); // Make sure connect.php contains the database connection code

// Check if the user has already voted
if(isset($_SESSION['status']) && $_SESSION['status'] == 1) {
    echo '<script>
        alert("You have already voted!");
        window.location="../partials/dashboard.php";
        </script>';
    exit;
}

// Process form submission
if(isset($_POST['groupvotes']) && isset($_POST['groupid'])) {
    // Get form data
    $votes = $_POST['groupvotes'];
    $totalvotes = $votes + 1;
    $gid = $_POST['groupid'];
    $uid = $_SESSION['id']; // Make sure $_SESSION['id'] contains the user's ID

    // Update votes in the database
    $updatevotes = mysqli_query($con, "UPDATE userdata SET votes = '$totalvotes' WHERE id = '$gid'");
    // Update status in the database
    $updatestatus = mysqli_query($con, "UPDATE userdata SET status = 1 WHERE id = '$uid'");

    // Check if both updates were successful
    if($updatevotes && $updatestatus) {
        // Get updated group data from the database
        $getgroups = mysqli_query($con,"SELECT username, photo, votes, id FROM userdata WHERE standard = 'group'");
        $groups = mysqli_fetch_all($getgroups, MYSQLI_ASSOC);

        // Store updated group data in session
        $_SESSION['groups'] = $groups;
        $_SESSION['status'] = 1; // Update user's voting status

        // Display success message and redirect
        echo '<script>
            alert("Voting Successful");
            window.location="../partials/dashboard.php";
            </script>';
        exit;
    } else {
        // Display error message if database update fails
        echo '<script>
            alert("Technical Error !! Please try again later!!!");
            window.location="../partials/dashboard.php";
            </script>';
        exit; 
    }
} else {
    // Display error message for invalid request
    echo '<script>
        alert("Error: Invalid Request!!!");
        window.location="../partials/dashboard.php";
        </script>';
    exit; 
}
?>
