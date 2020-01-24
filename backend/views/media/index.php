<?php

use common\models\Media;
use yii\helpers\Url;

/**
 * @var $media Media[]
 *
 * @author Pak Sergey
 */
?>
<table class="table text-center">
    <thead>
    <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col" class="text-center">Название</th>
        <th scope="col" class="text-center">Количество</th>
        <th scope="col" class="text-center">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($media as $mediaItem): ?>
        <tr>
            <td><?= $mediaItem->id ?></td>
            <td><?= $mediaItem->name ?></td>
            <td><?= $mediaItem->count ?></td>
            <td>
                <a href="<?= Url::toRoute(['/media/edit', $mediaItem::ATTR_ID => $mediaItem->id]) ?>" class="btn btn-primary">Редактировать</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
