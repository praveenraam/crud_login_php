<?php
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    button[type="button"] {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button[type="button"]:hover {
      background-color: #45a049;
    }

    .signup-link {
      display: block;
      text-align: center;
      margin-top: 10px;
      color: rgb(117, 117, 245);
      text-decoration: none;
      transition: 0.5s all;
    }

    .signup-link:hover {
      color: rgb(71, 71, 250);
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Login</h2>
    <form id="_form">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password</label>
      <input type="password" id="pwd" name="password" required />

      <button type="button" value="Login" onclick="SubmitHandler()">
        Login
      </button>
    </form>
    <label for=""></label>
    <a class="signup-link" href="./Pages/signup.html">Create new account</a>
  </div>
</body>

</html>

<script>
  function SubmitHandler(e) {
    let email = document.getElementById("email").value;
    let pwd = document.getElementById("pwd").value;
    if (email == "" || pwd == "") {
      alert("Enter All the Feild");
    } else {
      const data = {
        email: `${email}`,
        pwd: `${pwd}`,
      };

      const URL = "./includes/loginhandler.inc.php";

      fetch(URL, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }).then(async (response) => {
        let data = await response.json();
        if (data.success == true) {
          document.getElementById("_form").reset();
          window.location.href = "./Pages/loginsuccess.php";
        } else {
          document.getElementById("_form").reset();
          alert(data.message);
        }
      });
    }
  }
</script>