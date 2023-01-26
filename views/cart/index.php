<?php

use app\models\Cart;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
include "modelAddProduct";

$carts = $dataProvider->getModels();

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (Yii::$app->user->identity->is_admin==1){
        ?>
        <p>
            <?= Html::a('Create Cart', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php
    }




    ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Товар</th>
            <th scope="col">Цена</th>
            <th scope="col">Количество</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($carts as $cart){
            echo "<tr>";
            echo "<td>" .  $cart->getProduct()->one()->name ."</td>";
            echo "<td>" .  $cart->getProduct()->one()->price ."</td>";
            echo "<td>" .  $cart->count ."</td>";
            ?> <td>
                    <button class="btn btn-primary" onclick="changeCountProduct(<?=$cart->product_id?>,1)">+</button>
                    <button  class="btn btn-danger" onclick="changeCountProduct(<?=$cart->product_id?>,-1)">-</button>
                 </td>
        <?php
            echo "</tr>";

        }
        ?>
        </tbody>
    </table>
    <?php



    if (count($carts)>0){


    $sum = 0;
    foreach ($carts as $cart) {
        $sum+=$cart->getProduct()->one()->price * $cart->count;
    }

    echo "<h3>Сумма {$sum}</h3> ";



    Modal::begin([
        'toggleButton' => ['label' => 'Оформить заказ','class' => 'btn btn-success'],
    ]);

        ?>

<!--    <form action="/login">-->
<!--        <div class="mb-3">-->
<!--            <label for="exampleInputPassword1" class="form-label">Password</label>-->
<!--            <input type="password" class="form-control" id="exampleInputPassword1" name="password">-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary">Submit</button>-->
<!--    </form>-->
    <?php
    ?>
        <div class="mb-3" id="password_field">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="InputPasswordforOrder" name="password">
            <div class="invalid" style="display: none; color: red" id="invalid_feedback">
                Пароль не верный.
            </div>
        </div>
    <button class="btn btn-primary" onclick='add_order(<?=$carts[0]->user_id?>)'>Оформить заказ</button>


    <?php

    Modal::end();
    }
    ?>


</div>
