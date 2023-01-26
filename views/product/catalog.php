<?php
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap5\Dropdown;
use yii\bootstrap5\Html as Html;use yii\bootstrap5\Modal;
include_once "modelAddProduct";

$this->title = 'Каталог товаров';
$this->params['breadcrumbs'][] = $this->title;
echo "<h1>Каталог товаров</h1>
<!--Поместите здесь элементы управления каталогом в соответсвии с заданием-->
";
$products=$dataProvider->getModels();
?>
<div class="my-4 row">
    <div class="dropdown col-md-auto">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonPrice" data-bs-toggle="dropdown" aria-expanded="false">
        По цене
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrice">
        <li><?=Html::a('по возрастанию',['product/catalog','sort'=>'price'],['class'=>'dropdown-item'])?></li>
        <li><?=Html::a('по убыванию',['product/catalog','sort'=>'-price'],['class'=>'dropdown-item'])?></li>
      </ul>
    </div>
     <div class="dropdown col-md-auto">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonPrice" data-bs-toggle="dropdown" aria-expanded="false">
        По Наименованию
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrice">
        <li><?=Html::a('по возрастанию',['product/catalog','sort'=>'name'],['class'=>'dropdown-item'])?></li>
        <li><?=Html::a('по убыванию',['product/catalog','sort'=>'-name'],['class'=>'dropdown-item'])?></li>
      </ul>
    </div>
    <div class="dropdown col-md-auto">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonPrice" data-bs-toggle="dropdown" aria-expanded="false">
        По Стране
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrice">
        <li><?=Html::a('по возрастанию',['product/catalog','sort'=>'country'],['class'=>'dropdown-item'])?></li>
        <li><?=Html::a('по убыванию',['product/catalog','sort'=>'-country'],['class'=>'dropdown-item'])?></li>
      </ul>
    </div>
        <div class="dropdown col-md-auto">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonPrice" data-bs-toggle="dropdown" aria-expanded="false">
        Категории
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonPrice">
    <?php
    $items = \app\models\Category::find()->all();
    foreach ($items as $item){
            echo '<li>';
            echo   Html::a($item->name,['product/catalog','ProductSearch[category_id]'=>$item->id_category],['class'=>'dropdown-item']);
            echo '</li>';
    }
    ?>
      </ul>
    </div>
</div>
<div class='d-flex flex-row flex-wrap justify-content-start border
border-1 align-items-end'>
    <?php
foreach ($products as $product){
    if ($product->count>0){
    ?>
    <div class="card" style="width: 18rem;">
        <?= Html::a(

                Html::img($product->image,['alt' => $product->name, 'class'=>'card-img-top'])
        ,['product/view', 'id_product' => $product->id_product])?>
        <div class="card-body">
            <h5 class="card-title"><?=$product->name?></h5>
            <p class="card-text" style="color: grey" ><?=$product->color?></p>
            <p class="card-text" ><?=$product->country?></p>
            <p class="card-text" style="color: #0b5ed7"><?=$product->price?> рублей</p>
            <?php if (!Yii::$app->user->isGuest) {
                echo "<button class='btn btn-primary' onclick='add_product({$product->id_product},1)'>В коризну</button>";
            }
            ?>
        </div>
    </div>
<?php
    }
}
?>


