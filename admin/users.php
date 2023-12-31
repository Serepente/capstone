<?php
include "includes/database.php";
session_start();

if (isset($_SESSION['username'])&&isset($_SESSION['profilePhoto'])) {

    $username = $_SESSION['username'];
    $profilePic = $_SESSION['profilePhoto'];
} else {

    header("Location: log-in.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main-container d-flex h-100">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pd-4 d-flex justify-content-between">
                <h2 class="text-white px-2">QuickRentz</h2>
                <button class="btn d-md-none d-block close-btn px-1 py-0"><i class="fa-solid fa-bars-staggered"
                        style="color: #ffffff;"></i></button>
            </div>
            <ul class="list-unstyled px-2 pt-3">
                <li class="p-3"><a href="main.php" class="text-decoration-none fs-4">Dashboard</a></li>
                <li class="p-3"><a href="#" class="text-decoration-none fs-4">Manage Booking</a></li>
                <li class="p-3 active"><a href="users.php" class="text-decoration-none fs-4">Customer Credential</a>
                </li>
                <li class="p-3"><a href="vehicles.php" class="text-decoration-none fs-4">Manage Vehicle</a></li>
                <li class="p-3"> <a class="text-decoration-none fs-4" data-bs-toggle="collapse" href="#collapseAdd"
                        role="button" aria-expanded="false" aria-controls="collapseAdd">Add <i
                            class="fa-solid fa-caret-down"></i>
                    </a>
                    <ul class="collapse list-unstyled" id="collapseAdd">
                        <li><a class="text-decoration-none fs-5 p-3" href="addVehicles.php">Car</a></li>
                        <li><a class="text-decoration-none fs-5 p-3" href="addAdmins.php">Admin</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="list-unstyled signout px-4">
                <li>
                    <form method="POST" action="">
                        <a class="text-decoration-none fs-4" href="log-out.php" type="button">Log-out</a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="content">
            <nav class="navbar navbar-expand-lg bg-dark">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <a class="navbar-brand text-white" href="#">QuickRentz</a>
                        <button class="btn d-md-none d-block open-btn px-1 py-0"><i class="fa-solid fa-bars-staggered"
                                style="color: #000000;"></i></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="profile collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <h5 class="text-white my-auto p-4">
                                <img src='img/adminprofilephoto/<?php echo $profilePic ?>' alt='' style='border:2px solid #000;border-radius: 50px;' height='50'>
                                    <?php
                                    echo $username;
                                    ?>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1 class="col-md-12 px-3">List of Registered Users</h1>
            <hr>
            <div class="container">
                <table id="pagination" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Full Address</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlUserList = "SELECT * FROM `user`";
                        $initiateUserList = mysqli_query($conn, $sqlUserList);
                        while ($results = mysqli_fetch_assoc($initiateUserList)) {
                            echo "
                                <tr>
                                    <th scope='row'>$results[UserID]</th>
                                    <td>$results[FirstName]</td>
                                    <td>$results[LastName]</td>
                                    <td>$results[Username]</td>
                                    <td>$results[PhoneNumber]</td>
                                    <td>$results[Address]</td>
                                    <td>$results[Email]</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Full Address</th>
                            <th scope="col">Email</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- CDN FOR PAGINATION -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>
        <script>
            $(".sidebar ul li").on('click', function () {
                $(".sidebar ul li.active").removeClass('active');
                $(this).addClass('active');
            });
            $(".open-btn").on('click', function () {
                $('.sidebar').addClass('active');
            });
            $(".close-btn").on('click', function () {
                $('.sidebar').removeClass('active');
            });
            new DataTable('#pagination');
        </script>
</body>

</html>