<?php

namespace model;

use SQLite3;
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