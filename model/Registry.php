<?php
namespace test2\model;

use Exception;

/**
 * Class Registry
 */
final class Registry
{
    private static $_instance = null;
    private $vars = [];
    public $session;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!is_object(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }

    public function __set($key, $var)
    {
        if (isset($this->vars[$key]) == true) {
            throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }

        $this->vars[$key] = $var;

        return true;
    }

    public function &__get($key)
    {
        if (isset($this->vars[$key]) == false) {
            return null;
        }

        return $this->vars[$key];
    }

    public function __isset($key)
    {
        return isset($this->vars[$key]);
    }

    public function __unset($key)
    {
        unset($this->vars[$key]);
    }
}

?>