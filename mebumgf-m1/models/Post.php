<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $author
 * @property string $date
 * @property string $author_id
 * @property string $post_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'author', 'author_id', 'post_id'], 'required'],
            [['date'], 'safe'],
            [['title', 'text', 'author', 'author_id', 'post_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Содержание поста',
            'author' => 'Author',
            'date' => 'Date',
            'author_id' => 'Author ID',
            'post_id' => 'Post ID',
        ];
    }
}
