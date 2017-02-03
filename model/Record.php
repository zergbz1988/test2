<?php
namespace test2\model;

use PDO;
use ReflectionClass;

abstract class Record
{
    protected $registry;
    protected $tableName;
    public $pk;
    public $attributes;

    function __construct($registry)
    {
        $this->registry = $registry;
    }

    public function findAll()
    {
        /* @var $this ->registry->db PDO */
        $rows = $this->registry->db->prepare('SELECT * FROM ' . $this->tableName);
        $rows->execute();
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

    public function findOne($id)
    {
        /* @var $this ->registry->db PDO */
        $rows = $this->registry->db->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id=:id');
        $rows->execute(['id' => $id]);
        $result = null;
        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
            $calledClassName = get_called_class();
            $model = new $calledClassName($this->registry);
            foreach ($row as $attribute => $value) {
                $model->attributes[$attribute] = $value;
                $model->pk = $row['id'];
            }
            $result = $model;
            break;
        }

        return $result;
    }

    public function load($data)
    {
        foreach ($data as $attr => $val) {
            $this->attributes[$attr] = $val;
        }

        return true;
    }

    abstract public function delete();
    abstract public function save($insert = false);
}