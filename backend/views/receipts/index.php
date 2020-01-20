<?php

use common\models\Receipt;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $receipts Receipt[]
 */
?>
<a href="<?= Url::to('/receipts/create') ?>" class="btn btn-success">Создать рецепт</a>
<table class="table text-center">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Название</th>
        <th scope="col" class="text-center">Изображение</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($receipts as $receipt): ?>
        <tr>
            <td><?= $receipt->id ?></td>
            <td>
                <?= $receipt->title ?>
            </td>
            <td><?= Html::img($receipt->getImageUrl(), ['style' => 'max-height: 300px; max-width: 300px;']) ?></td>
            <td>
                <a href="<?= Url::toRoute(['/receipts/edit', $receipt::ATTR_ID => $receipt->id]) ?>" class="btn btn-primary">Редактировать</a>
                <a
                    class="btn btn-danger"
                    data-role="delete-btn"
                    data-url="<?= Url::toRoute(['/receipts/delete', $receipt::ATTR_ID => $receipt->id]) ?>">
                        Удалить
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php Yii::$app->view->registerJs(
<<<JS
    $('[data-role="delete-btn"]').on('click', (e) => {
       if (window.confirm('Уверен?')) {
           window.location.href = e.target.dataset.url;
       } 
    });
JS
) ?>
