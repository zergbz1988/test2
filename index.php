<?php
namespace test2;

require_once (__DIR__ . '/vendor/autoload.php');

use test2\model\Registry;
use test2\controller\Router;
use PDO;
use test2\view\View;

error_reporting(E_ALL);

if (version_compare(phpversion(), '5.6.0', '<') == true) {
    die ('PHP5.6 Only');
}

define ('DS', DIRECTORY_SEPARATOR);
define('webroot', realpath(dirname(__FILE__) . DS) . DS);

$registry = Registry::getInstance();

$db = new PDO('mysql:host=localhost;dbname=test2', 'root', '');
$registry->db = $db;

session_start();
$registry->session = $_SESSION;

$layout = __DIR__ . '/view/layout/main.php';

if (!file_exists($layout)) {
    die ('No layout found!');
}

$registry->layout = $layout;
$view = new View($registry);
$registry->view = $view;

$router = new Router($registry);
$registry->router = $router;
$router->setPath(webroot . 'controller\action');
$router->delegate();


