<?php
namespace test2\model\form;

use test2\model\record\User;
use PDO;

class LoginForm
{
    protected $registry;
    public $email;
    public $password;
    /* @var $user User*/
    private $user;

    function __construct($registry)
    {
        $this->registry = $registry;
        $this->user = new User($this->registry);
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        /* @var $user User */
        $user = $this->user;
        $_SESSION['user_id'] = $user->pk;
    }

    public function validate()
    {
        if (empty($this->email)) {
            return ['email' => "Необходимо заполнить Email"];
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => "Email должен быть задан в правильном формате"];
        }

        if (strlen($this->email) > 120) {
            return ['email' => "Email может быть не длиннее 120 символов"];
        }

        $query = $this->registry->db->prepare("SELECT COUNT(id) FROM user WHERE email=:email");
        $query->execute(['email' => $this->email]);
        if ($query->fetchColumn() == 0) {
            return ['email' => "Пользователь с таким email не найден в базе данных"];
        }

        if (empty($this->password)) {
            return ['password' => "Необходимо заполнить пароль"];
        }

        if (strlen($this->password) < 6 || strlen($this->password) > 32) {
            return ['password' => "Пароль может быть не короче 6 и длиннее 32 символов"];
        }

        $query = $this->registry->db->prepare("SELECT * FROM user WHERE email=:email");
        $query->execute(['email' => $this->email]);
        $this->user = $this->user->findOne($query->fetch(PDO::FETCH_ASSOC)['id']);
        if (!password_verify($this->password, $this->user->attributes['password_hash'])) {
            return ['password' => "Введен неправильный пароль. Попробуйте еще раз"];
        }

        return true;
    }

    public function load($data)
    {
        foreach ($data as $attr => $val) {
            if (isset($this->$attr)) {
                $this->$attr = $val;
            }
        }

        return true;
    }
}

