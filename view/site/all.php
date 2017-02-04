<?php

/**
 * @var $models \test2\model\record\Review[]
 * @var $model \test2\model\form\SendReviewForm
 */

$this->title = 'Все отзывы';

?>

<div class="row">
    <div class="col-xs-12">
        <div class="h2 title"><?= $this->title ?></div>
    </div>
    <div class="col-xs-12">
        <div class="panel">
            <div class="panel-body">
                <?php if (!empty($models)) { ?>
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Краткий текст</th>
                            <th>Статус</th>
                            <th>Просмотр</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($models as $model) { ?>
                            <tr>
                                <td><?= $model->attributes['title'] ?></td>
                                <td class="text-short"><?= $model->attributes['message'] ?></td>
                                <td><?= $model->attributes['approved'] == true ? 'Одобрено' : 'На проверке' ?></td>
                                <td>
                                    <a href="/site/view/<?= $model->pk ?>"><i class="grid-btn glyphicon glyphicon-eye-open"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="h4">Нет отзывов.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
