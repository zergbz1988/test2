<?php

/**
 * @var $model \test2\model\form\SendReviewForm
 */

$this->vars['title'] = 'Отправить отзыв';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->vars['title'] ?></div>
    </div>
    <div class="col-xs-12 panel">
        <form id="registerForm" class="form-horizontal panel-body" action="/site/send" method="post">
            <div
                class="form-group registerForm-email <?= isset($error) ? array_key_exists('email', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-email">Email</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-email" class="form-control" name="SendReviewForm[email]"
                           value="<?= $model->email ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('email', $error) ? $error['email'] : '' : '' ?></div>
                </div>

            </div>
            <div
                class="form-group registerForm-name <?= isset($error) ? array_key_exists('name', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-name">Имя</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-name" class="form-control" name="SendReviewForm[name]"
                           value="<?= $model->name ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('name', $error) ? $error['name'] : '' : '' ?></div>
                </div>
            </div>
            <div
                class="form-group registerForm-name <?= isset($error) ? array_key_exists('title', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-title">Заголовок отзыва</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-title" class="form-control" name="SendReviewForm[title]"
                           value="<?= $model->title ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('title', $error) ? $error['title'] : '' : '' ?></div>
                </div>
            </div>
            <div
                class="form-group registerForm-password <?= isset($error) ? array_key_exists('message', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-message">Текст отзыва</label>
                <div class="col-sm-9">
                    <textarea id="registerform-message" class="form-control"
                              name="SendReviewForm[message]" rows="6"><?= $model->message ?></textarea>
                    <div
                        class="help-block help-block-error"><?= isset($error) ? array_key_exists('message', $error) ? $error['message'] : '' : '' ?></div>
                </div>
            </div>

            <div
                class="form-group registerForm-code <?= isset($error) ? array_key_exists('code', $error) ? 'has-error' : '' : '' ?>">
                <div class="col-sm-9 col-sm-offset-3">
                    <img src='/assets/captcha/captcha.php' id='capcha-image'>
                    <!-- Сама капча -->
                    <div>
                        <a href="javascript:void(0);"
                           onclick="document.getElementById('capcha-image').src='/assets/captcha/captcha.php?rid=' + Math.random();">Обновить
                            капчу</a>
                    </div>
                    <input type="text" name="SendReviewForm[code]">
                    <div
                        class="help-block help-block-error"><?= isset($error) ? array_key_exists('code', $error) ? $error['code'] : '' : '' ?></div>
                </div>
            </div>
            <button type="submit" class="btn-success btn pull-right btn-signup" name="signup-button">
                Отправить отзыв
            </button>
        </form>
    </div>
</div>