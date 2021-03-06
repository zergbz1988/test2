<?php
namespace test2\controller;

use Exception;

class Router
{
    private $registry;
    private $path;
    private $args = array();

    function __construct($registry)
    {
        $this->registry = $registry;
    }

    function setPath($path)
    {
        $path .= DS;

        if (is_dir($path) == false) {
            throw new Exception('Invalid controller path: `' . $path . '`');
        }
        
        $this->path = $path;
    }

    function delegate()
    {
        $this->getController($file, $controller, $action, $args);

        if (is_readable($file) == false) {
            header( 'Location: /site/error', true, 303);
            exit;
        }

        include($file);
        $class = 'test2\controller\action\\' .  mb_convert_case ($controller, MB_CASE_TITLE);
        
        $action = $action . 'Action';
        $controller = new $class($this->registry);
       

        if (is_callable([$controller, $action]) == false) {
            header( 'Location: /site/error', true, 303);
            exit;
        }


        if (is_array($args)) {
            $controller->$action($args);
        } else {
            $controller->$action();
        }
    }

    private function getController(&$file, &$controller, &$action, &$args)
    {
        $route = (empty($_GET['r'])) ? '' : $_GET['r'];
        if (empty($route)) {
            $route = 'site/index';
        }

        $route = trim($route, '/\\');
        
        $parts = explode('/', $route);
        $cmd_path = $this->path;

        foreach ($parts as $part) {
            $fullpath = $cmd_path . mb_convert_case ($part, MB_CASE_TITLE);
            if (is_dir($fullpath)) {
                $cmd_path .= $part . DS;
                array_shift($parts);
                continue;
            }

            if (is_file($fullpath . '.php')) {
                $controller = $part;
                array_shift($parts);
                break;
            }

        }
        
        if (empty($controller)) {
            $controller = 'site';
        };

        $action = array_shift($parts);

        if (empty($action)) {
            $action = 'index';
        }

        $file = $cmd_path . mb_convert_case ($controller, MB_CASE_TITLE) . '.php';
        $args = $parts;
    }
}

?>