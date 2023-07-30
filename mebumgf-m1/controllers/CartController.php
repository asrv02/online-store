<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\data\ArrayDataProvider;
use app\models\Cart;
use yii\helpers\VarDumper;

class CartController extends \yii\web\Controller
{
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
                            return !Yii::$app->user->identity->IsAdmin;
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

    public function actionView()
    {
        if( Yii::$app->request->isPost || Yii::$app->request->isGet )
        {
            $btn = Yii::$app->request->get('btn');
            $id = Yii::$app->request->get('id');
            $page = Yii::$app->request->get('page');
            $per_page = Yii::$app->request->get('per_page');
            
            $url = "/cart/view?";
            $url .= $page ? 'page=' . $page : '';
            $url .= $per_page ? ($page ? '&' : '') . 'per_page' . $per_page : '';
            $url .= preg_match('/\=/', $url) ? '&' : '';

            if( $btn ) 
            {
                switch($btn)
                {
                    case 'minus': Cart::deleteFromCart($id); break;
                    case 'plus': $res = Cart::addToCart($id); break;
                    case 'trash': Cart::deleteFromCart($id, true); break;
                    case 'clear': $res_js = Cart::clearCart(); break;
                    case 'btn-add':  $res_js = Cart::addToCart($id); break;
                }
                if( isset($res_js))
                {
                    return $this->asJson($res_js);
                }
            }
            $cart = Cart::getCart();
            // VarDumper::dump($cart, 10 ,true);
            // die;
            $dataProvider = null;
            $res = null;

            if ( !empty($cart['count']) )
            {
                $dataProvider = new ArrayDataProvider(['allModels' => $cart['products'], 'pagination' => [ 
                    'pageSize' => 2,
                ],]);
            }

            $btn_no = false;

            return $this->renderAjax('view', compact('cart', 'dataProvider', 'url', 'res', 'btn_no'));
        }
    }

    

}
