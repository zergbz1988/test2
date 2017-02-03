<?php

/**
 * @var $models \test2\model\record\Review[]
 */

$this->vars['title'] = 'Все отзывы';
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
                <th>Имя автора</th>
                <th>Email автора</th>
                <th>Заголовок отзыва</th>
                <th>Краткий текст отзыва</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model) { ?>
                <tr>
                    <td><?= $model->attributes['name'] ?></td>
                    <td><?= $model->attributes['email'] ?></td>
                    <td><?= $model->attributes['title'] ?></td>
                    <td class="text-short"><?= $model->attributes['message'] ?></td>
                    <td>
                        <a href="/site/view/<?= $model->pk ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div class="h4">Нет одобренных отзывов.</div>
        <?php } ?>
    </div>
</div>