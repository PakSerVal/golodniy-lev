<?php

use common\models\Tag;
use yii\helpers\Url;

/**
 * @var $tags Tag[]
 */
?>
<a href="<?= Url::to('/tags/create') ?>" class="btn btn-success">Создать тэг</a>
<table class="table text-center">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Название</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tags as $tag): ?>
        <tr>
            <td><?= $tag->id ?></td>
            <td>
                <?= $tag->title ?>
            </td>
            <td>
                <a href="<?= Url::toRoute(['/tags/edit', $tag::ATTR_ID => $tag->id]) ?>" class="btn btn-primary">Редактировать</a>
                <a
                    class="btn btn-danger"
                    data-role="delete-btn"
                    data-url="<?= Url::toRoute(['/tags/delete', $tag::ATTR_ID => $tag->id]) ?>">
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
