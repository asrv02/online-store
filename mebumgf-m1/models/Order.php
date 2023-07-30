<?php

namespace app\models;

use Yii;
use app\models\Status;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property string $time
 * @property int $count
 * @property int $sum
 * @property int $status_id
 * @property string|null $reason
 *
 * @property OrderItem[] $orderItems
 * @property Status $status
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'count', 'sum', 'status_id'], 'required'],
            [['user_id', 'count', 'sum', 'status_id'], 'integer'],
            [['time'], 'safe'],
            [['reason'], 'string', 'max' => 255],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID заказа',
            'user_id' => 'ID Пользователя',
            'time' => 'Время заказа',
            'count' => 'Количество',
            'sum' => 'Сумма',
            'status_id' => 'Статус',
            'reason' => 'Причина отказа',
            
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function orderCreate($cart)
    {
        $this->user_id = Yii::$app->user->id;
        $this->status_id = Status::getIdStatusName('Новый');
        $this->sum = $cart['sum'];
        $this->count = $cart['count'];

        return $this->save();
    }
}
