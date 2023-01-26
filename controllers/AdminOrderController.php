<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartSearch;
use app\models\Order;
use app\models\OrderSearch;
use Yii;
use yii\data\ActiveDataProvider;

class AdminOrderController extends \yii\web\Controller
{

    public function actionIndex(){
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id_order){
        $model = Order::findOne($id_order);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            return $this->redirect(['index', 'id_order' => $model->id_order]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
