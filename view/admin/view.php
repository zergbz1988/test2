<?php

/**
 * @var $model \test2\model\record\Review
 */

$this->title = 'Отзыв № ' . $model->pk;

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2"><?= $this->title ?></div>
        Статус: <strong><?= $model->attributes['approved'] == true ? 'Одобрено' : 'На проверке' ?></strong>
        <br>
        &nbsp;
    </div>
    <div class="col-xs-12">
        <div class="panel">
            <div class="row">
                <div class="col-xs-6">
                    <div class="panel-body">
                        <strong>
                            Имя автора
                        </strong>
                        <div class="h3">
                            <?= $model->attributes['name'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="panel-body">
                        <strong>
                            Email автора
                        </strong>
                        <div class="h3">
                            <?= $model->attributes['email'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <div class="h2 title">
                    <?= $model->attributes['title'] ?>
                </div>
                <div>
                    <?= $model->attributes['message'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <a href="/admin/approve/<?= $model->pk ?>" class="approve-review-btn btn btn-primary">Одобрить отзыв</a>
        <a href="/admin/delete/<?= $model->pk ?>" class="delete-review-btn btn btn-danger" data-id="<?= $model->pk ?>">Удалить отзыв</a>
    </div>
</div>
