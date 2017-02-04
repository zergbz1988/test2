<?php

/**
 * @var $models \test2\model\record\Review[]
 */

$this->title = 'Отзывы для проверки';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->title ?></div>
    </div>
    <?php $flash = $this->registry->session['flash-success'] ?? '';
    if ($flash != '') {
        unset($_SESSION['flash-success']); ?>
        <div class="col-xs-12 ">
            <div class="flash flash-success">
                <?= $flash ?>
            </div>
        </div>
    <?php } ?>
    <?php $flash = $this->registry->session['flash-error'] ?? '';
    if ($flash != '') {
        unset($_SESSION['flash-error']); ?>
        <div class="col-xs-12 ">
            <div class="flash flash-error">
                <?= $flash ?>
            </div>
        </div>
    <?php } ?>
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <?php if (!empty($models)) { ?>
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Краткий текст</th>
                            <th class="action-column">Просмотр / Одобрить / Удалить</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($models as $model) { ?>
                            <tr>
                                <td><?= $model->attributes['title'] ?></td>
                                <td class="text-short"><?= $model->attributes['message'] ?></td>
                                <td>
                                    <a href="/admin/view/<?= $model->pk ?>"><i
                                            class="grid-btn glyphicon glyphicon-eye-open"></i></a>
                                    <a href="/admin/approve/<?= $model->pk ?>" class="approve-review-btn"><i
                                            class="grid-btn glyphicon glyphicon-ok"></i></a>
                                    <a href="/admin/delete/<?= $model->pk ?>" class="delete-review-btn" data-id="<?= $model->pk ?>"><i
                                            class="grid-btn glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="h4">Нет отзывов для проверки.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
