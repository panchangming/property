<?php

namespace backend\models;

use common\logic\NestedMysql;
use common\logic\NestedSets;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $parent_id
 * @property string $intro
 * @property string $lft
 * @property string $rght
 * @property integer $level
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'lft', 'rght', 'level'], 'integer'],
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
            'parent_id' => '父分类',
            'intro' => '简介',
            'lft' => '左节点',
            'rght' => '右节点',
            'level' => '层级',
        ];
    }

    /**
     * 获取所有的分类列表
     * @return array
     */
    public static function getCategories()
    {
        return ArrayHelper::toArray(self::find()->orderBy('lft')->all());
    }

    /**
     * 使用nestedsets新建分类
     */
    public function addCategory()
    {
        $db = new NestedMysql();
        $nesetsets = new NestedSets($db,self::tableName(),'lft','rght','parent_id','id','level');
        if($nesetsets->insert($this->parent_id,$this->attributes,'bottom')){
            return true;
        }else{
            $this->addError('name','新分类插入失败');
            return false;
        }
    }

    /**
     * 修改商品分类。
     */
    public function modifyCategory()
    {
        //保存基本数据
        $this->save();

        $db = new NestedMysql();
        $nesetsets = new NestedSets($db,self::tableName(),'lft','rght','parent_id','id','level');
        return $nesetsets->moveUnder($this->id,$this->parent_id,'bottom');
    }

    /**
     * 删除分类，同时删除后代分类。
     * @param $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        $db = new NestedMysql();
        $nesetsets = new NestedSets($db,self::tableName(),'lft','rght','parent_id','id','level');
        return $nesetsets->delete($id);
    }
    public  static  function getCategoryOne($id){
        $row=self::findOne(['id'=>$id]);
        return $row->name;
    }
}
