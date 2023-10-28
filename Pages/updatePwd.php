<?php
require '../db/conn.db.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="button"] {
            width: 100%;
            padding: 10px;
            background-color: #0074e4;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #0050a3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Update Password</h2>
        <form>
            <label for="old_password">Old Password:</label>
            <input type="password" id="O_password" name="old_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="button" onclick="pwdUpdateHandler()" value="Update Password">
        </form>
    </div>
</body>

<script>
    function pwdUpdateHandler() {
        const O_password = document.getElementById('O_password').value;
        const new_password = document.getElementById('new_password').value;
        const confirm_password = document.getElementById('confirm_password').value;

        if (O_password == '' || new_password == '' || confirm_password == '') {
            alert("Enter all the feild");
        } else if (new_password != confirm_password) {
            alert("Confirm password doesn't match");
        } else if (`<?php echo $_SESSION['pwd'] ?>` != O_password) {
            alert("Incorrect Old Password");
        } else if (O_password == new_password) {
            alert("New password is same as old password")
        } else {
            const data = {
                pwd: `${new_password}`,
            }
            URL = '../includes/pwdUpdatehandler.inc.php';

            fetch(URL, {
                method: "POST",
                header: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(async (response) => {
                const data = await response.json();
                alert(data.message);
                window.location.href = 'loginsuccess.php'
            })
        }

    }
</script>

</html>