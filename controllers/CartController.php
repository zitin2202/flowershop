<?php

namespace app\controllers;

use app\models\Cart;
use app\models\CartSearch;
use app\models\LoginForm;
use app\models\Product;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action){
        if ($action->id=='create') $this->enableCsrfValidation=false;
        if ($action->id=='update') $this->enableCsrfValidation=false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Cart models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CartSearch();
        $query = Cart::find()->where(["user_id"=>Yii::$app->user->identity->getId()]);
        $dataProvider = new ActiveDataProvider(['query'=>$query]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cart model.
     * @param int $id_curt Id Curt
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_curt)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_curt),
        ]);
    }

    /**
     * Creates a new Cart model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $product_id = Yii::$app->request->post('product_id');
        $count=Yii::$app->request->post('count');
        $product = Product::findOne($product_id);
        if (!$product) return 'false';
        if ($product->count-$count >= 0) {
            $product->count -= $count;
            $product->save(false);
            $cart = Cart::find()->where(['user_id' => \Yii::$app->user->identity->getId()])->
            andWhere(['product_id' => $product_id])->one();
            if ($cart) {
                $cart->count += $count;
                $cart->save();
                return 'true';
            }
            else{
                $cart = new cart();
                $cart->user_id = \Yii::$app->user->identity->getId();
                $cart->product_id = $product->id_product;
                $cart->count = $count;
                if ($cart->save(false)) return 'true';

            }

         }
                return 'false';

    }


    /**
     * Updates an existing Cart model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_curt Id Curt
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $product_id = Yii::$app->request->post('product_id');
        $count=Yii::$app->request->post('count');
        $product = Product::findOne($product_id);
        if (!$product) return 'false';
        if ($product->count-$count >= 0) {
            $product->count -= $count;
            $product->save(false);
            $cart = Cart::find()->where(['user_id' => \Yii::$app->user->identity->getId()])->
            andWhere(['product_id' => $product_id])->one();
            $cart->count += $count;
            if($cart->count==0){
                $cart->delete();
            }
            else{
                $cart->save();
            }
            return 'true';

        }
        return 'false';
    }

    /**
     * Deletes an existing Cart model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_curt Id Curt
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_curt)
    {
        $this->findModel($id_curt)->delete();

        return $this->redirect(['index']);
    }

    public function actionLogin(){

        $password = Yii::$app->request->post("password");
        die($password);
        $user=Yii::$app->user->identity;
        $user->validatePassword($user->password);
    }

    /**
     * Finds the Cart model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_curt Id Curt
     * @return Cart the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_curt)
    {
        if (($model = Cart::findOne(['id_curt' => $id_curt])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
