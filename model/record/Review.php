<?php
namespace test2\model\record;

use test2\model\Record;
use PDO;

class Review extends Record
{
    protected $tableName = 'review';

    public function approve ()
    {
        $this->attributes['approved'] = true;
        $this->save(false);
    }

    public function save($insert = false)
    {
        $db = $this->registry->db;
        if ($insert) {
            $sql = "INSERT INTO review (id,
            name,
            email,
            title,
            message,
            approved) VALUES (
            :id, 
            :name, 
            :email,
            :title,
            :message, 
            :approved)";
            $query = $db->prepare($sql);
            $query->execute([
                'id' => null,
                'name' => $this->attributes['name'],
                'title' => $this->attributes['title'],
                'email' => $this->attributes['email'],
                'message' => $this->attributes['message'],
                'approved' => 0,
            ]);
        } else {
            $sql = "UPDATE review SET id = :id, 
            name = :name, 
            email = :email,  
            title = :title,
            message = :message,  
            approved = :approved  
            WHERE id = :id";
            /* @var $this ->registry->db PDO */
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $this->pk,
                'name' => $this->attributes['name'],
                'email' => $this->attributes['email'],
                'title' => $this->attributes['title'],
                'message' => $this->attributes['message'],
                'approved' => $this->attributes['approved'],
            ]);
        }
    }

    public function findApproved()
    {
        return $this->findAllByCondition('approved = :approved', ['approved' => true]);
    }

    public function findNotApproved()
    {
        return $this->findAllByCondition('approved = :approved', ['approved' => false]);
    }

    public function findAllByCondition($condition, $params = [])
    {
        $queryCondition = $condition ? ' WHERE ' . $condition : '';

        /* @var $this ->registry->db PDO */
        $rows = $this->registry->db->prepare('SELECT * FROM ' . $this->tableName . $queryCondition);
        $rows->execute($params);
        $result = [];
        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
            $calledClassName = get_called_class();
            $model = new $calledClassName($this->registry);
            foreach ($row as $attribute => $value) {
                $model->attributes[$attribute] = $value;
                $model->pk = $row['id'];
            }
            $result[] = $model;
        }

        return $result;
    }

    public function delete() {
        $db = $this->registry->db;
        $sql = "DELETE FROM " . $this->tableName . " WHERE id =  :id";
        $query = $db->prepare($sql);
        $query->execute(['id' => $this->pk]);
    }
}