<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'sn', 'goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock'], 'required'],
                [['goods_category_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'inputtime'], 'integer'],
                [['market_price', 'shop_price'], 'number'],
                [['name', 'sn'], 'string', 'max' => 20],
                [['logo'], 'string', 'max' => 255],
                [['sn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'                => 'ID',
            'name'              => '商品名称',
            'sn'                => '货号',
            'logo'              => '缩略图',
            'goods_category_id' => '商品分类',
            'brand_id'          => '品牌',
            'market_price'      => '市场价',
            'shop_price'        => '商城价',
            'stock'             => '库存',
            'is_on_sale'        => '是否在售',
            'status'            => '状态',
            'sort'              => '排序',
            'inputtime'         => '创建时间',
        ];
    }

    public function add() {
        //商品基本信息
        $this->isNewRecord = true;

        //生成货号
        $goodsDayCount     = new GoodsDayCount();
        $count             = $goodsDayCount->getDayCount();
        $this->sn          = date('Ymd') . str_pad($count, 5, '0', STR_PAD_LEFT);
        $this->save();
        return $this->primaryKey;
    }

}
