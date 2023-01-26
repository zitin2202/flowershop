<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartSearch;
use app\models\Order;
use app\models\OrderSearch;
use Yii;
use yii\data\ActiveDataProvider;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if ((Yii::$app->user->isGuest) || (Yii::$app->user->identity->is_admin==0)){
            $this->redirect(['site/login']);
            return false;
    }
        else
            return true;
    }

    public function actionOrder(){
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('order', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrderUpdate($id_order){
        $model = Order::findOne($id_order);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id_order' => $model->id_order]);
        }

        return $this->render('order_update', [
            'model' => $model,
        ]);
    }
}
