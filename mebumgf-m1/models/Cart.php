<?php

namespace app\models;

//use Symfony\Component\VarDumper\VarDumper;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class Cart extends Model
{
    public static function getCart()
    {
        $session = Yii::$app->session;

        return $session->has('cart') ? $session->get('cart') : ['count' => 0, 'sum' => 0];
    }

    public static function addToCart($id)
    {
        if($product = Product::findOne($id))
        {
            if($product->count > 0)
            {
                $session = Yii::$app->session;


                $cart = static::getCart();

                if( !empty($cart['products'][$product->id]))
                {
                    if($cart['products'][$product->id]['count'] < $product->count)
                    {
                        $cart['products'][$product->id]['count']++;
                        $cart['products'][$product->id]['sum'] = $product->price * $cart['products'][$product->id]['count'];
                        $cart['count']++;
                        $cart['sum'] += $product->price;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    $cart['products'][$product->id]['id'] = $product->id;
                    $cart['products'][$product->id]['title'] = $product->title;
                    $cart['products'][$product->id]['price'] = $product->price;
                    $cart['products'][$product->id]['photo'] = $product->photo;
                    $cart['products'][$product->id]['count'] = 1;
                    $cart['products'][$product->id]['sum'] = $product->price;
                    $cart['count']++;
                    $cart['sum'] += $product->price;
                }
                $session->set('cart', $cart);
                // VarDumper ::dump($cart, 10, true);
                // die;
                return true;
            }
        }
    }

    public static function deleteFromCart($id, $all_count = false)
    {
        if($product = Product::findOne($id))
        {
            $session = Yii::$app->session;

            if($session->has('cart'))
            {
                $cart = $session->get('cart');

                if( !empty($cart['products'][$id])) 
                {
                    $count = $all_count ? $cart['products'][$id]['count'] : 1;
                    $cart['products'][$id]['count'] -= $count;
                    $cart['products'][$id]['sum'] -= $cart['products'][$id]['price'];
                    $cart['count'] -= $count;
                    $cart['sum'] -= $cart['products'][$id]['price'] * $count;

                    if( empty($cart['products'][$id]['count']))
                    {
                        unset($cart['products'][$id]);
                    }
                    if(!empty($cart['count']))
                    {
                        $session->set('cart', $cart);
                    }
                    else
                    {
                        $session->remove('cart');
                    }
                    return true;
                }
            }
        }
        return true;
    }

    public static function clearCart()
    {
        return Yii::$app->session->remove('cart');
    }




}
