<?php

/**
 * @var $model \test2\model\form\RegisterForm
 */

$this->title = 'Вход';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->title ?></div>
    </div>
    <div class="col-xs-6 panel">
        <form id="loginForm" class="form-horizontal panel-body" action="/site/login" method="post">
            <div class="form-group loginform-email <?= isset($error) ? array_key_exists('email', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="loginform-email">Email</label>
                <div class="col-sm-9">
                    <input type="text" id="loginform-email" class="form-control" name="LoginForm[email]" value="<?= $model->email ?>">
                    <div class="help-block help-block-error "><?= isset($error) ? array_key_exists('email', $error) ? $error['email'] : '' : '' ?></div>
                </div>

            </div>
            <div class="form-group loginform-password <?= isset($error) ? array_key_exists('password', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="loginform-password">Пароль</label>
                <div class="col-sm-9">
                    <input type="password" id="loginform-password" class="form-control"
                           name="LoginForm[password]">
                    <div class="help-block help-block-error"><?= isset($error) ? array_key_exists('password', $error) ? $error['password'] : '' : '' ?></div>
                </div>
            </div>

            <button type="submit" class="btn-success btn pull-right btn-signup" name="signup-button">
                Вход
            </button>
        </form>
    </div>
</div>