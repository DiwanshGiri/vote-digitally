<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../');
}

$data = $_SESSION['data'];

if ($_SESSION['status'] == 1) {
    $status = '<b class="text-success">Voted</b>';
} else {
    $status = '<b class="text-danger">Not Voted</b>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VotingDigitally Dashboard</title>
    <link rel="website icon" type="png" href="img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
    body {
        background-image: url(img/stefan-moertl-91D3NOWVrj4-unsplash.jpg);
        background-size: cover;
        background-position: center;
        background-color: rgba(255, 255, 255, 0.5);
        background-repeat: no-repeat;
        width: 1800px;
        margin: 0 auto;

    }

    .voted-btn {
        background-color: #28a745;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: not-allowed;
    }

    .vote-btn {
        background-color: #dc3545;
        color: #fff;
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .card {
        width: 40%;
        padding-left: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        opacity: 0.8;
        background-color: silver;
        display: flex;
        justify-content: space-evenly;
    }

    .card-content {
        padding: 20px;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .card-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .card-content strong {
        font-weight: 500;
        font-style: italic;
    }

    .card-content hr {
        margin: 10px 0;
        border: none;
        border-top: 1px solid #ccc;
    }

    img {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    nav {
        background-color: slategray;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        opacity: 0.9;
        position: sticky;
        top: 0%;
        cursor: pointer;
        width: 100%;
    }

    .nav-wrapper {
        padding-left: 20px;
        padding-right: 20px;
    }

    .nav-wrapper .brand-logo {
        margin-left: 0;
        font-size: 1.8em;
        color: white;
        text-transform: uppercase;
    }

    .nav-wrapper .brand-logo img {
        height: 50px;
        width: auto;
        margin-top: 10px;
        transition: transform 0.3s ease;
        display: flex;
    }

    .nav-wrapper .brand-logo:hover img {
        transform: rotate(360deg);
    }

    nav ul li a {
        color: cornsilk;
        font-size: 1.5em;
        text-transform: uppercase;
        font-weight: 500;
        font-style: italic;
    }

    nav ul li a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .container-right {
        position: sticky;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
    }

    .square-card {
        width: 250px;
        height: 400px;
        overflow: hidden;
        border-radius: 10px;
    }

    .square-card .card-image img {
        object-fit: cover;
        width: 200px;
        height: 200px;
    }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper">
                <a href="dashboard.php" class="brand-logo center">
                    <img src="img/logo.png" alt="logo">
                </a>
                <ul id="nav-mobile" class="center hide-on-med-and-down">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="row my-5">
        <div class="col s12 m7">
            <?php
        $con = mysqli_connect('localhost', 'root', '', 'votingsystem');

        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        if (isset($_SESSION['groups'])) {
            $groups = $_SESSION['groups'];
            foreach ($groups as $group) {
                $groupId = $group['id'];
                $position_query = "SELECT position FROM userdata WHERE id = $groupId";
                $position_result = mysqli_query($con, $position_query);
                if ($position_result && mysqli_num_rows($position_result) > 0) {
                    $position_row = mysqli_fetch_assoc($position_result);
                    $position = $position_row['position'];
                } else {
                    $position = "Position Not Available";
                }
        ?>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12 m4">
                            <img src="../uploads/<?php echo $group['photo'] ?>" alt="Group Image">
                        </div>
                        <div class="col s12 m8">
                            <div>
                                <strong class="text-dark h5">Group Name: </strong>
                                <?php echo $group['username'] ?>
                            </div>
                            <div>
                                <strong class="text-dark h5">Position: </strong>
                                <?php echo $position;  ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <form action="../actions/voting.php" method="POST">
                    <input type="hidden" name="groupvotes" value="<?php echo $group['votes'] ?>">
                    <input type="hidden" name="groupid" value="<?php echo $group['id'] ?>">
                    <?php if ($_SESSION['status'] == 1) { ?>
                    <button class="voted-btn my-3" disabled>Voted</button>
                    <?php } else { ?>
                    <button class="vote-btn my-3" type="submit">Vote</button>
                    <?php } ?>
                </form>
            </div>
            <?php
            }
        } else {
        ?>
            <div class="container">
                <p>No groups to Display</p>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    <?php mysqli_close($con); ?>

    <div class="container-right">
        <div class="col s12 m5">
            <div class="square-card card">
                <div class="card-image">
                    <img src="../uploads/<?php echo $data['photo'] ?>" alt="User Image">
                </div>
                <div class="card-content">
                    <p>
                        <strong class="text-dark h5">Name:</strong>
                        <?php echo $data['username']; ?>
                    </p>
                    <p>
                        <strong class="text-dark h5">Mobile:</strong>
                        <?php echo $data['mobile']; ?>
                    </p>
                    <p>
                        <strong class="text-dark h5">Status:</strong>
                        <?php echo $status; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>