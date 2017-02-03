<?php
namespace test2\model\form;

use test2\model\record\User;

class RegisterForm
{
    protected $registry;
    public $name;
    public $email;
    public $password;
    private $user;

    function __construct($registry, $user = null)
    {
        $this->registry = $registry;
        if ($user === null) {
            $this->user = new User($this->registry);
        } else {
            $this->user = $user;
        }

        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function register()
    {
        $user = $this->user;
        $user->attributes['name'] = $this->name;
        $user->attributes['email'] = $this->email;
        $user->setPassword($this->password);
        $user->save(true);
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
        if ($query->fetchColumn() > 0) {
            return ['email' => "Пользователь с таким email уже существует в базе данных"];
        }

        if (empty($this->name)) {
            return ['name' => "Необходимо заполнить имя"];
        }

        if (!preg_match('/^[a-zA-Zа-яА-Я]+$/', $this->name)) {
            return ['name' => "Имя может состоять только из букв"];
        }

        if (strlen($this->name) > 60) {
            return ['name' => "Имя может быть не длиннее 60 символов"];
        }

        if (empty($this->password)) {
            return ['password' => "Необходимо заполнить пароль"];
        }

        if (strlen($this->password) < 6 || strlen($this->password) > 32) {
            return ['password' => "Пароль может быть не короче 6 и длиннее 32 символов"];
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

