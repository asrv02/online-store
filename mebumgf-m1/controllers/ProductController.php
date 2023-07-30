<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Yii;
use yii\helpers\VarDumper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $categorys;
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
                            return Yii::$app->user->identity->IsAdmin;
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
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
        {
            return false;
        }

        $this->categorys = Category::getCategoryList();

        return true;
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        $model -> scenario = Product::CREATE_PRODUCT;
        $category = Category::getCategoryList();

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) ) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if($model->upload()) {


                    if($model->save(false)){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

            }
        }
         /*else {
            $model->loadDefaultValues();
        } */
        return $this->render('create', [
            'model' => $model,
            'category' => $category,
        ]);
    }


    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category = Category::getCategoryList();
        $file_name = $model->photo;

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) ) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if($model->imageFile){
                    if( !$model->upload()) {
                        Yii::$app->session->setFlash('error', 'Ошибка при добавлении товара.');
                    }

                    if( file_exists('upload/' . $file_name))
                        unlink( $file_name);
                }
                    
                    if($model->save(false)) {
                        Yii::$app->session->setFlash('success', 'Товар успешно отредактирован.');
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                else{
                    Yii::$app->session->setFlash('error', 'Ошибка при добалении товара.');
                }

            }
        }

        return $this->render('update', compact('model', 'category'));
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
