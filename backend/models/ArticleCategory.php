<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property string $sort
 * @property string $is_help
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'sort', 'is_help'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '分类简介',
            'status' => '状态',
            'sort' => '排序',
            'is_help' => '是否帮助分类',
        ];
    }

    public static function getArticleCategories()
    {
        return ArrayHelper::map(self::find()->where(['status'=>1])->all(),'id','name');
    }

    public static function getArticleCategoryById($id)
    {
        return self::find()->where(['id'=>$id])->select('name')->scalar();
    }
}
