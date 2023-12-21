<!DOCTYPE html>
<html>
    <head>
        <title>Users index page</title>
    </head>
    <body>
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }  
        </style>
        <h1>HTML table</h1>
            <?php
                
                require_once __DIR__ . '\..\controller/UserController.php';

                $userController = new controller\UserController();
                $users = $userController->getAllUsers();
                echo $users;
            ?>
        <table >
            <a href="/create">Create user</a>
            <br>
            <a href="/logout">Logout</a>
            <tr>
                <th>#ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
            <tr>
            <?php
                    foreach ($users as $user) {
                        echo '<tr>';
                            echo '<td>' . $user['id'] . '</td>';
                            echo '<td>' . $user['firstname'] . '</td>';
                            echo '<td>' . $user['lastname'] . '</td>';
                            echo '<td>' . $user['age'] . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td> 
                            <a href="/edit?ide=' . $user['id'] . '>">Edit user</a>
                            <form method="post" action="users">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="user_id" value="' . $user['id'] . '">
                                <input type="submit" value="Delete">
                            </form>
                            </td>';

                        echo '</tr>';
                }
            ?>
        </table>
    </body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["action"])){
            $action = $_POST["action"];

            switch($action) {
                case "create":
                    $user_info = [
                        "firstname" => $_POST["firstname"],
                        "lastname" => $_POST["lastname"],
                        "age" => $_POST["age"],
                        "email" => $_POST["email"],
                        "password" => $_POST["password"], 
                    ];
                    $userController->createUser($user_info);
                    break;
                
                case "edit":
                    $user_id = $_POST["user_id"];
                    $userController->updateUser($user_id);
                    break;

                case "delete":
                    $user_id = $_POST["user_id"];
                    $userController->destroyUser($user_id);
                    break;
            }
        }
    }
?>