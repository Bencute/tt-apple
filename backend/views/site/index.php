<?php

use common\models\Apple;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $apples Apple */

$this->title = 'My Yii Application';
?>
<style type="text/css">
.colorBlock {
    width: 70px;
    height: 70px;
}
</style>

<div class="site-index">

    <div class="jumbotron">
        <?= Html::a('Сгенерировать 5 яблок', ['site/generate', 'count' => 5], ['class' => 'btn btn-lg btn-primary'])?>
    </div>

    <div class="body-content">
        <table class="table table-striped">
            <tr>
                <th>Id</th>
                <th>Цвет</th>
                <th>Съедено %</th>
                <th>Оставшееся количество</th>
                <th>Дата создания</th>
                <th>Дата падения</th>
                <th>Текущий статус</th>
                <th>Время на земле, с</th>
                <th>Действия</th>
            </tr>
            <?php foreach($apples as $apple) { ?>
                <tr>
                    <td><?=$apple->getId() ?></td>
                    <td>
                        <div class="colorBlock" style="background-color: #<?=$apple->getColor() ?>;"><?=$apple->getColor() ?></div>
                    </td>
                    <td><?=$apple->getEat() ?></td>
                    <td><?=$apple->getSize() ?></td>
                    <td><?=$apple->getDateCreate() ?></td>
                    <td><?=$apple->getDateFall() ?></td>
                    <td><?=$apple->getStringStatus() ?></td>
                    <td><?=is_null($apple->getDateFall()) ? '-' : Yii::$app->formatter->asDuration(time() - Yii::$app->formatter->asTimestamp($apple->getDateFall())) ?></td>
                    <td>
                        <?php if ($apple->getStatus()->isAvailableNext(Apple::STATUS_FALL)) { ?>
                            <?= Html::a('Упасть', ['site/fall', 'id' => $apple->getId()], ['class' => 'btn btn-primary'])?>
                        <?php } ?>

                        <?php if ($apple->getStatus()->isAvailableNext(Apple::STATUS_EATED)) { ?>
                            <?=Html::beginForm(['site/eat', 'id' => $apple->getId()], 'get', ['class' => 'form-inline'])?>
                            <?=Html::textInput('count', 0, ['class' => 'form-control', 'style' => 'width: 3em;'])?>
                            <?=Html::submitButton('Откусить', ['class' => 'btn btn-success'])?>
                            <?=Html::endForm()?>
                        <?php } ?>

                        <?php if ($apple->getStatus()->isAvailableNext(Apple::STATUS_THROW)) { ?>
                            <?= Html::a('Выкинуть', ['site/throw', 'id' => $apple->getId()], ['class' => 'btn btn-warning'])?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
