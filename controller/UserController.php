<?php
namespace controller;

use model\User;

class UserController{
    protected $user;

    public function __construct(){
        $this->user = new User();
    }

    public function createUser($user_info){
        $user = $this->user->create($user_info);

        unset($user_info['password']);
        return ([
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
        }
        return $users;

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
