<?php

/**
 * @var $models \test2\model\record\Review[]
 * @var $model \test2\model\form\SendReviewForm
 */

$this->vars['title'] = 'Одобренные отзывы';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->vars['title'] ?></div>
    </div>
    <div class="col-xs-12 panel">
        <?php if (!empty($models)) { ?>
        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th>Заголовок отзыва</th>
                <th>Краткий текст отзыва</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model) { ?>
                <tr>
                    <td><?= $model->attributes['title'] ?></td>
                    <td class="text-short"><?= $model->attributes['message'] ?></td>
                    <td>
                        <a href="/site/view/<?= $model->pk ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="/site/delete/<?= $model->pk ?>" class="delete-review-btn"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div class="h4">Нет одобренных отзывов.</div>
        <?php } ?>
    </div>
    <div class="col-xs-12">
        <a href="/site/all" class="btn btn-default">Перейти ко всем отзывам &nbsp;<i class="glyphicon glyphicon-arrow-right"></i></a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="h3 title">Отправить отзыв</div>
    </div>
    <div class="col-xs-12 panel">
        <form id="registerForm" class="form-horizontal panel-body" action="/site/index" method="post">
            <div
                class="form-group registerForm-email <?= isset($error) ? array_key_exists('email', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-email">Email</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-email" class="form-control" name="SendReviewForm[email]"
                           value="<?= $reviewForm->email ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('email', $error) ? $error['email'] : '' : '' ?></div>
                </div>

            </div>
            <div
                class="form-group registerForm-name <?= isset($error) ? array_key_exists('name', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-name">Имя</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-name" class="form-control" name="SendReviewForm[name]"
                           value="<?= $reviewForm->name ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('name', $error) ? $error['name'] : '' : '' ?></div>
                </div>
            </div>
            <div
                class="form-group registerForm-name <?= isset($error) ? array_key_exists('title', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-title">Заголовок отзыва</label>
                <div class="col-sm-9">
                    <input type="text" id="registerform-title" class="form-control" name="SendReviewForm[title]"
                           value="<?= $reviewForm->title ?>">
                    <div
                        class="help-block help-block-error "><?= isset($error) ? array_key_exists('title', $error) ? $error['title'] : '' : '' ?></div>
                </div>
            </div>
            <div
                class="form-group registerForm-password <?= isset($error) ? array_key_exists('message', $error) ? 'has-error' : '' : '' ?>">
                <label class="control-label col-sm-3" for="registerform-message">Текст отзыва</label>
                <div class="col-sm-9">
                    <textarea id="registerform-message" class="form-control"
                              name="SendReviewForm[message]" rows="6"><?= $reviewForm->message ?></textarea>
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
