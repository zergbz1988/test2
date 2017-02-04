<?php
namespace test2\view;

class View
{
    private $registry;
    private $vars = [];

    function __construct($registry)
    {
        $this->registry = $registry;
    }

    function __set($key, $value)
    {
        $this->vars[$key] = $value;
    }

    function __get($key)
    {
        return $this->vars[$key] ?? null;
    }

    public function __isset($key)
    {
        return isset($this->vars[$key]);
    }

    function __unset($varname)
    {
        unset($this->vars[$varname]);
    }

    public function render($view, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require($view);
        return ob_get_clean();
    }
}

?>
