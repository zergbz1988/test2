<?php
namespace test2\controller\action;

use test2\controller\Action;
use test2\model\form\LoginForm;
use test2\model\form\RegisterForm;
use test2\model\form\SendReviewForm;
use test2\model\record\Review;
use test2\model\record\User;
use Exception;

class Site extends Action
{
    function indexAction()
    {
        $model = new Review($this->registry);
        $models = $model->findApproved();
        $model = new SendReviewForm($this->registry);
        $data = $_POST['SendReviewForm'] ?? null;
        if ($data) {
            $model->load($data);
            $validate = $model->validate();
            if ($validate === true) {
                $model->send();
                $_SESSION['flash-success'] = 'Ваш отзыв был отправлен на проверку!';
                header('Location: /site/index', true, 303);
                exit;
            } else {
                $error = $validate;
                echo $this->render('index', ['models' => $models, 'reviewForm' => $model, 'error' => $error]);
                return;
            }
        }

        echo $this->render('index', ['models' => $models, 'reviewForm' => $model]);
    }

    function allAction()
    {
        $model = new Review($this->registry);
        $models = $model->findAll();

        echo $this->render('all', ['models' => $models]);
    }

    function viewAction($args)
    {
        $model = new Review($this->registry);
        $model = $model->findOne($args[0]);
        if ($model === null) {
            throw new Exception('Отзыв не найден!');
        }

        echo $this->render('view', ['model' => $model]);
    }

    function registerAction()
    {
        $model = new RegisterForm($this->registry);
        $data = $_POST['RegisterForm'] ?? null;
        if ($data) {
            $model->load($data);
            $validate = $model->validate();
            if ($validate === true) {
                $model->register();
                header('Location: /site/index', true, 303);
                exit;
            } else {
                $error = $validate;
                echo $this->render('register', ['model' => $model, 'error' => $error]);
                return;
            }
        }

        echo $this->render('register', ['model' => $model]);
    }

    function loginAction()
    {
        $model = new LoginForm($this->registry);
        $data = $_POST['LoginForm'] ?? null;
        if ($data) {
            $model->load($data);
            $validate = $model->validate();
            if ($validate === true) {
                $model->login();
                header('Location: /admin/index', true, 303);
                exit;
            } else {
                $error = $validate;
                echo $this->render('login', ['model' => $model, 'error' => $error]);
                return;
            }
        }

        echo $this->render('login', ['model' => $model]);
    }

    function logoutAction()
    {
        unset($_SESSION['user_id']);
        header('Location: /site/index', true, 303);
        exit;
    }

    function errorAction()
    {
        echo $this->render('error');
    }
}