<?php 
$userController = new \controller\UserController();

if (isset($_GET['id'])){
    $user_id = $_GET['id'];
    $user_data = $userController->findUser($user_id);

    echo '<form method="post" action="/update.php">';
    echo '<input type="hidden" name="action" value="edit">';
    echo '<input type="hidden" name="user_id" value="' . $user_data['id'] . '"> <br>';
    echo '<label for="firstname">First Name:<label">';
    echo '<input type="text" name="firstname" value="' . $user_data['firstname'] . '"> <br>';
    echo '<label for="lastname">Last Name:<label">';
    echo '<input type="text" name="lastname" value="' . $user_data['lastname'] . '"> <br>';
    echo '<label for="email">Email:<label">';
    echo '<input type="email" name="email" value="' . $user_data['email'] . '"> <br>';

    echo '<input type="submit" value="Save Changes">';
    echo '</form>';
}else{
    echo 'Invalid request';
}
?>