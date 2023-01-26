<?php

use yii\helpers\Html;
use yii\b\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cart $model */

$this->title = $model->id_curt;
$this->params['breadcrumbs'][] = ['label' => 'Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cart-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_curt' => $model->id_curt], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_curt' => $model->id_curt], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $attributes = [
        'id_curt',
        'product_id',
        'count',
        'user_id',
    ];
    if (!Yii::$app->user->isGuest){
        array_push($attributes,
        ['attribute'=>'Изменить количество', 'format'=>'html','value'=>function($data){
            return '<button></button>';
        }],
        );
    }
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>

</div>
