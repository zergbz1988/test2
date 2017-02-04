<?php

/**
 * @var $model \test2\model\form\RegisterForm
 */

$this->title = 'Регистрация нового пользователя';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->title ?></div>
    </div>
    <div class="col-xs-6 panel">
        <form id="registerForm" class="form-horizontal panel-body" action="/site/register" method="post">
            <div class="form-group registerForm-email <?= isset($error) ? array_key_exists('email', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-email">Email</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-email" class="form-control" name="RegisterForm[email]" value="<?= $model->email ?>">
                    <div class="help-block help-block-error "><?= isset($error) ? array_key_exists('email', $error) ? $error['email'] : '' : '' ?></div>
                </div>

            </div>
            <div class="form-group registerForm-name <?= isset($error) ? array_key_exists('name', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-name">Имя</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-name" class="form-control" name="RegisterForm[name]" value="<?= $model->name ?>">
                    <div class="help-block help-block-error "><?= isset($error) ? array_key_exists('name', $error) ? $error['name'] : '' : '' ?></div>
                </div>

            </div>
            <div class="form-group registerForm-password <?= isset($error) ? array_key_exists('password', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-password">Пароль</label>
                <div class="col-sm-9">
                    <input type="password" id="registerform-password" class="form-control"
                           name="RegisterForm[password]">
                    <div class="help-block help-block-error"><?= isset($error) ? array_key_exists('password', $error) ? $error['password'] : '' : '' ?></div>
                </div>
            </div>

            <button type="submit" class="btn-success btn pull-right btn-signup" name="signup-button">
                Регистрация
            </button>
        </form>
    </div>
</div>