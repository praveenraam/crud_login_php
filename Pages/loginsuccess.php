<?php
require '../db/conn.db.php';
session_start();

$query = "SELECT * FROM user_det where email='" . $_SESSION['email'] . "'";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$_SESSION['user_id'] = $row['user_id'];
$_SESSION['pwd'] = $row['pwd'];

?>


<!DOCTYPE html>
<html>

<head>
    <title>User Details</title>
    <style>
        .user-details {
            width: 300px;
            margin: auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
        }

        .user-details h2 {
            text-align: center;
        }

        .user-details ul {
            list-style: none;
            padding: 0;
        }

        .user-details li {
            margin-bottom: 10px;
        }

        .user-details li strong {
            font-weight: bold;
        }

        .user-details li span {
            font-weight: normal;
        }

        a,
        button {
            cursor: pointer;
            border: none;
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover,
        button:hover {
            background-color: #0069d9;
        }
    </style>
</head>

<body>
    <div class="user-details">
        <h2>User Details</h2>
        <ul>
            <li><strong>First Name:</strong> <span id="first-name"><?php echo $row['firstname']; ?></span></li>
            <li><strong>Last Name:</strong> <span id="last-name"><?php echo $row['lastname']; ?></span></li>
            <li><strong>Email:</strong> <span id="email"></span><?php echo $row['email']; ?></li>
            <!-- <li><strong>Password:</strong> <span id="password"><?php echo $row['pwd']; ?></span></li> -->
        </ul>
        <a href="./update.php">Update your details</a>

        <button type="button" onclick="LogoutHandler()">Logout</button>
    </div>
    <script>
        function LogoutHandler() {
            const URL = "../includes/session_destroy.inc.php";

            fetch(URL, {
                method: "POST",
            }).then(response => {
                window.location.href = "../"
            });
        }
    </script>
</body>

</html>