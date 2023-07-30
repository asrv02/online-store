<?php

namespace app\models;
use Yii;


use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $year
 * @property int $price
 * @property int $count
 * @property string $country
 * @property string $model
 * @property string $photo
 * @property int $category_id
 *
 * @property Category $category
 * @property OrderItem[] $orderItems
 */
class Product extends \yii\db\ActiveRecord
{

    public $imageFile;
    const CREATE_PRODUCT = 'actionCreate';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'price', 'count', 'country', 'model', 'category_id'], 'required'],
            ['imageFile', 'required', 'on' => self::CREATE_PRODUCT ],
            [['year', 'price', 'count', 'category_id'], 'integer'],
            [['title', 'country', 'model'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['imageFile'], 'file', 'extensions' => 'png, ipg, jpeg, bmp', 'maxSize' => 10 * 1024 * 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'year' => 'Год',
            'price' => 'Цена',
            'count' => 'Количество',
            'country' => 'Страна',
            'model' => 'Модель',
            'imageFile' => 'Фото',
            'category_id' => 'Категория товара',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['product_id' => 'id']);
    }

    public function upload()
    {
        if ($this->validate()){
            $fileName = Yii::$app->user->id . '_' . time() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(Yii::getAlias('@app') . '/web/img/' . $fileName);
            $this->photo = $fileName;
            $this->photo = '/img/' . $fileName;

            return true;
        } else {
            return false;
        }
    }


    public static function getLastItems() {
        return static::find()->select('title, photo')->orderBy('id DESC')->limit(5)->all();
    }

}

