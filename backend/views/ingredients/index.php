<?php

use common\models\Ingredient;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $ingredients Ingredient[]
 */
?>
<table class="table text-center">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Название</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($ingredients as $ingredient): ?>
        <tr>
            <td><?= $ingredient->id ?></td>
            <td><?= $ingredient->title ?></td>
            <td>
                <a href="<?= Url::toRoute(['/ingredients/edit', $ingredient::ATTR_ID => $ingredient->id]) ?>" class="btn btn-primary">Редактировать</a>
                <a
                    class="btn btn-danger"
                    data-role="delete-btn"
                    data-url="<?= Url::toRoute(['/ingredients/delete', $ingredient::ATTR_ID => $ingredient->id]) ?>">
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
