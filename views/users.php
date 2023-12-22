<!DOCTYPE html>
<html>
    <head>
        <title>Users index page</title>
    </head>
    <body>
        <style>
        table 
        {
            font-family: arial, sans-serif;
            width: 100%;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 10px;
            padding-right: 10px;   
        }
        td, th 
        {
            border: 2px solid;
            text-align: left;
            padding: 8px;
            border-color: #96D4D4;
            
        }
        /* tr:nth-child(even) {
            
        }   */
        .table-header 
        {
            background-color: #ddd;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            
            
        }
        .table-row 
        {
            font-size: 14px;
            letter-spacing: 0.03em;
            
        }
        h1
        {
            font-size: 26px;
            margin: 20px 0;
            text-align: center;
        }

	td {
		position: relative;
		&:hover {
			&:before {
				content: "";
				position: absolute;
				left: 0;
				right: 0;
				top: -2px;
				bottom: -2px;
				background-color: grey;
				z-index: -1;
			}
		}
	}
    .links{
        display:flex;
        justify-self: center;
        justify-content:center;
        margin-top:20px;
        font-size:18px;
        
    }
    .login_a{
        padding:10px;
        transition-duration: 0.4s;
        color:blue; 
        text-decoration: none;
        margin-right:50px; 
        border: 2px solid #008CBA;
        border-radius:10px;
    }
    .login_a:hover {background-color: #008CBA;color:white;}
    .create_a{
        padding:10px;
        transition-duration: 0.4s;
        border: 2px solid #008CBA;
        border-radius:10px;
        color:blue;
        text-decoration: none;
    }
    .create_a:hover {background-color: #008CBA;color:white;}

    .delelete_st
    {
        background: white;
        border: 2px solid #008CBA;
        color:blue; 
        border-radius:10px;
        padding:5px;
    }
    .delelete_st:hover{background-color: #008CBA;color:white;}
    .link_user{
        font-size:15px;
        text-decoration: none;
        padding-right:30px;
        padding-left:5px;
        color:blue;
    }
    .link_user:active{color:red;}
        </style>
<!---------------------------------------- Table ---------------------------------------->
          
        <table>
        <h1>Table</h1>
        <?php
                require_once __DIR__ . '\..\controller/UserController.php';
                $userController = new \controller\UserController();
                $users = $userController->getAllUsers();
                echo $users;
        ?>
            <tr class="table-header">
                <th>#ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Edit & delete</th>
            </tr>
            
            <tr>
            <?php
                    foreach ($users as $user) {
                        echo '<tr class="table-row">';
                            echo '<td>' . $user['id'] . '</td>';
                            echo '<td>' . $user['firstname'] . '</td>';
                            echo '<td class="last_name";>' . $user['lastname'] . '</td>';
                            echo '<td>' . $user['age'] . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td> 
                            
                            <form method="post" action="users">
                            <a class="link_user" href="/edit?ide=' . $user['id'] . '>">Edit</a>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="user_id" value="' . $user['id'] . '">
                                <input class="delelete_st" type="submit" value="Delete">
                            </form>
                            </td>';
                        echo'</tr>';
                }
            ?>
        </table>
<!---------------------------------------- Links ---------------------------------------->
        <div class="links">
            <a class="login_a" href="/logout">Logout</a>
            <a class="create_a" href="/create">Create user </a>
        </div>
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