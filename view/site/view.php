<?php

/**
 * @var $model \test2\model\record\Review
 */

$this->vars['title'] = 'Отзыв № ' . $model->pk;

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2"><?= $this->vars['title'] ?></div>
    </div>
    <div class="col-xs-12">
        <a href="/site/index" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp; К списку отзывов</a>
        <br>
        &nbsp;
    </div>
    <div class="col-xs-12 panel">
        <div class="row">
            <div class="panel-body col-xs-6">
                <strong>
                    Имя автора
                </strong>
                <div class="h3">
                    <?= $model->attributes['name'] ?>
                </div>
            </div>
            <div class="panel-body col-xs-6">
                <strong>
                    Email автора
                </strong>
                <div class="h3">
                    <?= $model->attributes['email'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 panel">
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
