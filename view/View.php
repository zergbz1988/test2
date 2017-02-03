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

    function __set($varname, $value)
    {
      /*  if (isset($this->vars[$varname]) == true) {
            trigger_error('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }*/

        $this->vars[$varname] = $value;
        return true;
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
