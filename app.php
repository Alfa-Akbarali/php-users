<?php 


class User 
{
    protected $db;

    public function __construct()
    {
        $this->db = new SQLite3('database.sql');
        $this->createTable();
    }

    private function createTable()
    {
        $this->db->exec('
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            firstname TEXT,
            lastname TEXT,
            age INTEGER,
            password TEXT,
            email TEXT  
            )
        ');
    }

    public function create($user_info){
        $stmt = $this->db->prepare('
        INSERT INTO users (firstname, lastname, age , password, email)
        VALUES (:firstname, :lastname, :age, :password, :email)
        ');

        $stmt->bindValue(':firstname', $user_info['firstname']);
        $stmt->bindValue(':lastname', $user_info['lastname']);
        $stmt->bindValue(':age', $user_info['age']);
        $stmt->bindValue(':password', $user_info['password']);
        $stmt->bindValue(':email', $user_info['email']);

        $stmt->execute();

        return $this->db->lastInsertRowID();
    }

    public function find($user_id){
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindValue(':id', $user_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        
        return $result->fetchArray(SQLITE3_ASSOC);
    }

    public function all(){
        $result = $this->db->query('SELECT * FROM users');
        $users = [];
        
        
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row;
        }
        
        return $users;
    }

    public function update($user_id, $attribute, $value){
        $stmt = $this->db->prepare("UPDATE users SET $attribute = :value WHERE id = :id");
        $stmt->bindValue(':value', $value);
        $stmt->bindValue(':id', $user_id,SQLITE3_INTEGER);
        $stmt->execute();

        return $this->find($user_id);
    }

    public function destroy($user_id){
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue(':id', $user_id,SQLITE3_INTEGER);
        $stmt->execute();

    }
}

class UserController{
    protected $user;

    public function __construct(){
        $this->user = new User();
    }

    public function createUser($user_info){
        $user = $this->user->create($user_info);

        unset($user_info['password']);
        return json_encode([
            'success' => true,
            'user_id' => $user,
        ]);
    }

    public function findUser($user_id){
        $user = $this->user->find($user_id);
        unset($user['password']);
        return json_encode($user);
    }

    public function getAllUsers(){
        $users = $this->user->all();
        foreach($users as $user){
            unset($user['password']);
            return json_encode($users);
        }
    }

    public function updateUser($user_id, $attribute, $value){
        $user = $this->user->update($user_id, $attribute, $value);
        unset($user['password']);
        return json_encode([
         'success' => true 
        ,'user' => $user
    ]);
    }

    public function destroyUser($user_id){
      $this->user->destroy($user_id);
      return 'User deleted successfully';
    }
}

$userController = new UserController();
$userController1 = new UserController();

$user_info = [
    'firstname' => "John",
    'lastname' => "Kennedy",
    'age' => "38",
    'password' => "John4882hr",
    'email' => "Kennedy@gmail.com",
];

$user_info = [
    'firstname' => "Nike",
    'lastname' => "Nelson",
    'age' => "38",
    'password' => "JNls4882hr",
    'email' => "Nike@gmail.com",
];



// echo $userController->createUser($user_info) . PHP_EOL;
// echo $userController1->createUser($user_info) . PHP_EOL;
// echo $userController->getAllUsers() . PHP_EOL;
// echo $userController->updateUser(2, 'firstname', 'Avaz') . PHP_EOL;
// echo $userController->updateUser(2, 'age', '21') . PHP_EOL;
// echo $userController->updateUser(2, 'password', '13874hkwsd') . PHP_EOL;
// echo $userController->updateUser(2, 'email', 'ava@gmail.com') . PHP_EOL;
// echo $userController->destroyUser(4) . PHP_EOL;
// echo $userController->findUser(10) . PHP_EOL;
// echo $userController->findUser(1) . PHP_EOL;

?>