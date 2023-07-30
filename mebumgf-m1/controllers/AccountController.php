<?php

namespace app\controllers;
use Yii;

use app\models\Order;
use app\models\OrderItem;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use app\models\Cart;
use app\models\LoginForm;
use app\models\Status;
use yii\bootstrap5\ActiveForm;
use yii\helpers\VarDumper;
use yii\web\Response;

/**
 * AccountController implements the CRUD actions for Order model.
 */
class AccountController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest && !Yii::$app->user->identity->IsAdmin;
                        },
                        ],
                    [
                        'denyCallback' => function ($rule, $action) {
                            $this->goHome();
                        }
                    ],
                ],
            ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
            );
    }

    /**
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $status = Status::getStatusList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => $status,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $status = Status::getStatusList();


        if ($cart = Cart::getCart())
        {
            $dataProvider = new ArrayDataProvider(['allModels' => $cart['products'], 'pagination' => [ 'pageSize' => 4]]);
            $login = new LoginForm();
            $login->login = Yii::$app->user->identity->login;
            $url = '/account/create';
           

            if (Yii::$app->request->isAjax && $login->load(Yii::$app->request->post())) 
            {
                $login->default = false;
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($login);
            }
    
            if(Yii::$app->request->isPost && $login->load(Yii::$app->request->post()) && $login->validate() )
            {
                try 
                {
                    $transaction = Yii::$app->db->beginTransaction();
                    $order = new Order();
    
                    if($order->orderCreate($cart))
                    {
                        if( OrderItem::OrderItemsCreate($cart, $order->id))
                        {
                            $transaction->commit();
                            Yii::$app->session->remove('cart');
                            Yii::$app->session->removeFlash('error');
                            Yii::$app->session->setFlash('success', 'Заказ оформлен.');
                            return $this->redirect(['/account']);
                        }
                    }
                }
                catch(\Throwable $e)
                {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Ошибка при оформлении заказа.');

                    VarDumper::dump($e, 10, true);
                    die;
                }
            }
    
            return $this->render('create', compact('login', 'cart', 'dataProvider', 'url', 'status'));
            
        }
        

        $this->redirect('/');
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = Status::getStatusList();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'status' => $status,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
