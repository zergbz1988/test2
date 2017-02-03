<?php
namespace test2\model\record;

use test2\model\Record;
use PDO;

class Review extends Record
{
    protected $tableName = 'review';

    public function delete ()
    {

    }

    public function save ($insert = false)
    {

    }

    public function findApproved()
    {
        /* @var $this ->registry->db PDO */
        $rows = $this->registry->db->prepare('SELECT * FROM ' . $this->tableName . 'WHERE approved=1');
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
}