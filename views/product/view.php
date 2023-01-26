<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (Yii::$app->user->identity->is_admin==1){
    ?>
    <p>
        <?= Html::a('Update', ['update', 'id_product' => $model->id_product], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_product' => $model->id_product], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'price',
            ['attribute'=>'Фото', 'format'=>'html','value'=>function($data){return Html::img($data->image,['alt' => $data->name, 'style'=>'width: 120px']);}],
            'country',
            'color',
            ['attribute'=>'Категория', 'format'=>'html','value'=>function($data){return $data->getCategory()->one()->name;}],
            'count',

        ],
    ]);

        if (!Yii::$app->user->isGuest) {
            echo "<button class='btn btn-primary' onclick='add_product({$model->id_product},1)'>В коризну</button>";

        }

    ?>

</div>
