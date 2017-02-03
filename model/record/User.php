<?php
namespace test2\model\record;

use test2\model\Record;
use PDO;
use Exception;

class User extends Record
{
    protected $tableName = 'user';

    public function delete()
    {

    }

    public function save($insert = false)
    {
        $db = $this->registry->db;
        if ($insert) {
            $sql = "INSERT INTO user(id,
            name,
            email,
            password_hash,
            isAdmin) VALUES (
            :id, 
            :name, 
            :email, 
            :password_hash, 
            :isAdmin)";
            $query = $db->prepare($sql);
            $query->execute([
                'id' => null,
                'name' => $this->attributes['name'],
                'email' => $this->attributes['email'],
                'password_hash' => $this->attributes['password_hash'],
                'isAdmin' => 0,
            ]);
        } else {
            $sql = "UPDATE user SET id = :id, 
            name = :name, 
            email = :email,  
            password_hash = :password_hash,  
            isAdmin = :isAdmin  
            WHERE id = :id";
            /* @var $this ->registry->db PDO */
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $this->pk,
                'name' => $this->attributes['name'],
                'email' => $this->attributes['email'],
                'password_hash' => $this->attributes['password_hash'],
                'isAdmin' => 0,
            ]);
        }
    }

    public function login($data)
    {

    }

    public function setPassword($password)
    {
        $this->attributes['password_hash'] =  password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
    }
}