<?php

namespace app\models;

use Yii;

use app\models\Product;
use app\models\Order;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property int $count
 * @property string $title
 * @property int $price
 *
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'count', 'title', 'price'], 'required'],
            [['order_id', 'count', 'price'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
            'title' => 'Title',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public static function orderItemsCreate($cart, $order_id)
    {
        foreach($cart['products'] as $val )
        {
            if($product = Product::findOne($val['id']))
            {
                $order_product = new static();
                $order_product-> order_id = $order_id;
                $order_product -> product_id = $val['id'];
                $order_product -> price = $val['price'];
                $order_product -> title = $val['title'];
                $order_product -> count = $val['count'];

                if($res = $order_product->save())
                {
                    $product->count -= $val['count'];
                    $res = $product->save();
                }
                if (!$res) 
                {
                    return $res;
                }

            }
        }
        return true;
    }
}
