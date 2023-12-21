<?php

if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = "user";
    $password = "user";

    if($_POST["username"] = $username && $_POST["password"] == $password)
    {
        $_SESSION["username"] = $username;

        header("Location: /users");
        exit();
    }else
    {
        $error_massage = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<style>   
* {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      background-image: url(https://img.freepik.com/free-vector/gradient-black-backgrounds-with-golden-frames_23-2149150610.jpg?w=1380&t=st=1703152361~exp=1703152961~hmac=0e0ec023e69fdc2c4a1e1273d2fe1183cf4e3f2fc16d7f7693d2fd4c6a891924);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
     
    }

    .form-container {
      width: 600px;
      margin: 0 auto;
      padding: 50px;
      background-color: #333;
      border-radius: 10px;
      box-shadow: 0px 0px 40px 15px rgba(201, 234, 62, 0.2);
      color: #fff;
      
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 36px;
      color: aqua;
      text-shadow: 2px 2px 15px rgb(20 184 166);
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 10px;
      font-size: 18px;
    }

    input {
      padding: 12px;
      border: none;
      border-radius: 20px;
      margin-bottom: 20px;
      font-size: 16px;
      color: #fff;
      background-color: #555;
      border:2px solid aqua;
      border-radius: 20px;
    }
    button {
      padding: 10px;
      background-color: #b38bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.2s ease-in-out;
    }

    button:hover {
      background-color: #8c5fb2;
    }

    a {
      text-decoration: none;
      color: #b38bff;
      font-size: 18px;
      transition: color 0.2s ease-in-out;
    }

    a:hover {
      color: #8c5fb2;
    }

    p {
      text-align: center;
      margin: 5px;
      padding-top: 20px;
    }

</style>   
</head>
<body>
<div class="container">
    <div class="form-container" id="login-form">
      <h1 class="sign_up">Sign up</h1>
      <form method="post" action="login.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
      </form>
      <p>Don't have an account? <a href="#" id="signup-link">Sign up</a></p>
    </div>
</div>    
</body>
</html>