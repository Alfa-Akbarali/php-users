<form method="post" action="/users">
    <h3>Create New User</h3>
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" required> <br>
    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" required> <br>
    <label for="age">Age</label>
    <input type="text" name="age" required> <br>
    <label for="email">Email</label>
    <input type="email" name="email" required> <br>
    <label for="password">Password</label>
    <input type="password" name="password" required> <br>
    <input type="hidden" name="action" value="create"> 
    <input type="submit" value="Create User"> 
</form>
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