<?php
namespace test2\controller;

use Exception;
use ReflectionClass;
use test2\view\View;

abstract class Action
{
    protected $registry;
    private $_view;

    function __construct($registry) {
        $this->registry = $registry;
    }

    abstract function indexAction();

    function render($view, $params = [])
    {
        $contentFile = __DIR__ . '/../view/' . strtolower((new ReflectionClass($this))->getShortName()) . DS . $view . '.php';

        if (!file_exists($contentFile)) {
            throw new Exception('View file not found');
        } else {
            $content = $this->getView()->render($contentFile, $params);
            return $this->renderContent($content);
        }
    }

    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = new View($this->registry);
        }
        return $this->_view;
    }

    public function setView($view)
    {
        $this->_view = $view;
    }

    public function renderContent($content)
    {
        $output = $this->getView()->render($this->registry->layout, ['content' => $content]);
        return $output;
    }
}