<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@1,300&display=swap');
</style>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="text-center"">
    <?php echo Html::img("@web/images/logo3.png",['alt'=>"Логотип",  "style"=>"height: 180px"])?>
    <h2 style="font-family: 'Rubik', sans-serif">Цветы - это растения</h2>
</div>
<?php
$products = \app\models\Product::find()->orderBy("date ASC")->limit(5)->all();
foreach ($products as $product){
    $items[]="<div class='bg-dark m-2 p-2 d-flex flex-column justify-content-center'>
    <h1 class='text-white text-center m-2'>{$product->name}</h1>".
        Html::a(Html::img($product->image,['style'=>'height: 18rem;']),['product/view','id_product'=>$product->id_product],['style'=>'margin: auto']) . "</div>";}

echo yii\bootstrap5\Carousel::widget(['items'=>$items]);
?>


<p>
    This is the About page. You may modify the following file to customize its content:
</p>

<code><?= __FILE__ ?></code>
</div>
