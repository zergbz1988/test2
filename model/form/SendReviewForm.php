<?php
namespace test2\model\form;

use test2\model\record\Review;

class SendReviewForm
{
    protected $registry;
    public $name;
    public $email;
    public $title;
    public $message;
    public $code;

    private $review;

    function __construct($registry, $review = null)
    {
        $this->registry = $registry;
        if ($review === null) {
            $this->review = new Review($this->registry);
        } else {
            $this->review = $review;
        }

        $this->name = '';
        $this->email = '';
        $this->title = '';
        $this->message = '';
        $this->code = '';
    }

    function checkCode($code)
    {
        session_start();
        $cap = $_SESSION['captcha'] ?? '';
        unset($_SESSION['captcha']);

        $code = trim($code);

        if (password_verify($code, $cap)) {
            return true;
        } else {
            return false;
        }

    }

    public function send()
    {
        $review = $this->review;
        $review->attributes['name'] = $this->name;
        $review->attributes['email'] = $this->email;
        $review->attributes['title'] = $this->title;
        $review->attributes['message'] = $this->message;
        $review->save(true);
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

//        $query = $this->registry->db->prepare("SELECT COUNT(id) FROM user WHERE email=:email");
//        $query->execute(['email' => $this->email]);
//        if ($query->fetchColumn() > 0) {
//            return ['email' => "Пользователь с таким email уже существует в базе данных"];
//        }

        if (empty($this->name)) {
            return ['name' => "Необходимо заполнить имя"];
        }

        if (!preg_match('/^[a-zA-Zа-яА-Я]+$/', $this->name)) {
            return ['name' => "Имя может состоять только из букв"];
        }

        if (strlen($this->name) > 60) {
            return ['name' => "Имя может быть не длиннее 60 символов"];
        }

        if (empty($this->title)) {
            return ['title' => "Необходимо заполнить заголовок отзыва"];
        }

        if (strlen($this->title) > 120) {
            return ['title' => "Заголовок отзыва может быть не короче 6 и длиннее 300 символов"];
        }

        if (empty($this->message)) {
            return ['message' => "Необходимо заполнить текст отзыва"];
        }

        if (strlen($this->message) < 6 || strlen($this->message) > 300) {
            return ['message' => "Текст отзыва может быть не короче 6 и длиннее 300 символов"];
        }

        if (empty($this->code)) {
            return ['code' => "Необходимо ввести капчу"];
        }

        if (!$this->checkCode($this->code)) {
            return ['code' => "Капча введена неверно"];
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

