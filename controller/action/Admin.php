<?php
namespace test2\controller\action;

use test2\controller\Action;
use test2\model\record\Review;
use test2\model\record\User;
use Exception;

class Admin extends Action
{
    function indexAction()
    {
        if (empty($this->registry->session['user_id'])) {
            header('Location: /site/login', true, 303);
            exit;
        } else {
            $user = new User($this->registry);
            $isAdmin = $user->isAdmin($this->registry->session['user_id']);
            if (!$isAdmin) {
                header('Location: /site/login', true, 303);
                exit;
            }
        }

        $model = new Review($this->registry);
        $models = $model->findNotApproved();

        echo $this->render('index', ['models' => $models]);
    }

    function viewAction($args)
    {
        if (empty($this->registry->session['user_id'])) {
            header('Location: /site/login', true, 303);
            exit;
        } else {
            $user = new User($this->registry);
            $isAdmin = $user->isAdmin($this->registry->session['user_id']);
            if (!$isAdmin) {
                header('Location: /site/login', true, 303);
                exit;
            }
        }

        $model = new Review($this->registry);
        /* @var $model null | Review */
        $model = $model->findOne($args[0]);
        if ($model === null) {
            throw new Exception('Отзыв не найден!');
        }

        echo $this->render('view', ['model' => $model]);
    }

    function deleteAction($args)
    {
        if (empty($this->registry->session['user_id'])) {
            header('Location: /site/login', true, 303);
            exit;
        } else {
            $user = new User($this->registry);
            $isAdmin = $user->isAdmin($this->registry->session['user_id']);
            if (!$isAdmin) {
                header('Location: /site/login', true, 303);
                exit;
            }
        }

        $model = new Review($this->registry);
        /* @var $model null | Review */
        $model = $model->findOne($args[0]);
        if ($model === null) {
            throw new Exception('Отзыв не найден!');
        }

        $model->delete();

        $_SESSION['flash-error'] = 'Отзыв был успешно удален!';
        header('Location: /admin/index', true, 303);
        exit;
    }

    function approveAction($args)
    {
        if (empty($this->registry->session['user_id'])) {
            header('Location: /site/login', true, 303);
            exit;
        } else {
            $user = new User($this->registry);
            $isAdmin = $user->isAdmin($this->registry->session['user_id']);
            if (!$isAdmin) {
                header('Location: /site/login', true, 303);
                exit;
            }
        }

        $model = new Review($this->registry);
        /* @var $model null | Review */
        $model = $model->findOne($args[0]);

        if ($model === null) {
            throw new Exception('Отзыв не найден!');
        }

        $model->approve();
        $_SESSION['flash-success'] = 'Отзыв был успешно одобрен!';
        header('Location: /admin/index', true, 303);
        exit;
    }
}