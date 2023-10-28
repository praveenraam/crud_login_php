<?php
require '../db/conn.db.php';
session_start();

$query = "SELECT * FROM user_det WHERE user_id=" . $_SESSION['user_id'];
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .form-group {
            margin: 10px 0;
        }

        label {
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #0074e4;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0050a3;
        }

        .update-link {
            display: block;
            text-align: center;
            text-decoration: none;
            background-color: #0074e4;
            color: #fff;
            padding: 10px;
            border-radius: 3px;
            margin-top: 10px;
        }

        .update-link:hover {
            background-color: #0050a3;
        }
    </style>
</head>

<body>
    <form>
        <div class="form-group">
            <label for="first-name">First Name:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname'] ?>">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
        </div>
        <div class="form-group">
            <label for="password">Enter Password to Update the Profile:</label>
            <input type="password" id="pwd" name="pwd" required>
        </div>
        <button type="button" onclick="UpdateHandler()">Update</button>
    </form><br>
    <a href="updatePwd.php" class="update-link">Update Password</a>

</body>

<script>
    function UpdateHandler() {
        let firstname = document.getElementById('firstname').value;
        let lastname = document.getElementById('lastname').value;
        let email = document.getElementById('email').value;
        let pwd = document.getElementById('pwd').value;

        if (firstname == "" || lastname == "" || email == "" || pwd == "") {
            alert("Enter all the feilds");
        } else {
            if (firstname == `<?php echo $row['firstname'] ?>` && lastname == `<?php echo $row['lastname'] ?>` && email == `<?php echo $row['email'] ?>`) {
                alert("No changes made")
            } else if (pwd == `<?php echo $row['pwd'] ?>`) {
                const data = {
                    firstname: `${firstname}`,
                    lastname: `${lastname}`,
                    email: `${email}`,
                }

                URL = '../includes/updatehandler.inc.php';

                fetch(URL, {
                    method: 'POST',
                    header: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data),
                }).then(async (response) => {
                    let data = await response.json();

                    if (data.success == true) {
                        alert(data.message);
                        window.location.href = 'loginsuccess.php';
                    } else {
                        alert(data.message);
                    }
                })

            } else {
                alert("Incorrect Password");
            }
        }
    }
</script>

</html>