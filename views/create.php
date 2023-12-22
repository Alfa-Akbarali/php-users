

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>

<style>


html {
    height: 100%;
  }
  body {
    margin:0;
    padding:0;
    font-family: sans-serif;
    background: linear-gradient(#141e30, #243b55);
  }
  
  .login-box {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    padding: 40px;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,.5);
    box-sizing: border-box;
    box-shadow: 0 15px 25px rgba(0,0,0,.6);
    border-radius: 10px;
  }
  
  .login-box h2 {
    margin: 0 0 30px;
    padding: 0;
    color: #fff;
    text-align: center;
    text-shadow: 0px 0px 30px #00BFFF;
  }
  
  .login-box .user-box {
    position: relative;
  }
  
  .login-box .user-box input {
    width: 100%;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    margin-bottom: 30px;
    border: none;
    border-bottom: 1px solid #fff;
    outline: none;
    background: transparent;
  }
  .login-box .user-box label {
    position: absolute;
    top:0;
    left: 0;
    padding: 10px 0;
    font-size: 16px;
    color: #fff;
    pointer-events: none;
    transition: .5s;
  }
  
  .login-box .user-box input:focus ~ label,
  .login-box .user-box input:valid ~ label {
    top: -20px;
    left: 0;
    color: #00BFFF;
    font-size: 12px;
  }
 .creat_user{
    border-radius: 8px;
    border: 0px; 
    position: relative;
    display: inline-block;
    padding: 10px 20px;
    color: #00BFFF;
    font-size: 16px;
    text-decoration: none;
    text-transform: uppercase;
    overflow: hidden;
    transition: .5s;
    margin-top: 5px;
    letter-spacing: 4px;
    background-color: transparent;
    
 } 
.creat_user:hover{
    background: #00BFFF;
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 5px #00BFFF,
                0 0 15px #00BFFF,
                0 0 20px #00BFFF,
                0 0 50px #00BFFF;
}
</style>

</head>

<body>
    
<div class="login-box">
    <h2>Create New User</h3>
    <form method="post" action="/users">
        <!----------------------- Firstname ---------------------->
        <div class="user-box">
            <input type="text" name="firstname" required>
            <label for="firstname">First Name:</label>
        </div>
       <!----------------------- Lastname ------------------------>
        <div class="user-box">
            <input type="text" name="lastname" required> 
            <label for="lastname">Last Name:</label>
        </div>
        <!----------------------- Age ---------------------------->
        <div class="user-box">
            <input type="text" name="age" required> 
            <label for="age">Age</label>
        </div>
        <!----------------------- Email -------------------------->
        <div class="user-box">
            <input type="email" name="email" required> 
            <label for="email">Email</label>
        </div>
        <!----------------------- Password ----------------------->
        <div class="user-box">
            <input type="password" name="password" required>
            <label for="password">Password</label>
        </div>
        <!-------------------- Action_Create --------------------->
            <input type="hidden" name="action" value="create"> 
            <input class="creat_user" type="submit" value="Create User">
    </form>
</div>
  
<?php 
$userController = new \controller\UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["action"])){
        $action = $_POST["action"];
           $user_info = [
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "age" => $_POST["age"],
            "email" => $_POST["email"],
            "password" => $_POST["password"],
           ];
           $userController->createUser($user_info);
    }
}
?>



</body>
</html>