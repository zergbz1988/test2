<?php
namespace test2\controller\action;

use test2\controller\Action;
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
        $models = $model->findAll();
        echo $this->render('index', ['models' => $models]);
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

    function deleteAction($args)
    {
        $model = new Review($this->registry);
        $model = $model->findOne($args[0]);
        if ($model === null) {
            throw new Exception('Отзыв не найден!');
        }

        $model->delete();
        header( 'Location: /site/index', true, 303);
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
                header( 'Location: /site/index', true, 303);
            } else {
                $error = $validate;
                echo $this->render('register', ['model' => $model, 'error' => $error]);
                return;
            }
        }

        echo $this->render('register', ['model' => $model]);
    }

    function sendAction()
    {
        $model = new SendReviewForm($this->registry);
        $data = $_POST['SendReviewForm'] ?? null;
        if ($data) {
            $model->load($data);
            $validate = $model->validate();
            if ($validate === true) {
                $model->send();
                header( 'Location: /site/index', true, 303);
            } else {
                $error = $validate;
                echo $this->render('send', ['model' => $model, 'error' => $error]);
                return;
            }
        }

        echo $this->render('send', ['model' => $model]);
    }

    function errorAction()
    {
        echo $this->render('error');
    }
}