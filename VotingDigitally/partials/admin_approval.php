<?php
$con = mysqli_connect("localhost", "root", "", "votingsystem");

if (!$con) {
    die(mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text-center mb-4">Admin Approval</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Mobile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM userdata WHERE approved = 0 ORDER BY id ASC";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td>
                                <form action="admin_approval.php" method="POST" onsubmit="return confirmAction()">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                    <button type="submit" name="approve" class="btn btn-success btn-sm mr-2">Approve</button>
                                    <button type="submit" name="deny" class="btn btn-danger btn-sm">Deny</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmAction() {
            return confirm("Are you sure you want to perform this action?");
        }
    </script>

    <?php
    if (isset($_POST['approve'])) {
        $id = $_POST['id'];

        $stmt = mysqli_prepare($con, "UPDATE userdata SET approved = 1 WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        echo '<script type="text/javascript">
                alert("User Approved!");
                window.location.href="admin_approval.php";
            </script>';
    }

    if (isset($_POST['deny'])) {
        $id = $_POST['id'];

        $stmt = mysqli_prepare($con, "DELETE FROM userdata WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        echo '<script type="text/javascript">
                alert("User Denied!");
                window.location.href="admin_approval.php";
            </script>';
    }

    ?>

</body>

</html>
